<?php

namespace App\Libraries;
use App\Libraries\CreditCardHistory;
use Log;
use DB;

/**
 * 
 */
abstract class Merchant
{

    protected $log;
    protected $merchantURL;
    private $table = 'creditcard_history';

    public function __construct(){

    }
 
    public abstract function ChargeCreditCard($order, $authType, $amount, $reservationNumber, $recordHistory);

    protected abstract function logTransaction($reservationNumber, $amount, $details, $additionalDetails);

    public abstract function getReason();

    protected function log($message, $level = 'debug'){

        switch($level){
            case "debug":
                Log::debug($message);
            break;
            case "info":
                Log::info($message);
            break;
            case "error":
                Log::error($message);
            break;
        }
        
    }

    protected function insertCreditCardHistoryRow($reservationNumber, $amount, $details, $additionalDetails){

        DB::table($this->table)->insert([
            'reservationnumber' => $reservationNumber,
            'amount' => $amount,
            'datetime' => date("Y-m-d h:i:s"),
            'merchantdetails' => $details,
            'header' => $additionalDetails,
            'cardinfo' => ''
        ]);

    }


}