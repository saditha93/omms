<?php

namespace App\Http\Controllers\AppMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class DailySummeryAppController extends Controller
{

    public function summery_messing(Request $req){
        
        $enum = Cookie::get('enum');
        $mess_id = Cookie::get('mess_id');

        // SELECT mess_orders.order_breakfast, mess_orders.ordered_date, mess_daily_rations.tentative_price FROM mess_daily_rations INNER JOIN mess_menu_details ON mess_daily_rations.mess_menu_id = mess_menu_details.mess_menu_id INNER JOIN mess_orders ON mess_orders.ordered_date = mess_daily_rations.ration_date WHERE mess_menu_details.menu_type = 0 AND mess_menu_details.menu_type = 'breakfast' AND mess_orders.ordered_date = '2022-12-30'
        
        // Breakfast
        $summery_breakfast = DB::table('mess_orders')
        ->select('mess_orders.order_breakfast', 'mess_orders.rtaion_date', 'mess_daily_rations.tentative_price' , 'mess_daily_rations.price_final' , 'mess_orders.order_breakfast_status')
        ->join('mess_daily_rations','mess_orders.rtaion_date','=','mess_daily_rations.ration_date')
        ->where('mess_orders.rtaion_date','=', $req->ajax_today_date)
        ->where('mess_daily_rations.meal_time','=','breakfast')
        ->where('mess_orders.mess_id','=', $mess_id)
        ->where('mess_daily_rations.mess_id','=', $mess_id)
        ->where('mess_orders.officer_id','=', $enum)
        ->where('mess_orders.deleted_at','=', null)
        ->get();

        $data_not_found_error_count = 0;

        $html = '';

        if ($summery_breakfast->count() == 0) { // if value is 0, not data has been added to daily ration for the seected date
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }
        // else if ($summery_breakfast->count()) { // if value is 1, data has been added to daily ration. But not placed an order
        //     $data_not_found_error_count = $data_not_found_error_count + 1;
        // }
   
        $html .= '<div class="menu_line"><p>Menu</p><p>Qty</p><p>Price (Rs.)</p></div>';
        foreach ($summery_breakfast as $sum) {
            
            if ($sum->order_breakfast == '0' || $sum->order_breakfast == "") { // Not Ordered
                $html .= '<div class="sum_populated_fields"><p>Breakfast</p><p class="not">- Not Ordered -</p></div>';
            }
            
            else{ // Ordered
                
                $html .= '<span class="date">' . $sum->rtaion_date . '</span>'; // Display Date

                if ($sum->price_final == null || $sum->price_final == "0") { // Not updated price yet // Have tentative price
                    if ($sum->order_breakfast_status == '1') { // Active Orders
                        $html .= '<div class="sum_populated_fields"><p>Breakfast<p>' . $sum->order_breakfast . '</p><p>' . number_format($sum->order_breakfast * $sum->tentative_price,2) . '</p></div>';
                    }
                    else{ // Cancel Orders
                        $html .= '<div class="sum_populated_fields"><p>Breakfast <span>(Cancelled)</span></p><p>' . $sum->order_breakfast . '</p><p>' . number_format($sum->order_breakfast * $sum->tentative_price,2) . '</p></div>';
                    }
                }
                else{  // alredy updated price // Have final price
                    if ($sum->order_breakfast_status == '1') { // Active Orders
                        $html .= '<div class="sum_populated_fields"><p>Breakfast</p><p>' . $sum->order_breakfast . '</p><p>' . number_format($sum->order_breakfast * $sum->price_final,2) . '</p></div>';
                    }
                    else{ // Cancel Orders
                        $html .= '<div class="sum_populated_fields"><p>Breakfast <span>(Cancelled)</span></p></p><p>' . $sum->order_breakfast . '</p><p>' . number_format($sum->order_breakfast * $sum->price_final,2) . '</p></div>';
                    }
                }

            }
        }
        
        
        // Lunch
        $summery_lunch = DB::table('mess_orders')
        ->select('mess_orders.order_lunch', 'mess_orders.rtaion_date', 'mess_daily_rations.tentative_price' , 'mess_daily_rations.price_final' , 'mess_orders.order_lunch_status')
        ->join('mess_daily_rations','mess_orders.rtaion_date','=','mess_daily_rations.ration_date')
        ->where('mess_orders.rtaion_date','=', $req->ajax_today_date)
        ->where('mess_daily_rations.meal_time','=','lunch')
        ->where('mess_orders.mess_id','=', $mess_id)
        ->where('mess_daily_rations.mess_id','=', $mess_id)
        ->where('mess_orders.officer_id','=', $enum)
        ->where('mess_orders.deleted_at','=', null)
        ->get();

        if ($summery_lunch->count() == 0) { // if value is 0, not data has been added to daily ration for the seected date
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }
        // else if ($summery_lunch->count()) { // if value is 1, data has been added to daily ration. But not placed an order
        //     $data_not_found_error_count = $data_not_found_error_count + 1;
        // }
        
        foreach ($summery_lunch as $sum) {

            if ($sum->order_lunch == '0' || $sum->order_lunch == "") { // Not Ordered
                $html .= '<div class="sum_populated_fields"><p>Lunch</p><p class="not">- Not Ordered -</p></div>';
            }

            else{ // Ordered

                if ($sum->price_final == null || $sum->price_final == "0") { // Not updated price yet // Have tentative price
                    if ($sum->order_lunch_status == '1') { // Active Orders
                        $html .= '<div class="sum_populated_fields"><p>Lunch</p><p>' . $sum->order_lunch . '</p><p>' . number_format($sum->order_lunch * $sum->tentative_price,2) . '</p></div>';
                    }
                    else{ // Cancel Orders
                        $html .= '<div class="sum_populated_fields"><p>Lunch <span>(Cancelled)</span></p><p>' . $sum->order_lunch . '</p><p>' . number_format($sum->order_lunch * $sum->tentative_price,2) . '</p></div>';
                    }
                }
                else{ // alredy updated price // Have final price
                    if ($sum->order_lunch_status == '1') { // Active Orders
                        $html .= '<div class="sum_populated_fields"><p>Lunch</p><p>' . $sum->order_lunch . '</p><p>' . number_format($sum->order_lunch * $sum->price_final,2) . '</p></div>';
                    }
                    else{ // Cancel Orders
                        $html .= '<div class="sum_populated_fields"><p>Lunch<span>(Cancelled)</span></p><p>' . $sum->order_lunch . '</p><p>' . number_format($sum->order_lunch * $sum->price_final,2) . '</p></div>';
                    }
                }
            }
        }



        // Dinner
        $summery_dinner = DB::table('mess_orders')
        ->select('mess_orders.order_dinner', 'mess_orders.rtaion_date', 'mess_daily_rations.tentative_price' , 'mess_daily_rations.price_final' , 'mess_orders.order_dinner_status')
        ->join('mess_daily_rations','mess_orders.rtaion_date','=','mess_daily_rations.ration_date')
        ->where('mess_orders.rtaion_date','=', $req->ajax_today_date)
        ->where('mess_daily_rations.meal_time','=','dinner')
        ->where('mess_orders.mess_id','=', $mess_id)
        ->where('mess_daily_rations.mess_id','=', $mess_id)
        ->where('mess_orders.officer_id','=', $enum)
        ->where('mess_orders.deleted_at','=', null)
        ->get();

        if ($summery_dinner->count() == 0) { // if value is 0, not data has been added to daily ration for the seected date
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }
        // else if ($summery_dinner->count()) { // if value is 1, data has been added to daily ration. But not placed an order
        //     $data_not_found_error_count = $data_not_found_error_count + 1;
        // }

        foreach ($summery_dinner as $sum) {

            if ($sum->order_dinner == '0' || $sum->order_dinner == "") { // Not Ordered
                $html .= '<div class="sum_populated_fields"><p>Dinner</p><p class="not">- Not Ordered -</p></div>';
            }

            else{ // Ordered

                if ($sum->price_final == null || $sum->price_final == "0") { // Not updated price yet // Have tentative price
                    if ($sum->order_dinner_status == '1') { // Active Orders
                        $html .= '<div class="sum_populated_fields"><p>Dinner</p><p>' . $sum->order_dinner . '</p><p>' . number_format($sum->order_dinner * $sum->tentative_price,2) . '</p></div>';
                    }
                    else{ // Cancel Orders
                        $html .= '<div class="sum_populated_fields"><p>Dinner<span>(Cancelled)</span></p><p>' . $sum->order_dinner . '</p><p>' . number_format($sum->order_dinner * $sum->tentative_price,2) . '</p></div>';
                    }
                }
                else{ // alredy updated price // Have final price
                    if ($sum->order_dinner_status == '1') { // Active Orders
                        $html .= '<div class="sum_populated_fields"><p>Dinner</p><p>' . $sum->order_dinner . '</p><p>' . number_format($sum->order_dinner * $sum->price_final,2) . '</p></div>';
                    }
                    else{ // Cancel Orders
                        $html .= '<div class="sum_populated_fields"><p>Dinner<span>(Cancelled)</span></p><p>' . $sum->order_dinner . '</p><p>' . number_format($sum->order_dinner * $sum->price_final,2) . '</p></div>';
                    }
                }
            }
        }

        if ($data_not_found_error_count == 3) { // If no records in all 3 sections in db, display error
            $html = '<p class="no_order_p alert alert-danger">There are no orders have been placed today!</p>';
        }
        
        echo $html;
    }






    public function summery_extra_messing(Request $req){

        $enum = Cookie::get('enum');
        $mess_id = Cookie::get('mess_id');
        
        $summery_em = DB::table('extra_orders')
        ->select('extra_orders.ordered_date', 'extra_orders.qty', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.meal_time', 'extra_orders.item_id', 'mess_menu_items.item_name', 'mess_menu_items.category_id')
        ->join('mess_menu_items','extra_orders.item_id','=','mess_menu_items.id')
        ->whereIn('mess_menu_items.category_id',['2','3'])
        ->whereNotIn('meal_time',['0'])
        ->where('extra_orders.ordered_date','=', $req->ajax_today_date)
        ->where('extra_orders.mess_id','=', $mess_id)
        ->where('mess_menu_items.mess_id','=', $mess_id)
        ->where('extra_orders.officer_id','=', $enum)
        ->where('extra_orders.officer_id','=', $enum)
        ->whereNull('extra_orders.deleted_at')
        ->get();

        $html = '';

        $get_date = json_decode($summery_em, true);
        if (isset($get_date[0]['ordered_date'])) {
            $html .= '<span class="date">' . $get_date[0]['ordered_date'] . '</span>'; // Display Date
        }

        if ($summery_em->count() < 1) {
            $html .= '<p class="no_order_p alert alert-danger">There are no orders have been placed today!</p>';
        }
        else{
            $html .= '<div class="menu_line"><p> Item Name </p><p>for the </p><p> Qty</p><p> Price (Rs.)</p></div ><div id = "extra_messing_sum_content" >';

            foreach($summery_em as $sum){

                if ($sum->price_final == null || $sum->price_final == "0") { // Not updated price yet

                    if ($sum->meal_time == 1) {
                        $sum->meal_time = 'Breakfast';
                    } 
                    if ($sum->meal_time == 2) {
                        $sum->meal_time = 'Lunch';
                    } 
                    if ($sum->meal_time == 3) {
                        $sum->meal_time = 'Dinner';
                    } 
                    if ($sum->meal_time == 4) {
                        $sum->meal_time = 'Other';
                    }
        
                    $html .= '<div class="sum_populated_fields"><p>' . $sum->item_name . '</p><p>' . $sum->meal_time . '</p><p>' . $sum->qty . '</p><p>' . number_format($sum->qty * $sum->price ,2) . '</p></div>';
                }
                else{
                    if ($sum->meal_time == 1) {
                        $sum->meal_time = 'Breakfast';
                    } 
                    if ($sum->meal_time == 2) {
                        $sum->meal_time = 'Lunch';
                    } 
                    if ($sum->meal_time == 3) {
                        $sum->meal_time = 'Dinner';
                    } 
                    if ($sum->meal_time == 4) {
                        $sum->meal_time = 'Other';
                    }
        
                    $html .= '<div class="sum_populated_fields"><p>' . $sum->item_name . '</p><p>' . $sum->meal_time . '</p><p>' . $sum->qty . '</p><p>' . number_format($sum->qty * $sum->price_final ,2) . '</p></div>';
                }

            }  
        }
        echo $html;
    }


    


    public function summery_tea(Request $req){

        $enum = Cookie::get('enum');
        $mess_id = Cookie::get('mess_id');
        
        $summery_tea = DB::table('extra_orders')
        ->select('extra_orders.ordered_date', 'extra_orders.qty', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.meal_time', 'extra_orders.item_id', 'mess_menu_items.item_name', 'mess_menu_items.category_id')
        ->join('mess_menu_items','extra_orders.item_id','=','mess_menu_items.id')
        ->whereIn('mess_menu_items.category_id',['4'])
        ->whereNotIn('meal_time',['0'])
        ->where('extra_orders.ordered_date','=', $req->ajax_today_date)
        ->where('extra_orders.mess_id','=', $mess_id)
        ->where('mess_menu_items.mess_id','=', $mess_id)
        ->where('extra_orders.officer_id','=', $enum)
        ->whereNull('extra_orders.deleted_at')
        ->get();

        $html = '';

        $get_date = json_decode($summery_tea, true);
        if (isset($get_date[0]['ordered_date'])) {
            $html .= '<span class="date">' . $get_date[0]['ordered_date'] . '</span>'; // Display Date
        }

        if ($summery_tea->count() < 1) {
            $html .= '<p class="no_order_p alert alert-danger">There are no orders have been placed today!</p>';
        }
        else{
            $html .= '<div class="menu_line"><p> Item Name </p><p>for the </p><p> Qty</p><p> Price (Rs.)</p></div ><div id = "tea_sum_content" >';

            foreach($summery_tea as $sum){

                if ($sum->price_final == null || $sum->price_final == "0") { // Not updated price yet
                    if ($sum->meal_time == 1) {
                        $sum->meal_time = '0600 Hrs';
                    } 
                    if ($sum->meal_time == 2) {
                        $sum->meal_time = '1000 Hrs';
                    } 
                    if ($sum->meal_time == 3) {
                        $sum->meal_time = '1500 Hrs';
                    } 
                    if ($sum->meal_time == 4) {
                        $sum->meal_time = 'Other';
                    }
    
                    $html .= '<div class="sum_populated_fields"><p>' . $sum->item_name . '</p><p>' . $sum->meal_time . '</p><p>' . $sum->qty . '</p><p>' . number_format($sum->qty * $sum->price ,2) . '</p></div>';
                }
                else{
                    if ($sum->meal_time == 1) {
                        $sum->meal_time = '0600 Hrs';
                    } 
                    if ($sum->meal_time == 2) {
                        $sum->meal_time = '1000 Hrs';
                    } 
                    if ($sum->meal_time == 3) {
                        $sum->meal_time = '1500 Hrs';
                    } 
                    if ($sum->meal_time == 4) {
                        $sum->meal_time = 'Other';
                    }
    
                    $html .= '<div class="sum_populated_fields"><p>' . $sum->item_name . '</p><p>' . $sum->meal_time . '</p><p>' . $sum->qty . '</p><p>' . number_format($sum->qty * $sum->price_final ,2) . '</p></div>';
                }
            } 
        }
        echo $html;
    }






    public function summery_bar(Request $req){

        $enum = Cookie::get('enum');
        $mess_id = Cookie::get('mess_id');

        $summery_bar = DB::table('items')
        ->select('bars.order_dt', 'items.name', 'bars.qty', 'bars.price' , 'measure_units.abbreviation')
        ->join('measure_units','items.measure_unit_id','=','measure_units.id')
        ->join('bars','items.id','=','bars.item')
        ->where('bars.mess_id','=', $mess_id)
        ->where('items.establishment_id','=', $mess_id)
        ->where('bars.officer_id','=', $enum)
        ->where('bars.order_dt','=', $req->today_date)
        ->get();

        $html = '';

        $get_date = json_decode($summery_bar, true);
        if (isset($get_date[0]['order_dt'])) {
            $html .= '<span class="date">' . $get_date[0]['order_dt'] . '</span>'; // Display Date
        }
        
        if ($summery_bar->count() < 1) {
            $html .= '<p class="no_order_p alert alert-danger">There are no orders have been placed today!</p>';
        }
        else{
            $html .= '<div class="menu_line"><p> Item Name </p><p>Unit of Measure</p><p> Qty</p><p> Price (Rs.)</p></div ><div id = "bar_sum_content" >';
            
            foreach($summery_bar as $sum){
                $html .= '<div class="sum_populated_fields"><p>' . $sum->name . '</p><p>' . $sum->abbreviation . '</p><p>' . $sum->qty . '</p><p>' . number_format($sum->qty * $sum->price ,2) . '</p></div>';
            } 
        }
        echo $html;
        
    }

}
