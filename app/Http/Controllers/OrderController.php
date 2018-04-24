<?php

namespace App\Http\Controllers;
use App\Libraries\ReservationRates;
use App\MerchantAccount;
use App\Notifications\NotifyErrors;
use App\Popo\Errors;
use App\Users;
use Log;
use DB;
use Illuminate\Http\Request;
use App\Libraries\ReservationEmails;


class OrderController extends Controller
{


    public function __construct()
    {

        $this->db = app('db');
        $this->reservationEmails = new ReservationEmails();
    }

    public function index(Request $request, ReservationRates $rates, Errors $errors, MerchantAccount $merchantAccount){

        //save instructions message
        $instructions = $request->input('instructions');
        /*$request->session()->put('instructions', $instructions);
        for($a=2; $a < 5; $a++){
            $data = $request->session()->get("step$a");
            //var_dump($data);
            foreach($data as $key => $value){
                $$key = $value;
            }    
        }

        $rateData = (array) $request->session()->get("rates");
        $reservationInfo = $request->session()->get("reservationInfo");
        $booking = $request->session()->get("booking");
        foreach($booking as $key => $value){
            $$key = $value;
        }  */


        //parameters
        $params = array("condo", "adults", "kids", "start", "stop");
        foreach ($params as $key => $value) {
            if (strlen($value) < 15) {
                $temp[$value] = isset($_REQUEST[$value])?$_REQUEST[$value]:null;
                $$value = isset($_REQUEST[$value])?$_REQUEST[$value]:null;
            }
        }
        $params = array("fname", "lname", "email", "dayphone", "eveningphone", "fax", "how_did_you_hear", "address1", "address2", "city","state", "zip", "country", 
            "card_name", "cc_number","cc_exp_month","cc_exp_year","cc_ccv","instructions","ip","user_agent");
        foreach ($params as $key => $value) {
            if (strlen($value) < 20) {
                $$value = isset($_REQUEST[$value])?$_REQUEST[$value]:"";
            }
        }
        $reservationRates = new ReservationRates();
        $rateData = $reservationRates->getrate($temp);

        $ip = $_SERVER['REMOTE_ADDR'];
        $agentString = $_SERVER['HTTP_USER_AGENT'];

        //if charge successful then record the order
        $order = array(
            "order_status" => "n",
            "order_date_submit" => date("Y-m-d"),
            "condo_id" => $condo,
            "adults"=> $adults,
            "kids"=> $kids,
            "arrive"=> date("Y-m-d", strtotime($start)),
            "depart"=> date("Y-m-d", strtotime($stop)),
            "quote"=> serialize($rateData),
            "first_name"=> $fname,
            "last_name"=> $lname,
            "email"=> $email,
            "phone_day"=> $dayphone,
            "phone_eve"=> $eveningphone,
            "phone_fax"=> $fax,
            "heard_from"=> $how_did_you_hear,
            "address1"=> $address1,
            "address2"=> $address2,
            "city"=> $city,
            "state"=> $state,
            "zip"=> $zip,
            "country"=> $country,
            "cc_name"=> $card_name,
            "cc_num"=> $cc_number,
            "cc_exp"=> $cc_exp_month.$cc_exp_year,
            "cc_cvc"=> $cc_ccv,
            "instructions"=> $instructions,
            "agree_policies"=> "Y",
            "ip"=> $ip,
            "user_agent"=> $agentString,
            "cc_auth"=> null,

        );
        $chargeresult = false;
        try{
            //charge the card
            $chargeresult = $merchantAccount->ChargeCreditCard($order);
            if($chargeresult){
                //adjust the cc expire date to full date
                $order['cc_exp'] = date("Y-m-d", strtotime($cc_exp_month."/01/".$cc_exp_year));
                //save the order
                $orderSaved = $this->db->table('orders')->insertGetId($order);
                $request->session()->put("ordernumber", $orderSaved);
                if( !is_numeric($orderSaved) ){
                    \Notification::send(Users::first(), new NotifyErrors("Could not save users order ".print_r($order, true) ));
                    Log::debug("order saved was not numeric");
                }else{
                    //send out emails 
                    $order = array_merge($order, $reservationInfo, $rateData);
                    $order['cc_exp_month'] = $cc_exp_month;
                    $order['cc_exp_year'] = $cc_exp_year;
                    $order['now_date'] = date("Y-m-d");
                    $order['now_time'] = date("H:m");
                    $order['cc_type'] = "Undefined";
                    Log::debug("order saved success");
                    //var_dump($order);
                    $this->reservationEmails->sendEmails($order);
        
                }
            }
            

        }catch(\Exception $exception){

            Log::error($exception->getMessage());
            \Notification::send(Users::first(), new NotifyErrors($exception->getMessage()));

        }

        return array("charge_success" => $chargeresult, "reason" => $merchantAccount->getReason() );

    }

    public function thankyou(Request $request){
        
        $ordernumber = $request->session()->get("ordernumber");
        return view('thankyou', compact('ordernumber'));
    }




}
