<?php

namespace App\Libraries;
use DateTime;
use DB;

class ReservationRates
{

    public function __construct()
    {

        $this->db = app('db');

    }

    public function getrate($params){

        //$parms = array("condo", "adults", "kids", "start", "stop");
        $intParams = array("condo"=>null, "adults"=>null, "kids"=>null);
        if(!is_array($params) || empty($params)){
            dd("params is a required parameter");
        }

        foreach($params as $key=>$value){
            if(array_key_exists($key, $intParams)){
                $$key = (int)$value;
            }else{
                $$key = $value;
            }

        }

        $reservationQuote = (object) null;

        $start = new DateTime($start);
        $stop = new DateTime($stop);

        $today = new DateTime(date("Y-m-d"));
        //diff the start and stop dates
        $interval = $start->diff($stop);
        //diff today and start
        $intervalToday = $start->diff($today);

        //format all dates
        $startFormat = $start->format('Y-m-d');
        $endFormat = $stop->format('Y-m-d');
        $intervalDays = $interval->format('%R%a');
        $intervalTodayDays = $intervalToday->format('%R%a');
        if ( $start == $today || $endFormat == $today) return array( "Error" => "Same day reservations are not allowed. Please choose a later arrival date.");
        if ( $startFormat == $endFormat ) return array( "Error" => "You must stay at least one nights." );
        if ( $intervalDays < 1 ) return array( "Error" => "The departure date must be after the start dates." );
        if ( $intervalTodayDays > 0 ) return array( "Error" => "You cannot book a stay in the past. Please check your arrival and departure dates." );

        $condoInfo = $this->db->select("select * from condos where condo_id=?", [$condo]);
        //Check if total folks exceed max occupancy allowed for condo
        if( ( ($adults + $kids)) > $condoInfo[0]->condo_max_occupancy){
            return array( "Error" => "The maximum occupancy for this condo is {$condoInfo[0]->condo_max_occupancy} guests." );
        }
        //Check min occupancy
        if( ($adults + $kids) < $condoInfo[0]->condo_min_occupancy){
            return array( "Error" => "The minimum occupancy for this condo is {$condoInfo[0]->condo_min_occupancy} guests." );
        }

        $condoRestrictions = $this->db->select("select * from agegroup_restrictions where condo_id=?", [$condo]);
        $extraFees = (double) 0;
        //check condo restrictions
        foreach($condoRestrictions as $value){
            //if the number of adults or children exceed the free limit then add extra fees.
            if ( $adults > $value->restriction_num_free && $value->agegroup_id == 1 ) {
                $extraFees += $value->restriction_extra_fee * ( $adults - $value->restriction_num_free);
            }
            if ( $kids > $value->restriction_num_free && $value->agegroup_id == 2 ) {
                $extraFees += $value->restriction_extra_fee * ( $kids - $value->restriction_num_free);
            }
        }


        //check the min night stay if between certain special dates
        $rates = $this->db->select("select * from rates r join rate_dates d on r.`rate_id` = d.`rate_id` where r.condo_id=? and ratedate_date between ? and ? order by d.ratedate_date desc", [$condo, $startFormat, $endFormat]);
        $travelDates = $this->getTravelDates($start, $stop);
        $overrideRate = (double) 0;
        $counter = 0;
        foreach($travelDates as $travelDate){
            //echo "<pre>";var_dump($rates); exit;

            foreach($rates as $rate){

                if(  $rate->ratedate_date == $travelDate  ){

                    if(!empty($rate->rate_min_nights) && $interval->format('%a') < $rate->rate_min_nights)
                        return array( "Error" => "The requested dates occur during a season that requires a {$rate->rate_min_nights} night minimum stay. Please select a different departure date." );

                    if ( $rate->rate_price_override == "y" ) {
                        //either it's the min rate nights or it's the condo min nights
                        $overrideRequiredNights = !empty( $rate->rate_min_nights ) ? $rate->rate_min_nights : $condoInfo[0]->condo_min_nights;
                        $dayofweek = strtolower(date("l", strtotime($travelDate)));
                        $rateDay = "rate_price_".$dayofweek;
                        $overrideRate = (double) $rate->$rateDay;
                    }else{
                        $overrideRate = (double) $condoInfo[0]->condo_fee_booking;
                        $dayofweek = strtolower(date("l", strtotime($travelDate)));
                        $overrideRequiredNights = $condoInfo[0]->condo_min_nights;
                    }
                    $rateName = $rate->rate_name;
                }


            }
            
            $travelRates[$counter]['Season'] = isset($rateName)?$rateName:null;
            $travelRates[$counter]['Day_of_week'] = ucfirst($dayofweek);
            $travelRates[$counter]['Price'] = number_format($overrideRate, 2);
            $travelRates[$counter]['Extra'] = number_format($extraFees, 2);
            $travelRates[$counter]['Total'] = number_format($overrideRate + $extraFees, 2);
            $travelRates[$counter]['Date'] = date("m-d-Y", strtotime($travelDate));
            $counter++;
        }

        //check condo min night stay
        if ( count($travelDates) < $overrideRequiredNights ) return array( "Error" => "This condo requires a {$overrideRequiredNights} night minimum stay. Please choose a different departure date." );

        $subtotal = (double) 0;
        foreach($travelRates as $travelRate){
            $subtotal += (double)$travelRate['Total'];
        }

        //calculate condo fees
        $tax = $subtotal * ( $condoInfo[0]->condo_tax_rate / 100 );
        $impactFee = $condoInfo[0]->condo_fee_impact * count($travelDates);
        $bookingFee = $condoInfo[0]->condo_fee_booking;
        $cleaningFee = $condoInfo[0]->condo_fee_cleaning;

        $reservationQuote->Daily = $travelRates;
        $reservationQuote->BookingFee = $bookingFee;
        $reservationQuote->CleaningFee = $cleaningFee;
        $reservationQuote->ImpactFee = $impactFee;
        $reservationQuote->Tax = number_format($tax, 2);
        $reservationQuote->Total = number_format($subtotal + $tax + $impactFee + $bookingFee + $cleaningFee, 2);
        $reservationQuote->Subtotal = number_format($subtotal, 2);
        

        return $reservationQuote;

    }


    /**
     * Returns all travel dates between two dates
     * @param $start
     * @param $stop
     * @return Array travel dates
     */
    private function getTravelDates($start, $end){

        //$end = $end->modify( '+1 day' );
        $dateRange = new \DatePeriod(
            $start,
            new \DateInterval('P1D'),
            $end
        );

        foreach ($dateRange as $date) {
            $range[] = $date->format("Y-m-d");
        }
        return $range;
    }

    public function getCondoName($condoId){

        $condo = $this->db->select("select condo_name from condos where condo_id=?", [$condoId]);
        return $condo[0]->condo_name;
    }
    public function getResortNameFromCondoId($condoId){
        
        $resort = $this->db->select("select r.resort_name from condos c join resorts r on c.`resort_id` = r.`resort_id` where condo_id=?", [$condoId]);
        return $resort[0]->resort_name;
    }

}