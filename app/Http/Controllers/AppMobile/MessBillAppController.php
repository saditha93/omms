<?php

namespace App\Http\Controllers\AppMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class MessBillAppController extends Controller
{
    
    public function mess_bill_func(Request $req){

        //////////////////////  MESSING

        $date1 = $req->ajax_date1;
        $date2 = $req->ajax_date2;
        $enumber = Cookie::get('enum');
        $mess_id = Cookie::get('mess_id');

        $messing = DB::table('mess_orders')
        ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.rtaion_date', 'mess_daily_rations.tentative_price' , 'mess_daily_rations.price_final' , 'mess_daily_rations.meal_time')
        ->join('mess_daily_rations','mess_orders.rtaion_date','=','mess_daily_rations.ration_date')
        ->where('mess_orders.mess_id','=', $mess_id)
        ->where('mess_daily_rations.mess_id','=', $mess_id)
        ->where('mess_orders.officer_id','=', $enumber)
        ->where('mess_orders.deleted_at','=', null)
        ->whereBetween('mess_orders.rtaion_date', [$date1, $date2])
        ->get();
    // dd($messing);
        $data_not_found_error_count = 0;

        $html = '<div class="menu_line2">Messing Order Details</div>';
        
        // $html = '<div class="menu_line"><p>Ordered Date</p><p>Menu</p><p>Qty</p><p>Unit Price (Rs.)</p><p>Total (Rs.)</p></div><div class="menu_line2">Messing Details</div>';

        $messing_total = 0;
        $final_total = 0;

        foreach($messing as $data){

            $date_reajust = substr($data->rtaion_date, 2);

            if ($data->meal_time == 'breakfast') {

                if ($data->order_breakfast == null || $data->order_breakfast == '0') {
                    // $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>Breakfast</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet

                        $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>Breakfast (Rs.'.$data->tentative_price.'x'.$data->order_breakfast.')</p><p>' . number_format($data->order_breakfast * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_breakfast * $data->tentative_price); 
                    }
                    else{ // alredy updated price

                        $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>Breakfast (Rs.'.$data->price_final.'x'.$data->order_breakfast.')</p><p>' . number_format($data->order_breakfast * $data->price_final,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_breakfast * $data->price_final);
                    }

                }
            }

            if ($data->meal_time == 'lunch') {

                if ($data->order_lunch == null || $data->order_lunch == '0') {
                    // $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>Lunch</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet

                        $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>Lunch (Rs.'.$data->tentative_price.'x'.$data->order_lunch.')</p><p>' . number_format($data->order_lunch * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_lunch * $data->tentative_price);
                    }
                    else{ // alredy updated price

                        $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>Lunch (Rs.'.$data->price_final.'x'.$data->order_lunch.')</p><p>' . number_format($data->order_lunch * $data->price_final,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_lunch * $data->price_final);
                    }
                }
            }

            if ($data->meal_time == 'dinner') {

                if ($data->order_dinner == null || $data->order_dinner == '0') {
                    // $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>Dinner</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet

                        $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>Dinner (Rs.'.$data->tentative_price.'x'.$data->order_dinner.')</p><p>' . number_format($data->order_dinner * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_dinner * $data->tentative_price);
                    }
                    else{ // alredy updated price 

                        $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>Dinner (Rs.'.$data->price_final.'x'.$data->order_dinner.')</p><p>' . number_format($data->order_dinner * $data->price_final,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_dinner * $data->price_final);
                    }

                }
            }

        }

        // View Future Orders
        // $messing2 = DB::table('mess_orders')
        // ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.rtaion_date')
        // ->where('mess_orders.mess_id','=', $mess_id)
        // ->where('mess_orders.officer_id','=', $enumber)
        // ->whereBetween('mess_orders.rtaion_date', [$date1, $date2])
        // ->get();

        // $timeNow = Carbon::now();
        // $timeNowFormat = Carbon::parse($timeNow)->format("Y-m-d");

        // $html .= "<div class='menu_line2_up'>";
        // $html .= "<div class='menu_line2'>Messing Future Orders</div>";

        // foreach ($messing2 as $data) {

        //     $Ration_date = Carbon::parse($data->rtaion_date)->format("Y-m-d");

        //     if ($Ration_date > $timeNowFormat) { // check future orders
                
        //         $html .= "<div class='sum_populated_fields2'><p>{$data->rtaion_date}</p><p>Breakfast x {$data->order_breakfast}</p><p>Lunch x $data->order_lunch</p><p>Dinner x $data->order_dinner</p></div>";

        //     }
        // }

        // $html .= "</div>";
        // View Future Orders


        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($messing_total,2) . '</p></div>';

        $final_total = $final_total + $messing_total;

        if ($messing->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }


        ////////////////////// EXTRA MESSING

        $extra_messing = DB::table('extra_orders')
        ->select('extra_orders.meal_time', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.qty', 'extra_orders.ordered_date', 'mess_menu_items.item_name')
        ->join('mess_menu_items','extra_orders.item_id','=','mess_menu_items.id')
        ->whereIn('mess_menu_items.category_id',['2','3'])
        ->whereNotIn('meal_time',['0'])
        ->where('extra_orders.mess_id','=', $mess_id)
        ->where('mess_menu_items.mess_id','=', $mess_id)
        ->where('extra_orders.officer_id','=', $enumber)
        ->whereNull('extra_orders.deleted_at')
        ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
        ->get();

        $html .= '<div class="menu_line2">Extra Messing Order Details</div>';

        $extra_messing_total = 0;

        foreach($extra_messing as $data){

            $date_reajust = substr($data->ordered_date, 2);

            if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>'. $data->item_name . ' (Rs.'. $data->price .'x' . $data->qty . ')</p><p>' . number_format($data->qty * $data->price,2) . '</p></div>';

                $extra_messing_total = $extra_messing_total + ($data->qty * $data->price);
            }
            else{ // alredy updated price 
                $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>'. $data->item_name . ' (Rs.'. $data->price_final .'x' . $data->qty . ')</p><p>' . number_format($data->qty * $data->price_final,2) . '</p></div>';

                $extra_messing_total = $extra_messing_total + ($data->qty * $data->price_final);
            }
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">Rs: ' . number_format($extra_messing_total,2) . '</p></div>';

        $final_total = $final_total + $extra_messing_total;

        if ($extra_messing->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }


        // ////////////////////// TEA


        $tea = DB::table('extra_orders')
        ->select('extra_orders.meal_time', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.qty', 'extra_orders.ordered_date', 'mess_menu_items.item_name')
        ->join('mess_menu_items','extra_orders.item_id','=','mess_menu_items.id')
        ->whereIn('mess_menu_items.category_id',['4'])
        ->whereNotIn('meal_time',['0'])
        ->where('extra_orders.mess_id','=', $mess_id)
        ->where('mess_menu_items.mess_id','=', $mess_id)
        ->where('extra_orders.officer_id','=', $enumber)
        ->whereNull('extra_orders.deleted_at')
        ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
        ->get();

        $html .= '<div class="menu_line2">Tea Order Details</div>';

        $tea_total = 0;

        foreach($tea as $data){

            $date_reajust = substr($data->ordered_date, 2);

            if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet 
            
                $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>'. $data->item_name . ' (Rs.'. $data->price .'x' . $data->qty . ')</p><p>' . number_format($data->qty * $data->price,2) . '</p></div>';

                $tea_total = $tea_total + ($data->qty * $data->price);
            }
            else{ // alredy updated price 

                $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>'. $data->item_name . ' (Rs.'. $data->price_final .'x' . $data->qty . ')</p><p>' . number_format($data->qty * $data->price_final,2) . '</p></div>';

                $tea_total = $tea_total + ($data->qty * $data->price_final);
            }

        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">Rs: ' . number_format($tea_total,2) . '</p></div>';

        $final_total = $final_total + $tea_total;

        if ($tea->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }



        //////////////////////// BAR

        // $summery_bar = DB::table('items')
        // ->select('bars.order_dt', 'items.name', 'bars.qty', 'bars.price' , 'measure_units.abbreviation')
        // ->join('measure_units','bars.measure','=','measure_units.id')
        // ->join('bars','items.id','=','bars.item')
        // ->whereBetween('bars.order_dt', [$date1, $date2])
        // ->where('bars.mess_id','=', $mess_id)
        // ->where('items.establishment_id','=', $mess_id)
        // ->where('bars.officer_id','=', $enumber)
        // ->get();

        $summery_bar = DB::table('bars')
        ->select('bars.order_dt', 'items.name', 'bars.qty', 'bars.price',  'bars.measure')
        ->join('items','bars.item','=','items.id')
        ->whereBetween('bars.order_dt', [$date1, $date2])
        ->where('bars.mess_id','=', $mess_id)
        ->where('items.establishment_id','=', $mess_id)
        ->where('bars.officer_id','=', $enumber)
        ->get();

        $html .= '<div class="menu_line2">Bar Order Details</div>';

        $bar_total = 0;

        foreach($summery_bar as $data){

            $date_reajust = substr($data->order_dt, 2);

            $mesure_unit = DB::table('measure_units')
            ->select('measure_units.abbreviation')
            ->where('id','=', $data->measure)
            ->get();

            foreach($mesure_unit as $unit){
                
                $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>'. $data->name . ' (' . $unit->abbreviation .' <b>x</b> ' . $data->qty . ')</p><p>' . number_format($data->price,2) . '</p></div>';
            }

            $bar_total = $bar_total + $data->price;
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">Rs: ' . number_format($bar_total,2) . '</p></div>';

        $final_total = $final_total + $bar_total;

        if ($summery_bar->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }




        //////////////////////// EVENT

        $summery_event =  DB::table('event_orders_mess')
        ->select('*')
        ->whereBetween('date', [$date1, $date2])
        ->where('officer_id','=', $enumber)
        ->where('mess_id','=', $mess_id)
        ->get();

        $html .= '<div class="menu_line2">Event Details</div>';

        $event_total = 0;

        foreach($summery_event as $data){

            $date_reajust = substr($data->date, 2);

            $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>' . $data->event_name . '</p><p>' . number_format($data->value,2) . '</p></div>';

            $event_total = $event_total + ($data->value);
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">Rs: ' . number_format($event_total,2) . '</p></div>';

        $final_total = $final_total + $event_total;

        if ($summery_event->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }
        



        //////////////////////// GENERAL DEDUCTIONS

        $general =  DB::table('general_deduction')
        ->select('*')
        ->whereBetween('date', [$date1, $date2])
        ->where('officer_id','=', $enumber)
        ->where('mess_id','=', $mess_id)
        ->get();

        $html .= '<div class="menu_line2">General Deducations</div>';

        $general_total = 0;

        foreach($general as $data){

            $date_reajust = substr($data->date, 2);

            $html .= '<div class="sum_populated_fields"><p>' . $date_reajust . '</p><p>' . $data->name . '</p><p>' . number_format($data->value,2) . '</p></div>';

            $general_total = $general_total + ($data->value);
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">Rs: ' . number_format($general_total,2) . '</p></div>';

        $final_total = $final_total + $general_total;

        $html .= '<div class="sum_populated_fields_total"><p>Total Bill</p><p>Rs: ' . number_format($final_total,2) . '</p></div>';

        if ($general->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }


        if ($data_not_found_error_count == 6) { // If no records in all 3 sections in db, display error
            $html = '<p class="no_data alert alert-danger">No bill is available for the selected date range</p>';
        }

        
        echo $html;

    }
    
}
