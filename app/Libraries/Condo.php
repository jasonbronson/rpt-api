<?php

namespace App\Libraries;
use DB;


class Condo {


    public function __construct()
    {
        $this->db = app('db');

    }

    public function getCondos($resortId){

        $rows = DB::table('condos')->select('condo_id', 'condo_name')
        ->where('resort_id', $resortId)
        ->orderBy('condo_name', 'asc')->get();
        foreach($rows as $row){
            $condos[$row->condo_id] = $row->condo_name;
        }
        return $condos;

    }

    public function getCondo($reservationId){

        $row = DB::table('resorts')->select('*')->where('resort_id', $reservationId)->get();
        return $row;

    }

    



}