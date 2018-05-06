<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Libraries\ReservationRates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->db = app('db');
    }
    public function index(Request $request){

        $sql = "select * from orders where order_status = 'n' and order_date_submit > '2018-01-01'";
        $rows = $this->db->select($sql);
        $newOrders = count($rows);

        $sql = "select count(*) count, month(order_date_submit) as month, year(order_date_submit) as year from orders 
        where order_date_submit >= date_sub(DATE_FORMAT(now(), '%Y-01-01'), interval 1 YEAR)
        group by month, year
        order by month, year";
        $rows = $this->db->select($sql);
        foreach($rows as $row){
            $count = $row->count;
            $month = $row->month;
            $year = $row->year;
            if($year == (date("Y") - 1) ){
                $temp[$month] = array("item1" => $count, "month" => $year."-".$month, "item2" => 0);
                
            }else{
              $temp[$month] = array_merge($temp[$month], array("item2" => $count)); 
            }
            
        }
        //dd($temp);
        $data = array("new" => $newOrders, "data" => $temp );
        return view('adminassets.index')->with($data);
    }

    // public function emails(Request $request){

    //     $sql = "select * from orders where order_status = 'n' and order_date_submit > '2018-01-01'";
    //     $rows = $this->db->select($sql);
    //     return view('adminassets.resorts')->with(array("rows" => $resorts));
    // }
    // public function leads(Request $request){

    //     $sql = "select * from leads where order_status = 'n' and order_date_submit > '2018-01-01'";
    //     $rows = $this->db->select($sql);
    //     return view('adminassets.resorts')->with(array("rows" => $resorts));
    //     return "Success";
    // }
    public function users(Request $request){

        if($_POST && $request->input('delete') == "delete"){
            $id = $request->input('id');
            DB::table('users')->where('id', '=', $id)->delete();
        }

        $usersname = $request->input('usersname');
        $password = $request->input('password');
        if($_POST && !empty($usersname)){
            
            DB::table('users')->insert(
                [
                'usersname' => $usersname, 
                'password' => $password
                ]
            );
        }


        $sql = "select * from users";
        $rows = $this->db->select($sql);
        return view('adminassets.users')->with(array("rows" => $rows));
    }

    public function reservations(Request $request){

        $sql = "select o.*, c.`condo_name`,  r.`resort_name` from orders o 
        left join condos c on c.condo_id = o.condo_id
        left join resorts r on c.resort_id = r.`resort_id`
        order by order_id desc limit 1200";
        $rows = $this->db->select($sql);
        foreach($rows as $row){

            if($row->order_status == "c"){
                $row->order_status = "Complete";
            }
            if($row->order_status == "n"){
                $row->order_status = "New";
            }
            if($row->order_status == "p"){
                $row->order_status = "Pending";
            }
            $row->order_date_submit = date("m-d-Y H:i", strtotime($row->order_date_submit));
            $row->arrive = date("m-d-Y", strtotime($row->arrive));
            $row->depart = date("m-d-Y", strtotime($row->depart));
            $quote = (array) unserialize($row->quote);
            $row->total = isset($quote['total'])?$quote['total']:$quote['Total'];
            
            $data[] = $row;
        }
        
        return view('adminassets.reservations')->with( array("rows" => $data) );
    }
   
    
    public function logout(Request $request){

        $request->session()->flush();
        return redirect('admin/');
    }

    public function charge(Request $request){

        
        return json_encode("success");
    }

    public function resorts(Request $request){

        //check delete
        $del = $request->input('delete');
        if($del){
            DB::table('resorts')->where('resort_id', '=', $del)->delete();
        }
        //check add
        $new = $request->input('newresort');
        if($new){
            DB::table('resorts')->insert(
                ['resort_name' => $_REQUEST['resort_name'], 'active' => 1]
            );
        }

        $resorts = $this->getResorts();
        return view('adminassets.resorts')->with(array("rows" => $resorts));
    }
    public function resort($resortid){

        if($_POST){
            DB::table('resorts')
            ->where('resort_id', $_REQUEST['resort_id'])
            ->update(['resort_name' => $_REQUEST['resort_name'] ]);
        }

        $sql = "select * from resorts where resort_id=?";
        $row = $this->db->select($sql, [$resortid]);
        //dd($row[0]);
        return view('adminassets.resort')->with( array("row" => $row[0]) );
    }
    public function condos(Request $request){

        //check delete
        $del = $request->input('delete');
        if($del){
            DB::table('condos')->where('condo_id', '=', $del)->delete();
        }
        //check add
        $new = $request->input('newcondo');
        if($new){
            $condo = array('condo_name', 'resort_id', 'condo_bedrooms', 'condo_fee_booking', 'condo_fee_impact', 'condo_tax_rate', 'condo_min_occupancy', 
            'condo_max_occupancy', 'condo_min_nights');
            foreach($condo as $item){
                $condoDetail[$item] = $_REQUEST[$item]; 
            }
            DB::table('condos')->insert(
                $condoDetail
            );
        }

        $sql = "select * from condos c join resorts r on c.resort_id = r.resort_id order by resort_name";
        $rows = $this->db->select($sql);

        $resorts = $this->getResorts();
        return view('adminassets.condos')->with(array("rows" => $rows, "resorts" => $resorts));
    }

    /**
     * Gets the condo driven by a condo id passed
     *
     * @param [type] $condoid
     * @return void
     */
    public function condo(Request $request, $condoid){

        if($_POST && $request->input('edit_condo') ){

            $condo = array('condo_name', 'resort_id', 'condo_bedrooms', 'condo_fee_booking', 'condo_fee_impact', 'condo_tax_rate', 'condo_min_occupancy', 
            'condo_max_occupancy', 'condo_min_nights');
            foreach($condo as $item){
                $condoUpdate[$item] = $request->input($item); 
            }

            DB::table('condos')
            ->where('condo_id', $_REQUEST['condo_id'])
            ->update($condoUpdate);
        }
        if($_POST && $request->input('agegroups') ){

            $condo_id = $request->input('condo_id');
            $agegroup_id = $request->input('agegroup_id');
            $restriction_extra_fee = $request->input('restriction_extra_fee');
            $restriction_num_free = $request->input('restriction_num_free');
            
            $itemUpdate = array(
                'condo_id' => $condo_id[0],
                'agegroup_id' => $agegroup_id[0],
                'restriction_extra_fee' => $restriction_extra_fee[0],
                'restriction_num_free' => $restriction_num_free[0]
            );
            DB::table('agegroup_restrictions')
            ->where('condo_id', $condo_id[0] )
            ->where('agegroup_id', $agegroup_id[0])
            ->update($itemUpdate);

            $itemUpdate = array(
                'condo_id' => $condo_id[1],
                'agegroup_id' => $agegroup_id[1],
                'restriction_extra_fee' => $restriction_extra_fee[1],
                'restriction_num_free' => $restriction_num_free[1]
            );
            DB::table('agegroup_restrictions')
            ->where('condo_id', $condo_id[1] )
            ->where('agegroup_id', $agegroup_id[1])
            ->update($itemUpdate);


            
        }

        $sql = "select * from condos where condo_id=?";
        $row = $this->db->select($sql, [$condoid]);

        $sql = "select * from rates where condo_id=?";
        $rates = $this->db->select($sql, [$condoid]);
        
        //dd($row[0]);
        $resorts = $this->getResorts();
        
        //get age data
        $sql = "select * from agegroup_restrictions agr 
        join agegroups ag on ag.`agegroup_id` = agr.`agegroup_id` where condo_id=?";
        $age = $this->db->select($sql, [$condoid]);
        
        return view('adminassets.condo')->with( array("row" => $row[0], "resorts" => $resorts, "age" => $age, "rates" => $rates) );
    }

    public function getRates(Request $request){
        $ratename = $request->input('rate_name');
        $condoid = $request->input('condo_id');
        $sql = "select * from rates where rate_name=? and condo_id=?";
        $rates = $this->db->select($sql, [$ratename, $condoid]);
        return $rates;
    }
    public function saveRates(Request $request){

        $data = array('rate_id', 'condo_id', 'rate_name', 'rate_price_sunday', 'rate_price_monday', 'rate_price_tuesday', 'rate_price_wednesday', 'rate_price_thursday', 'rate_price_friday', 'rate_price_saturday', 'rate_min_nights', 'rate_price_override');
        foreach($data as $item){
            $update[$item] = $request->input($item);
            $$item = $request->input($item);
        }

        if(empty($rate_id)){
            $rate_id = DB::table('rates')->insertGetId(
                $update
            );
            $type = "insert";
            if(!empty($rate_id)){
                $response = "success";
            }else{
                $response = "fail";
            }
        }else{
            $response = DB::table('rates')->where('rate_id', $rate_id)->update(
                $update
            );
            $response = "success";
            $type = "update";
            
        }    
            
        return array("response" => $response, "type" => $type );
    }
    public function deleteRates(Request $request){

        $rate_id = $request->input('rate_id');
        if(!empty($rate_id))
        DB::table('rates')->where('rate_id', '=', $rate_id)->delete();

        return "Success";
    }

    public function setRatesPricing(Request $request){

        //$rate_id = $request->input('rate_id');
        //if(!empty($rate_id))
        //DB::table('rates')->where('rate_id', '=', $rate_id)->delete();

        return "Success";
    }
    public function unsetRatesPricing(Request $request){

        //$rate_id = $request->input('rate_id');
        //if(!empty($rate_id))
        //DB::table('rates')->where('rate_id', '=', $rate_id)->delete();

        return "Success";
    }

    

    public function getRatePricing(){

        $condo_id = $_REQUEST['condo_id'];
        $rate_name = $_REQUEST['name'];
        $sql = "select ratedate_date, rate_name, rate_price_sunday,	rate_price_monday,	rate_price_tuesday,	rate_price_wednesday,	rate_price_thursday,	rate_price_friday,	rate_price_saturday,	rate_min_nights,	rate_price_override from rates r
        join rate_dates d on r.`rate_id` = d.`rate_id`
        where condo_id = ? and rate_name=? and ratedate_date > now()";
        $rows = $this->db->select($sql, [$condo_id, $rate_name]);
        foreach($rows as $row){
            $row->day = strtolower(date("l", strtotime($row->ratedate_date)));
            $priceDay = "rate_price_".$row->day;
            $row->price = $row->$priceDay;
            $data[] = $row;
        }
        return $data;
    }

    public function reservation($id){

        $sql = "select * from orders where order_id = ?";
        $row = $this->db->select($sql, [$id]);
        if(!empty($row)){

            $row = $row[0];
            if($row->order_status == "c"){
                $row->order_status_full = "Complete";
            }
            if($row->order_status == "n"){
                $row->order_status_full = "New";
            }
            if($row->order_status == "p"){
                $row->order_status_full = "Pending";
            }
            $row->order_date_submit = date("m-d-Y H:i", strtotime($row->order_date_submit));
            $row->arrive = date("m/d/Y", strtotime($row->arrive));
            $row->depart = date("m/d/Y", strtotime($row->depart));
            $quote = (array) unserialize($row->quote);
            //dd($quote);
            
            $row->total = isset($quote['total'])?$quote['total']:$quote['Total'];
            
            $sql = "select * from condos c 
            join resorts r on r.`resort_id` = c.`resort_id`";
            $condoRows = $this->db->select($sql, []);
            $resorts = array();
            $condos = array();
            foreach($condoRows as $condo){
                if($condo->condo_id == $row->condo_id){
                    $row->resort = $condo->resort_name;
                    $row->condo = $condo->condo_name;
                    $row->resort_id = $condo->resort_id;
                    $row->condo_id = $condo->condo_id;
                }
                
            }

            $resortRows = $this->db->select("select * from resorts", []);
            foreach($resortRows as $value){
                $resorts[$value->resort_id] = $value->resort_name;
            }
            
            $condoRows = $this->db->select("select * from condos", []);
            foreach($condoRows as $value){
                $condos[$value->condo_id] = $value->condo_name;
            }

            $cchistory = $this->db->select("select * from creditcard_history where reservationnumber = ?  order by id desc", [$row->order_id]);
            $orderhistory = $this->db->select("select * from order_log where orderid = ? order by id desc", [$row->order_id]);
            $countries = $this->db->select("select * from countries", []);
        }
        $templateVars = array("data" => $row, "cchistory" => $cchistory, "orderhistory" => $orderhistory, "id" => $id, "quote" => $quote, "condos" => $condos, "resorts" => $resorts, "countries" => $countries);
        return view('adminassets.reservation')->with( $templateVars );
    }

    public function reservationChange(Request $request, ReservationRates $reservationRates){
       
        $params = array("reservationid", "resort", "condo", "adults", "kids", "start", "stop");  
        foreach($params as $value){    
            $temp[$value] = $request->input($value);
            $$value = $request->input($value);
        }
        $response = (array) $reservationRates->getrate($temp);

        if($request->input('approval') == "true" && $reservationid > 0){
            //record to logs old item
            //update existing quote data set
            $order = $this->db->select("select quote from orders where order_id = ?", [$reservationid]);
            
            DB::table('order_log')->insert(
                ['orderid' => $reservationid, 'info' => 'Pricing Changed Old Pricing was <pre>'.print_r(unserialize($order[0]->quote), true ).'</pre>', 'date' => date("Y-m-d H:i")]
            );

            $start = new DateTime($start);
            $stop = new DateTime($stop);
            //format all dates
            $startFormat = $start->format('Y-m-d');
            $endFormat = $stop->format('Y-m-d');

            DB::table('orders')->where('order_id', $reservationid)->update(
                ['condo_id' => $condo, 'adults' => $adults, 'kids' => $kids, 'arrive'=>$startFormat, 'depart'=>$endFormat, 'quote'=> serialize($response)]
            );

            return json_encode("success");

        }
         
        return json_encode($response);
        
    }
    public function guestChange(Request $request){

        $params = array("last_name", "first_name", "email", "phone_day", "phone_eve", "phone_fax", "address1", "city", "state", "zip", "country");  
        foreach($params as $value){    
            $temp[$value] = $request->input($value);
            $$value = $request->input($value);
        }
        
        $old = $this->db->select("select last_name, first_name, email, phone_day, phone_eve, phone_fax, address1, city, state, zip, country from orders where order_id = ?", [$request->input("reservationid")]);
            
        DB::table('order_log')->insert(
                ['orderid' => $request->input("reservationid"), 'info' => 'Guest Info Changed was <pre>'.print_r($old, true ).'</pre>', 'date' => date("Y-m-d H:i")]
        );
        
        DB::table('orders')->where('order_id', $request->input("reservationid"))->update(
                $temp
        );

        return json_encode("success");
        
    }
    public function creditCardChange(Request $request){
        $params = array("cc_name", "cc_num", "cc_exp", "cc_cvc");  
        foreach($params as $value){    
            $temp[$value] = $request->input($value);
            $$value = $request->input($value);
        }
        
        $old = $this->db->select("select cc_name, cc_num, cc_exp, cc_cvc from orders where order_id = ?", [$request->input("reservationid")]);
            
        DB::table('order_log')->insert(
                ['orderid' => $request->input("reservationid"), 'info' => 'Credit Card Info was <pre>'.print_r($old, true ).'</pre>', 'date' => date("Y-m-d H:i")]
        );
        
        DB::table('orders')->where('order_id', $request->input("reservationid"))->update(
                $temp
        );

        return json_encode("success");
    }

    public function seasonRatesChange(Request $request){

        $subtotal = 0;
        $fees = 0;
        for($a=0; $a < 100; $a++){
            $date = $request->input("Date$a");
            if(isset($date)){
                unset($data);
                $data['Season'] = $request->input("Season$a");
                $data['Price'] = $request->input("Price$a");
                $data['Extra'] = $request->input("Extra$a");
                $data['Total'] = $request->input("Price$a") + $request->input("Extra$a"); 
                
                $temp['Daily'][$date] = $data;
                $subtotal = $subtotal + $request->input("Price$a") + $request->input("Extra$a"); 
            }
            
        }
        $temp['Subtotal'] = $subtotal;

        $params = array("BookingFee", "CleaningFee", "ImpactFee");  
        foreach($params as $value){
            $temp[$value] = $request->input($value);
            $fees = $request->input($value) + $fees;
        }
        $condoId = $request->input("condo");
        $condoInfo = $this->db->select("select * from condos where condo_id=?", [$condoId]);

        //recalculate Tax and Totals
        $temp['Tax'] = ($subtotal  * ( $condoInfo[0]->condo_tax_rate / 100 )) + $fees;
        $temp['Total'] = $temp['Tax'] + $subtotal;
        
        //backup old quote
        $old = $this->db->select("select quote from orders where order_id = ?", [$request->input("reservationid")]);
        $old = unserialize($old[0]->quote);
        DB::table('order_log')->insert(
                ['orderid' => $request->input("reservationid"), 'info' => 'Season Rates changed was <pre>'.print_r($old, true ).'</pre>', 'date' => date("Y-m-d H:i")]
        );
        
        $quote = serialize($temp);
        DB::table('orders')->where('order_id', $request->input("reservationid"))->update(
                ['quote' => $quote]
        );

        return json_encode($temp);
    }


    public function statusChange(Request $request){
       
        $status = $request->input("status");

        $old = $this->db->select("select order_status from orders where order_id = ?", [$request->input("reservationid")]);
            
        DB::table('order_log')->insert(
                ['orderid' => $request->input("reservationid"), 'info' => 'Status changed '.print_r($old, true ), 'date' => date("Y-m-d H:i")]
        );
        
        DB::table('orders')->where('order_id', $request->input("reservationid"))->update(
                ['order_status' => $status]
        );

        return json_encode("success");
    }

    private function getResorts(){
        $sql = "select * from resorts order by resort_name";
        $rows = $this->db->select($sql);
        return $rows;
    }

}
