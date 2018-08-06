<?php

namespace App\Libraries;
use DB;


class Order {


    protected $count;

    public function __construct()
    {
        $this->db = app('db');

    }

    public function getOrderById($reservationId){

        if(empty($reservationId)){
            return null;
        }
        $row = DB::table('orders')->select('*')->where('order_id', $reservationId)->first();
        $quote = unserialize($row->quote);
        $row->total = $quote['Total'];
        return $row;

    }

    public function getNewOrdersCount(){
        $this->getNewOrders();
        return $this->count;
    }

    public function getNewOrders(){

        $year = date("Y");
        $rows = DB::table('orders')->select('*')->where('order_status', 'n')->where('order_date_submit', '>', "$year-01-01");
        
        $this->count = $rows->count();
        return $rows->get();
    }

    public function getNewOrdersCountData(){

        $sql = "select 
        count(*) count, 
        month(order_date_submit) as month, 
        year(order_date_submit) as year from orders
        where order_date_submit >= date_sub(DATE_FORMAT(now(), '%Y-01-01'), interval 1 YEAR)
        group by month, year
        order by month, year";
        $rows = $this->db->select($sql);
        foreach ($rows as $row) {
            $count = $row->count;
            $month = $row->month;
            $year = $row->year;
            if ($year == (date("Y") - 1)) {
                $temp[$month] = array("item1" => $count, "month" => $year . "-" . $month, "item2" => 0);

            } else {
                $temp[$month] = array_merge($temp[$month], array("item2" => $count));
            }

        }

        return $temp;

    }




}