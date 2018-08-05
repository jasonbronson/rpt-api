<?php

namespace App\Libraries;
use DB;


class Resort {


    public function __construct()
    {
        $this->db = app('db');

    }

    public function getOrderById($reservationId){

        $row = DB::table('orders')->select('*')->where('order_id', $reservationId)->get();
        return $row;

    }


}