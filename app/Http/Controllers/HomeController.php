<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;
use DB;
use App\Libraries\DirectoryScanFiles;
use App\Libraries\RecursiveDirectory;
use App\Libraries\ScanPictures;
use App\Libraries\DirectoryScan;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {

        $this->db = app('db');

    }

    public function index(Request $request){

        $step1 = array("");
        $step2 = array("fname", "lname", "email", "dayphone", "eveningphone", "fax", "how_did_you_hear");
        $step3 = array("address1", "address2", "city", "state", "zip", "country");
        $step4 = array("card_name", "cc_number", "cc_exp_month", "cc_exp_year", "cc_ccv");
        $step5 = array("instructions");
        $step = $request->input('step');

        //var_dump($request->session()->all());exit;
        switch($request->input('step')){
                case 1:
                    
                    $data = $request->session()->get("step1");
                    foreach($step1 as $key => $value){
                        if(!isset($data[$value])){
                            $data[$value] = "";
                        }
                    }

                break;
                case 2:

                    $data = $request->session()->get("step2");
                    foreach($step2 as $key => $value){
                        if(!isset($data[$value])){
                            $data[$value] = "";
                        }
                    }
                break;
                case 3:
                    //save step2
                    if($request->post() && $request->input('onstep') == 2){
                        foreach($step2 as $key => $value){
                            $itemValue = $request->input($value);
                            $data[$value] = isset($itemValue)?$itemValue:null;
                        } 
                        $request->session()->put("step2", $data); 
                    }

                    $data = $request->session()->get("step3");
                    foreach($step3 as $key => $value){
                        if(!isset($data[$value])){
                            $data[$value] = "";
                        }
                    }
                       
                break;
                case 4:
                    //save step3
                    if($request->post() && $request->input('onstep') == 3){
                        foreach($step3 as $key => $value){
                            $itemValue = $request->input($value);
                            $data[$value] = isset($itemValue)?$itemValue:null;
                        } 
                        $request->session()->put("step3", $data); 
                    }

                    $data = $request->session()->get("step4");
                    foreach($step4 as $key => $value){
                        if(!isset($data[$value])){
                            $data[$value] = "";
                        }
                    }
                break;
                case 5:

                    if( !$request->session()->has('step2') ){
                        return redirect('/?step=1');
                    }
                    //save step4
                    if($request->post() && $request->input('onstep') == 4){
                        foreach($step4 as $key => $value){
                            $itemValue = $request->input($value);
                            $data[$value] = isset($itemValue)?$itemValue:null;
                        } 
                        $request->session()->put("step4", $data); 
                    }

                    $data = $request->session()->get("step5");
                    foreach($step5 as $key => $value){
                        if(!isset($data[$value])){
                            $data[$value] = "";
                        }
                    }

                    //get instructions saved
                    $data['instructions'] = $request->session()->get('instructions');

                    //get property booking information
                    $reservationInfo = $request->session()->get("reservationInfo");
                    $data = array_merge($data, $reservationInfo);
                    
                break; 
                default:
                    $step = 1;
                break;
                            
            }

        $data['step'] = $step;
        return 'NO LONGER IN SERVICE';
        return view('home')->with($data);
    }

    public function getreservationdata(Request $request){

        $reservationInfo = $request->session()->get("reservationInfo");
        dd($reservationInfo);
    }

    public function resorts($resortname, $bedrooms = 1){

        try{
            $view = "resorts";
            $row = 0;
            $found = false;
            if (($handle = fopen(public_path("resort/")."resortinfo.csv", "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    //echo "<p> $num fields in line $data: <br /></p>\n";
                    if($row==0){
                        //skip first line
                        $row++;
                        continue;
                    }
                    $resortnameFile = $data[0];
                    $title = $data[1];
                    $resortprice = $data[2];
                    $bedroomsFile = $data[3];
                    if($resortname == $resortnameFile && $bedrooms == $bedroomsFile){
                        $found = true;
                    }
                    $row++;
                }
                fclose($handle);
            }
            $pictures = $this->getPictures($resortname, $bedrooms);

        }catch(Exception $exception){
            die("error $exception");
        }
        
        if(!$found){
            $view = "resortnotfound";
        }

        return view($view, compact('resort', 'resortname', 'resortprice', 'pictures'));

        $pictures = $this->getPictures($resortname, $bedrooms);

        return view($view, compact('resort', 'resortname', 'resortprice', 'pictures'));
    }

    private function getPictures($resortname, $bedrooms){

        $d = new DirectoryScanFiles();
        return $d->ScanForFiles(public_path()."/resort/images/$resortname/$bedrooms", "public");


    }

    public function getcondos(){

        $resort = (int)$_REQUEST['resort'];
        $key = 'resort'.$resort;

        $data = Cache::remember($key, 5, function () use ($resort) {
            return $this->db->select("select condo_id, condo_name from condos where resort_id = ? order by condo_name", [$resort]);
        });

        return $data;

    }

    public function getresorts(){

        $data = Cache::remember("resorts", 5, function () {
            return $this->db->select("select resort_id, resort_name from resorts where active=1 order by resort_name");
        });

        return $data;

    }
}
