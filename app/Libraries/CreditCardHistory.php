<?php

namespace App\Libraries;
use DB;

class CreditCardHistory {


    protected $count;
    protected $table = 'creditcard_history';    

    public function __construct()
    {

    }

    public function getAll($reservationId){

        $rows = DB::table($this->table)->select('*')->where('reservationnumber', $reservationId)->orderBy('id', 'desc')->get();
        return $rows;

    }


    public function addItem($data){

        DB::table($this->table)->insert($data);

    }




}