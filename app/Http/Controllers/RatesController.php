<?php

namespace App\Http\Controllers;
use App\Libraries\ReservationRates;
use Illuminate\Http\Request;


class RatesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->db = app('db');

    }

    public function getrate(Request $request, ReservationRates $reservationRates)
    {

        //parameters
        $params = array("condo", "adults", "kids", "start", "stop");
        foreach ($params as $key => $value) {
            if (strlen($value) < 15) {
                $temp[$value] = $_REQUEST[$value];

            }

        }

        $rates = $reservationRates->getrate($temp);

        //store the rates set
        $request->session()->put("rates", $rates); 
        $request->session()->put("booking", $temp);

        $reservationInfo['condo'] = $reservationRates->getCondoName($temp['condo']);
        $reservationInfo['resort'] = $reservationRates->getResortNameFromCondoId($temp['condo']);
        $reservationInfo['datesofstay'] = $temp['start']." - ".$temp['stop'];
        $reservationInfo['adults'] = $temp['adults'];
        $reservationInfo['kids'] = $temp['kids'];
        $request->session()->put("reservationInfo", $reservationInfo);

        //call getrate
        return response()->json($rates);


    }



}
