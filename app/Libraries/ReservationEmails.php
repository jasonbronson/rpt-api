<?php
namespace App\Libraries;

//use Log;
use DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\Reservation;


class ReservationEmails{

    public function __construct(){
        $this->db = app('db');
    }

    public function sendEmails($order){
        $templates = $this->db->select("select n.`notification_id`, n.`notification_name`, n.`notification_type`, n.`notification_subject`, n.`notification_content`, e.`email` from res_notifications n join res_notification_emails e on e.`notification_id` = n.`notification_id`");
        foreach($templates as $row){
            $subject = $row->notification_subject;
            $content = $row->notification_content;
            $items = array("%%first_name%%","%%last_name%%","%%email%%","%%phone_day%%","%%phone_eve%%","%%phone_fax%%","%%adults%%","%%kids%%","%%condo%%","%%resort%%","%%arrive%%","%%depart%%",
            "%%heard_from%%","%%instructions%%","%%cc_type%%","%%cc_num%%","%%cc_exp%%", "%%cc_exp_month%%","%%cc_exp_year%%","%%cc_cvc%%","%%cc_name%%","%%address1%%", "%%address2%%","%%city%%","%%state%%",
            "%%zip%%","%%agree_policies%%","%%ip%%","%%ip%%","%%user_agent%%","%%now_date%%","%%now_time%%","%%subtotal%%","%%tax%%","%%booking%%","%%cleaning%%","%%impact%%","%%total%%");
            foreach($items as $find){
                $replace = str_replace("%", "", $find);
                $value = isset($order[$replace])?$order[$replace]:"";
                $content = str_replace($find, $value, $content);
                if($replace == "resort"){
                    $subject = $value;
                }
            }
            
            $id = $row->notification_id;
            $email = $row->email;
            $emailData = array("subject" => $subject, "content" => $content); 
            Mail::to($email)->send(new Reservation($emailData, $row->notification_id));
            Log::debug("SendEmail: to $email ".print_r($emailData, true) );
        }

    }


}