<?php

namespace App\Http\Controllers\AppMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class MessMainController extends Controller
{
    public function select_mess($enum , $id , $auth){
        return view('app_mobile.select_mess' , compact('enum','id','auth'));
    }
    public function dashboard(){
        return view('app_mobile.dashboard');
    }
    public function messing(){
        return view('app_mobile.messing');
    }
    public function extra_messing(){
        return view('app_mobile.extra_messing');
    }
    public function bar(){
        return view('app_mobile.bar');
    }
    public function mess_bill(){
        return view('app_mobile.mess_bill');
    }
    public function summary(){
        return view('app_mobile.summary');
    }



    // AUTHENTICATE USER DETAILS //
    public function user_authenticate(Request $req){
           
        Cookie::queue( // Delete Previous Cookies
            Cookie::forget('enum'),
            Cookie::forget('officer_id'),
            Cookie::forget('mess_id'),
        );

        $enum = $req->enum;
        $officer_id = $req->id;
        $auth_code = $req->auth;

        //Encrypt
        $last_4_digits_of_enum = substr($enum,-4); 
        $my_encryption = ($last_4_digits_of_enum + $officer_id) * 11; 
        $hash = sha1($my_encryption);

        if ($auth_code == $hash) { // Auth Success

            $mess_data = DB::table('officers_assigns')
            ->select('messes.id','messes.name','messes.location')
            ->join('messes','officers_assigns.mess_id','=','messes.id')
            ->where('officers_assigns.enum','=',"{$enum}")
            ->where('officers_assigns.status','=',"1")
            ->where('messes.version','=',"1")
            ->get();

            if(!count($mess_data) == 0) { // Has data
                $output = '<option selected>Select the Mess</option>';
                foreach ($mess_data as $data) {
                    $output .= "<option value='{$data->id}'> {$data->name} : {$data->location} </option>";
                }
                echo $output;

                Cookie::queue('enum', $enum , 60*24); // Set Cookie // 24 hours
                Cookie::queue('officer_id', $officer_id , 60*24);
            }
            else{ // No data
                echo 'No data';
            }

        }

        else{  // Auth Fail
           echo 'Authentication fail';
        }
    }



    // Set MessID in Cookie
    public function set_mess_id(Request $req){
        Cookie::queue('mess_id', $req->mess_id , 60*24); // Set Cookie // 24 hours
    }
    


    // Get and Display Personal Details
    public function personal_details(Request $req){

        $enum = Cookie::get('enum');

        $officer_details = DB::table('users')->select( 'name' , 'service_no' , 'email' , 'rank' , 'regiment')
        ->where('email' , $enum)
        ->get();

        $output = '';
        foreach ($officer_details as $data) {
            $output .= " <p class='officer_id' id='officer_id'><span class='officer_enum' id='officer_enum'>E-Number: {$enum}</span><span class='officer_name' id='officer_name'>{$data->rank}. {$data->name} - {$data->regiment}</span></span></p> ";
        }
        echo $output; 

    }
    // AUTHENTICATE USER DETAILS //




    // Link Generator
    public function gen(){
        return view('app_mobile.generate_link');
    }
    public function gen_func(Request $req){

        $last_4_digits_of_enum = substr($req->enumber,-4); 
        $my_encryption = ($last_4_digits_of_enum + $req->id) * 11; 
        // dd($my_encryption);
        $hash = sha1($my_encryption);

        echo "http://127.0.0.1:8000/app_mobile/select_mess/$req->enumber/$req->id/{$hash} </br></br>" ;
        echo "https://172.16.60.28/omms/test2/public/app_mobile/select_mess/$req->enumber/$req->id/{$hash} </br></br>" ;
        echo "https://net.army.lk/omms/app_mobile/select_mess/$req->enumber/$req->id/{$hash}" ;
    }
    // Link Generator


}



