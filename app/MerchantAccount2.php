<?php

namespace App;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Log;
use App\Notifications\NotifyErrors;
use App\Popo\Errors;
use markroland\Converge;

class MerchantAccount2
{

    

    public function ChargeCreditCard($order){

        $url['card_number'] = $order['cc_num'];
        $url['card_expire'] = $order['cc_exp'];
        $url['cust_ip'] = $order['ip'];
        $url['amount'] = "1.00";

        $testmode = false;
        if($url['card_number']=="4222222222222222"){
            $url['amount'] = "1.11";
            $url['card_number'] = "4444333322221111";
            $url['card_expire'] = "1024";
            $testmode = true;
        }

        //var_dump($order);exit;
        $url['bill_street'] = $order['address1'];
        $url['bill_zip'] = $order['zip'];
        $url['bill_name1'] = $order['first_name'];
        $url['bill_name2'] = $order['last_name'];
        $url['bill_state'] = $order['state'];
        $url['cust_phone'] = $order['phone_day'];
        $url['bill_city'] = $order['city'];
        $url['card_cvv2'] = $order['cc_cvc'];
        $url['cust_email'] = $order['email'];
        $url['bill_country'] = $order['country'];
        $url['pay_type'] = "C";
        $url['tran_type'] = "A";

        //$merchantParams = http_build_query($url);
        //Log::error($url);
    
            $PaymentProcessor = new \markroland\Converge\ConvergeApi(
                '827208',
                'rptweb',
                'KWBZW5NJ3RXUYPZS64FHPJN75NP5TVD42OOQBSAHWLSIWRDT96CQXKCPJ04P11O5',
                $testmode
            );
            // Submit a purchase
            $response = $PaymentProcessor->ccauthonly(
                array(
                    'ssl_amount' => $url['amount'],
                    'ssl_card_number' => $url['card_number'],
                    'ssl_cvv2cvc2' => $url['card_cvv2'],
                    'ssl_exp_date' => $url['card_expire'],
                    'ssl_avs_zip' => $url['bill_zip'],
                    'ssl_avs_address' => $url['bill_street'],
                    'ssl_last_name' => $url['bill_name2']
                )
            );
            
            //print_r($url);
            // Display Converge API response
            print('ConvergeApi->ccauthonly Response:' . "\n\n");
            print_r($response);

            /*if($res->getStatusCode() == 200 && strpos($this->reason, "Approved")){
                return true;
            }else{
                Log::error($this->reason);
                \Notification::send(Users::first(), new NotifyErrors($this->reason." ".$merchantParams));
                return false;
            }*/



    }

    public function getReason(){
        return $this->reason;
    }

}