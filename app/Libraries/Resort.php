<?php

namespace App\Libraries;
use DB;


class Resort {


    public function __construct()
    {
        $this->db = app('db');

    }

    public function getResorts(){

        $rows = DB::table('resorts')->select('resort_id', 'resort_name')
        ->where('active', '1')
        ->orderBy('resort_name', 'asc')->get();
        foreach($rows as $row){
            $resorts[$row->resort_id] = $row->resort_name;
        }
        return $resorts;

    }

    public function getResort($reservationId){

        $row = DB::table('resorts')->select('*')->where('resort_id', $reservationId)->get();
        return $row;

    }

    



}