<?php

namespace App\Http\Controllers\AppMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class MessAppController extends Controller
{
    // STATUS MESSING
    public function get_status_messing(Request $req){

        $enum = Cookie::get('enum');
        $mess_id = Cookie::get('mess_id');
        
        $item_names = DB::table('notifications')
        ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 
        'notifications.order_breakfast as breakfast_status' , 'notifications.order_lunch as lunch_status', 'notifications.order_dinner as dinner_status', )
        ->join('mess_orders','notifications.mess_order_id','=','mess_orders.id')
        ->where('mess_orders.mess_id','=', $mess_id)
        ->where('mess_orders.officer_id','=', $enum)
        ->where('mess_orders.rtaion_date','=', $req->date_value)
        ->where('mess_orders.deleted_at','=', null)
        ->get();

        if ($item_names->count() > 0) { // Has Record
            foreach ($item_names as $item) {
                return response()->json($item);
            }
        }
        else{ // No Record
            return response()->json('nodata');
        }
    }
    // STATUS MESSING 




    //// MENU DETAILS //// 
    public function menu_breakfast(Request $req){

        $mess_id = Cookie::get('mess_id');
        $menu = DB::select(" SELECT mess_menu_items.item_name FROM mess_menu_items INNER JOIN mess_menus ON mess_menu_items.id = mess_menus.item_id INNER JOIN mess_daily_rations INNER JOIN mess_menu_details ON mess_menus.mess_menu_id = mess_menu_details.id AND mess_daily_rations.mess_menu_id = mess_menu_details.id WHERE mess_daily_rations.ration_date = '$req->date' AND mess_menu_details.meal_type = '1' AND mess_daily_rations.meal_time = 'breakfast' AND mess_daily_rations.mess_id = '$mess_id' AND mess_menu_items.status = '1' " );

        foreach($menu as $items){
            echo "<span><i></i>" . $items->item_name . "</span>";
        }
    }

    public function menu_lunch(Request $req){

        $mess_id = Cookie::get('mess_id');
        $menu = DB::select(" SELECT mess_menu_items.item_name FROM mess_menu_items INNER JOIN mess_menus ON mess_menu_items.id = mess_menus.item_id INNER JOIN mess_daily_rations INNER JOIN mess_menu_details ON mess_menus.mess_menu_id = mess_menu_details.id AND mess_daily_rations.mess_menu_id = mess_menu_details.id WHERE mess_daily_rations.ration_date = '$req->date' AND mess_menu_details.meal_type = '1' AND mess_daily_rations.meal_time = 'lunch' AND mess_daily_rations.mess_id = '$mess_id' AND mess_menu_items.status = '1' ");

        foreach($menu as $items){
            echo "<span><i></i>" . $items->item_name . "</span>";
        }
    }
    
    public function menu_dinner(Request $req){

        $mess_id = Cookie::get('mess_id');
        $menu = DB::select(" SELECT mess_menu_items.item_name FROM mess_menu_items INNER JOIN mess_menus ON mess_menu_items.id = mess_menus.item_id INNER JOIN mess_daily_rations INNER JOIN mess_menu_details ON mess_menus.mess_menu_id = mess_menu_details.id AND mess_daily_rations.mess_menu_id = mess_menu_details.id WHERE mess_daily_rations.ration_date = '$req->date' AND mess_menu_details.meal_type = '1' AND mess_daily_rations.meal_time = 'dinner' AND mess_daily_rations.mess_id = '$mess_id' AND mess_menu_items.status = '1' ");

        foreach($menu as $items){
            echo "<span><i></i>" . $items->item_name . "</span>";
        }
    }
    //// MENU DETAILS //// 



    //// DESSERT DETAILS //// 
    public function dessert_breakfast(Request $req){

        $mess_id = Cookie::get('mess_id');
        $dessert = DB::select(" SELECT mess_menu_items.item_name FROM mess_daily_rations INNER JOIN mess_menu_items ON mess_daily_rations.dessert_item_id = mess_menu_items.id WHERE mess_daily_rations.ration_date = '$req->date' AND mess_daily_rations.meal_time = 'breakfast' AND mess_daily_rations.mess_id = '$mess_id'  ");

        foreach($dessert as $items){
            echo $items->item_name;
        }
    }

    public function dessert_lunch(Request $req){

        $mess_id = Cookie::get('mess_id');
        $dessert = DB::select(" SELECT mess_menu_items.item_name FROM mess_daily_rations INNER JOIN mess_menu_items ON mess_daily_rations.dessert_item_id = mess_menu_items.id WHERE mess_daily_rations.ration_date = '$req->date' AND mess_daily_rations.meal_time = 'lunch' AND mess_daily_rations.mess_id = '$mess_id' ");

        foreach($dessert as $items){
            echo $items->item_name;
        }
    }

    public function dessert_dinner(Request $req){

        $mess_id = Cookie::get('mess_id');
        $dessert = DB::select(" SELECT mess_menu_items.item_name FROM mess_daily_rations INNER JOIN mess_menu_items ON mess_daily_rations.dessert_item_id = mess_menu_items.id WHERE mess_daily_rations.ration_date = '$req->date' AND mess_daily_rations.meal_time = 'dinner' AND mess_daily_rations.mess_id = '$mess_id'  ");

        foreach($dessert as $items){
            echo $items->item_name;
        }
    }
    //// DESSERT DETAILS //// 



    //// PRICE DETAILS //// 
    public function price_breakfast(Request $req){

        $mess_id = Cookie::get('mess_id');
        $price = DB::select(" SELECT mess_daily_rations.tentative_price FROM mess_daily_rations WHERE mess_daily_rations.ration_date = '$req->date' AND mess_daily_rations.meal_time = 'breakfast' AND mess_daily_rations.mess_id = '$mess_id' ");

        foreach($price as $prc){
            echo $prc->tentative_price;
        }
    }

    public function price_lunch(Request $req){

        $mess_id = Cookie::get('mess_id');
        $price = DB::select(" SELECT mess_daily_rations.tentative_price FROM mess_daily_rations WHERE mess_daily_rations.ration_date = '$req->date' AND mess_daily_rations.meal_time = 'lunch' AND mess_daily_rations.mess_id = '$mess_id' ");

        foreach($price as $prc){
            echo $prc->tentative_price;
        }
    }

    public function price_dinner(Request $req){

        $mess_id = Cookie::get('mess_id');
        $price = DB::select(" SELECT mess_daily_rations.tentative_price FROM mess_daily_rations WHERE mess_daily_rations.ration_date = '$req->date' AND mess_daily_rations.meal_time = 'dinner' AND mess_daily_rations.mess_id = '$mess_id' ");

        foreach($price as $prc){
            echo $prc->tentative_price;
        }
    }
    //// PRICE DETAILS //// 




    //// TIME DETAILS //// 
    public function time_breakfast(){

        $mess_id = Cookie::get('mess_id');
        $time_before = DB::select(" SELECT for_breakfast FROM meal_order_times WHERE mess_id = '$mess_id' ");

        foreach($time_before as $data){
            $timeFormat = Carbon::parse($data->for_breakfast)->format("H:i");
            echo $timeFormat;
        }
    }

    public function time_lunch(){

        $mess_id = Cookie::get('mess_id');
        $time_before = DB::select(" SELECT for_lunch FROM meal_order_times WHERE mess_id = '$mess_id' ");

        foreach($time_before as $data){
            $timeFormat = Carbon::parse($data->for_lunch)->format("H:i");
            echo $timeFormat;
        }
    }

    public function time_dinner(){

        $mess_id = Cookie::get('mess_id');
        $time_before = DB::select(" SELECT for_dinner FROM meal_order_times WHERE mess_id = '$mess_id' ");

        foreach($time_before as $data){
            $timeFormat = Carbon::parse($data->for_dinner)->format("H:i");
            echo $timeFormat;
        }
    }
    //// TIME DETAILS //// 




    // SAVE - MESSING ALL
    public function save_messing_all(Request $req){

        $mess_id = Cookie::get('mess_id');
        $enum = Cookie::get('enum');
        $timeNow = Carbon::now();
        $timeNowFormat = Carbon::parse($timeNow)->format("Y-m-d");


        // Notifications
        $order_breakfast_noti = null;
        $order_lunch_noti = null;
        $order_dinner_noti = null;

        if ($req->breakfast > 0) {
            $order_breakfast_noti = 0;
        }
        if ($req->lunch > 0) {
            $order_lunch_noti = 0;
        }
        if ($req->dinner > 0) {
            $order_dinner_noti = 0;
        }


        // Check Data Exists For Selected Ration Date
        $checkDataExist = DB::table('mess_orders')
        ->select('mess_orders.id', 'mess_orders.deleted_at', 'mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.order_breakfast_status', 'mess_orders.order_lunch_status', 'mess_orders.order_dinner_status', 'notifications.order_lunch as order_lunch_noti', 'notifications.order_dinner as order_dinner_noti', 'notifications.order_breakfast as order_breakfast_noti')
        ->join('notifications','mess_orders.id','=','notifications.mess_order_id')
        ->where('mess_id' , $mess_id)
        ->where('officer_id' , $enum )
        ->where('rtaion_date' , $req->ajax_date_value )
        ->latest('mess_orders.id')
        ->first();

        if (isset($checkDataExist->id) != "" ) { // Alredy placed a order for selected ration date

            if ($checkDataExist->deleted_at == "" || $checkDataExist->deleted_at == null ) { // Not deleted // Update Data
           
                $breakfast_new_value = 0;
                $lunch_new_value = 0;
                $dinner_new_value = 0;

                $breakfast_new_status_value = 0;
                $lunch_new_status_value = 0;
                $dinner_new_status_value = 0; 

                $breakfast_new_noti_value = null;
                $lunch_new_noti_value = null;
                $dinner_new_noti_value = null; 


                // breakfast has a updated value
                if ($req->breakfast == 0) { 
                    $breakfast_new_value = $checkDataExist->order_breakfast; // Get Existing value from DB
                    $breakfast_new_status_value = $checkDataExist->order_breakfast_status;
                    $breakfast_new_noti_value = $checkDataExist->order_breakfast_noti;
                }
                elseif ($checkDataExist->order_breakfast != $req->breakfast) { // breakfast has a updated value
                    $breakfast_new_value = $req->breakfast; // Get User Input value
                    $breakfast_new_status_value = '1';
                    $breakfast_new_noti_value = '0';

                }
                else{
                    $breakfast_new_value = $checkDataExist->order_breakfast; // Get Existing value from DB
                    $breakfast_new_status_value = $checkDataExist->order_breakfast_status;
                    $breakfast_new_noti_value = $checkDataExist->order_breakfast_noti;
                }

                // lunch has a updated value
                if ($req->lunch == 0) { 
                    $lunch_new_value = $checkDataExist->order_lunch; // Get Existing value from DB
                    $lunch_new_status_value = $checkDataExist->order_lunch_status;
                    $lunch_new_noti_value = $checkDataExist->order_lunch_noti;
                }
                elseif ($checkDataExist->order_lunch != $req->lunch) { // lunch has a updated value
                    $lunch_new_value = $req->lunch; // Get User Input value
                    $lunch_new_status_value = '1';
                    $lunch_new_noti_value = '0';
                }
                else{
                    $lunch_new_value = $checkDataExist->order_lunch; // Get Existing value from DB
                    $lunch_new_status_value = $checkDataExist->order_lunch_status;
                    $lunch_new_noti_value = $checkDataExist->order_lunch_noti;
                }

                // dinner has a updated value
                if ($req->dinner == 0) { 
                    $dinner_new_value = $checkDataExist->order_dinner; // Get Existing value from DB
                    $dinner_new_status_value = $checkDataExist->order_dinner_status;
                    $dinner_new_noti_value = $checkDataExist->order_dinner_noti;
                }
                elseif ($checkDataExist->order_dinner != $req->dinner) { // dinner has a updated value
                    $dinner_new_value = $req->dinner; // Get User Input value
                    $dinner_new_status_value = '1';
                    $dinner_new_noti_value = '0';
                }
                else{
                    $dinner_new_value = $checkDataExist->order_dinner; // Get Existing value from DB
                    $dinner_new_status_value = $checkDataExist->order_dinner_status;
                    $dinner_new_noti_value = $checkDataExist->order_dinner_noti;
                }

            
                $UpdateData = DB::select(" UPDATE mess_orders SET 
                order_breakfast = '{$breakfast_new_value}', 
                order_lunch = '{$lunch_new_value}', 
                order_dinner = '{$dinner_new_value}',
                order_breakfast_status = {$breakfast_new_status_value},
                order_lunch_status = {$lunch_new_status_value}, 
                order_dinner_status = {$dinner_new_status_value}
                WHERE mess_id = '{$mess_id}' 
                AND officer_id = '{$enum}' 
                AND rtaion_date = '{$req->ajax_date_value}' 
                AND deleted_at IS NULL ");

                if ($UpdateData > 0) {
                    echo 'The order has been updated successfully';
                }

                //Save in notifications table
                $lastMessOrderId = DB::table('mess_orders')
                ->orderBy('id', 'DESC')
                ->where('mess_id' , $mess_id)
                ->where('officer_id' , $enum )
                ->where('rtaion_date' , $req->ajax_date_value )
                ->first(); // Get last mess order ID

                $NotificationsSave = DB::table('notifications')->updateOrInsert(
                    [ 'mess_order_id' => $lastMessOrderId->id ] , // If there is a date like $mess_order_id, update data, otherwise insert 
                    [ 'order_breakfast' => $breakfast_new_noti_value,
                      'order_lunch' => $lunch_new_noti_value,
                      'order_dinner' => $dinner_new_noti_value,
                    // 0 = pending order/notification visible
                    // 1 = oder confirmed/notification hidden
                    // null = order cancelled
                ]);        
            }
            else{ // Deleted record // Insert Data

                $InsertData = DB::table('mess_orders')->insert([
                    'mess_id' => $mess_id,
                    'officer_id' => $enum,
                    'order_breakfast' => $req->breakfast,
                    'order_lunch' => $req->lunch,
                    'order_dinner' => $req->dinner,
                    'order_breakfast_status' => $req->breakfast_status,  // 1 = active orders // 0 = cancel orders
                    'order_lunch_status' => $req->lunch_status, 
                    'order_dinner_status' => $req->dinner_status, 
                    'ordered_date' => $timeNowFormat, 
                    'rtaion_date' => $req->ajax_date_value, 
                    'created_by' => $enum,
                    'ip' => $req->ip()
                ]);
                if ($InsertData > 0) {
                    echo 'The order has been placed successfully';
                }

                //Save in notifications table
                $lastMessOrderId = DB::table('mess_orders')->orderBy('id', 'DESC')->first(); // Get last mess order ID

                $NotificationsSave = DB::table('notifications')->updateOrInsert(
                    [ 'mess_order_id' => $lastMessOrderId->id ] , // If there is a date like $mess_order_id, update data, otherwise insert 
                    [ 'order_breakfast' => $order_breakfast_noti,
                      'order_lunch' => $order_lunch_noti,
                      'order_dinner' => $order_dinner_noti,
                    // 0 = pending order/notification visible
                    // 1 = oder confirmed/notification hidden
                    // null = order cancelled
                ]); 

            }
        }
        else{ // Not placed a order for selected ration date // Insert

            $InsertData = DB::table('mess_orders')->insert([
                'mess_id' => $mess_id,
                'officer_id' => $enum,
                'order_breakfast' => $req->breakfast,
                'order_lunch' => $req->lunch,
                'order_dinner' => $req->dinner,
                'order_breakfast_status' => $req->breakfast_status,  // 1 = active orders // 0 = cancel orders
                'order_lunch_status' => $req->lunch_status, 
                'order_dinner_status' => $req->dinner_status, 
                'ordered_date' => $timeNowFormat, 
                'rtaion_date' => $req->ajax_date_value, 
                'created_by' => $enum,
                'ip' => $req->ip()
            ]);

            //Save in notifications table
            $lastMessOrderId = DB::table('mess_orders')->orderBy('id', 'DESC')->first(); // Get last mess order ID

            $NotificationsSave = DB::table('notifications')->updateOrInsert(
                [ 'mess_order_id' => $lastMessOrderId->id ] , // If there is a date like $mess_order_id, update data, otherwise insert 
                [ 'order_breakfast' => $order_breakfast_noti,
                    'order_lunch' => $order_lunch_noti,
                    'order_dinner' => $order_dinner_noti,
                // 0 = pending order/notification visible
                // 1 = oder confirmed/notification hidden
                // null = order cancelled
            ]); 

            if ($InsertData > 0) {
                echo 'The order has been placed successfully';
            }
            else{
                echo 'The order has been already placed';
            }
        }
    }
    // SAVE - MESSING ALL










    // EXTRA MESSING

    public function extra_messing_names(Request $req){

        $mess_id = Cookie::get('mess_id');
        $item_names = DB::table('mess_menu_items') // Get Extra messing items names. (Not included empty price item names)
        ->select('mess_menu_items.id', 'mess_menu_items.item_name')
        ->join('mess_menu_item_prices','mess_menu_items.id','=','mess_menu_item_prices.item_id')
        ->whereIn('category_id',['2','3'])
        ->where('mess_menu_items.mess_id','=', $mess_id)
        ->where('mess_menu_item_prices.mess_id','=', $mess_id)
        ->where('mess_menu_items.status','=',1)
        ->get();

        $output = '<option selected>Select the Item</option>';
        foreach ($item_names as $items) {
            $output .= "<option value='{$items->id}'> {$items->item_name} </option>";
        }
        echo $output;
    }

    

    public function extra_messing_price(Request $req){
        
        $mess_id = Cookie::get('mess_id');
        $item_names = DB::table('mess_menu_item_prices')->select( 'price' )
        ->where('mess_id' , $mess_id)
        ->where('item_id' , $req->item_id )
        ->get();

        if ($item_names->count() > 0) {
            echo $item_names[0]->price;
        }
        else{
            echo 'Select the Item';  
        }
    }


    public function extra_messing_save(Request $req){

        $mess_id = Cookie::get('mess_id');
        $enum = Cookie::get('enum');
        
        $extra_messing = DB::table('extra_orders')->insert([
            'mess_id' => $mess_id,
            'officer_id' => $enum,
            'item_id' => $req->ajax_item_id,
            'meal_time' => $req->ajax_meal_time,
            'qty' => $req->ajax_qty,
            'price' => $req->ajax_price,
            'ordered_date' => $req->ajax_date_value,
            'note' => $req->ajax_note,
            'ip' => $req->ip(),
            'status' => '1',
        ]);

        if ($extra_messing) {
            echo 'The order has been placed successfully';
        }

    }

    // EXTRA MESSING





    // TEA

    public function tea_names(Request $req){
        
        $mess_id = Cookie::get('mess_id');
        $item_names = DB::table('mess_menu_items') // Get tea items names. (Not included empty price item names)
        ->select('mess_menu_items.id', 'mess_menu_items.item_name')
        ->join('mess_menu_item_prices','mess_menu_items.id','=','mess_menu_item_prices.item_id')
        ->whereIn('category_id',['4'])
        ->where('mess_menu_items.mess_id','=', $mess_id)
        ->where('mess_menu_item_prices.mess_id','=', $mess_id)
        ->where('mess_menu_items.status','=',1)
        ->get();

        $output = '<option selected>Select the Item</option>';
        foreach ($item_names as $items) {
            $output .= "<option value='{$items->id}'> {$items->item_name} </option>";
        }
        echo $output;
    }


    public function tea_price(Request $req){
        
        $mess_id = Cookie::get('mess_id');
        $item_names = DB::table('mess_menu_item_prices')->select( 'price' )
        ->where('mess_id' , $mess_id)
        ->where('item_id' , $req->ajax_tea_id )
        ->orderBy('created_at','desc') // get the latest price
        ->get();
        
        if ($item_names->count() > 0) {
            echo $item_names[0]->price;
        }
        else{
            echo 'Select the Item';  
        }
    }


    public function tea_save(Request $req){

        $enum = Cookie::get('enum');
        $mess_id = Cookie::get('mess_id');

        $extra_messing = DB::table('extra_orders')->insert([
            'mess_id' => $mess_id,
            'officer_id' => $enum,
            'item_id' => $req->ajax_item_id,
            'meal_time' => $req->ajax_type,
            'qty' => $req->ajax_qty,
            'price' => $req->ajax_price,
            'ordered_date' => $req->ajax_date_value,
            'note' => $req->ajax_note,
            'ip' => $req->ip(),
            'status' => '1',
        ]);

        if ($extra_messing) {
            echo 'The order has been placed successfully';
        }

    }
    // TEA






    // BAR 

    public function bar_item_names(){

        $mess_id = Cookie::get('mess_id');

        $item_names = DB::table('items')
        ->select( 'items.code' , 'items.name', 'measure_units.abbreviation')
        ->join('cat_item','items.id','=','cat_item.item_id')
        ->join('categories','cat_item.category_id','=','categories.id')
        ->join('measure_units','items.measure_unit_id','=','measure_units.id')
        ->where('items.establishment_id','=', $mess_id)
        ->where('categories.code','=','bar_item')
        ->where('items.active','=','1')
        ->get();

        $output = '<option selected>Select the Item</option>';
        foreach ($item_names as $items) {
            $output .= "<option value='{$items->code}'> {$items->name} ({$items->abbreviation})</option>";
        }
        echo $output;
        
    }


    public function bar_item_prices(Request $req){

        $mess_id = Cookie::get('mess_id');

        $item_names = DB::table('items')
        ->select('*', 'stocks.qty', 'g_r_n_details.unit_price')
        ->join('g_r_n_details','items.id','=','g_r_n_details.item_id')
        ->join('stocks','items.id','=','stocks.item_id')
        ->join('measure_units','items.measure_unit_id','=','measure_units.id')
        ->where('items.code','=', $req->ajax_item_id)
        ->where('items.establishment_id','=', $mess_id)
        ->where('measure_units.establishment_id','=', $mess_id)
        ->limit(1)
        ->get();

        if ($item_names->count() > 0) { // Has Record
            foreach ($item_names as $item) {
                return response()->json($item);
            }
        }
        else{ // No Record
            return response()->json('nodata');
        }

    }
    
    // BAR 



}
