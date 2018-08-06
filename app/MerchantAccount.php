<?php

namespace App;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Notifications\NotifyErrors;
use App\Popo\Errors;
use App\Libraries\Merchant;

/**
 * Old Merchant
 */
class MerchantAccount extends Merchant
{

    const MERCHANT_URL = "https://secure.fasttransact.com:1402/gw/sas/direct3.1?";
    private $reason;

    public function ChargeCreditCard($order, $authType = "A", $amount = "1.00", $reservationNumber = 0, $recordHistory = false, $username = "", $description = ""){

        if(is_object($order)){
            $order = (array) $order;
        }
        //$this->log("Order Data ".print_r($order, true), "debug");

        $url['card_number'] = $order['cc_num'];
        $url['card_expire'] = date("my", strtotime($order['cc_exp']) );
        $this->log("Expire {$url['card_expire']}");
        $url['cust_ip'] = $order['ip'];
        $url['amount'] = $amount;

        if($url['card_number']=="4222222222222222"){
            $url['amount'] = "1.11";
            $url['card_number'] = "4444333322221111";
            $url['card_expire'] = "1024";
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
        $url['tran_type'] = $authType;
        $url['account_id'] = env('MERCHANT1_ACCOUNT_ID');

        $merchantParams = http_build_query($url);
        $this->log($merchantParams, "debug");
        $client = new Client(); //GuzzleHttp\Client
        $res = $client->get(self::MERCHANT_URL.$merchantParams, ['http_errors' => false]);
        $this->reason = $res->getReasonPhrase();

        if($res->getStatusCode() == 200 && strpos($this->reason, "Approved") !== false){
            if($recordHistory){
                $this->logTransaction($reservationNumber, $amount, $this->getReason(), "$description Charge Type $authType, APPROVED TRANSACTION  [By User $username] ");
            }
            return true;
        }else{
            if($recordHistory){
                $this->logTransaction($reservationNumber, $amount, $this->getReason(), "$description Charge Type $authType, [By User $username] ");
            }
            $this->log($this->reason);
            \Notification::send(Users::first(), new NotifyErrors($this->reason." ".$merchantParams));
            return false;
        }


    }

    public function logTransaction($reservationNumber, $amount, $details, $additionalDetails){
            $this->insertCreditCardHistoryRow($reservationNumber, $amount, $details, $additionalDetails);
    }
        
    public function getReason(){
        return $this->reason;
    }

}