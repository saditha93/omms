<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Mess;
use App\Models\MessDailyRations;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\MessUsersDataTable;
use App\DataTables\MessStaffDataTable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;





class ReportsController extends Controller
{
    public function users(MessUsersDataTable $dataTable)
    {
        return $dataTable->render('reports.users');
    }

    public function user($id)
    {
        $user = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
//            ->where('officers_assigns.status',1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->where('officers_assigns.id', $id)
            ->first();

        return view('reports.user', compact('user'));
    }

    public function staffs(MessStaffDataTable $dataTable)
    {
        return $dataTable->render('reports.staffs');
    }

    public function staff($id)
    {
        $user = Admin::find($id);

        return view('reports.staff', compact('user'));
    }


    // Ravikantha

    public function reportMessing(Request $request)
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->orderBy('name_according_to_part2','asc')
            ->get();
        return view('admin.master-data.orders.report_messing', compact('officers'));
    }

    public function reportCanteen(Request $request)
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->orderBy('name_according_to_part2','asc')
            ->get();
        return view('admin.master-data.orders.report_canteen', compact('officers'));
    }

    public function reportBar(Request $request)
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->orderBy('name_according_to_part2','asc')
            ->get();
        return view('admin.master-data.orders.report_bar', compact('officers'));
    }


    public function reportEvent(Request $request)
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->orderBy('name_according_to_part2','asc')
            ->get();
        return view('admin.master-data.orders.report_event', compact('officers'));
    }

    public function reportGeneral(Request $request)
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->orderBy('name_according_to_part2','asc')
            ->get();
        return view('admin.master-data.orders.report_general', compact('officers'));
    }

    
    public function reportAll(Request $request)
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->orderBy('name_according_to_part2','asc')
            ->get();

        return view('admin.master-data.orders.report_all', compact('officers'));
    }

    public function reportAllOfficers()
    {
        return view('admin.master-data.orders.report_all_officers');
    }

        
    public function billPayments(Request $request)
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->orderBy('name_according_to_part2','asc')
            ->get();

        return view('admin.master-data.orders.bill_payments', compact('officers'));
    }


    ///


    public function messingOrderDetails(Request $req) {

        //////////////////////  MESSING

        $mess_id = Auth::user()->mess_id;
        $enumber = $req->enumber;
        $date1 = $req->date1;
        $date2 = $req->date2;

        $messing = DB::table('mess_orders')
            ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.rtaion_date', 'mess_daily_rations.tentative_price', 'mess_daily_rations.price_final', 'mess_daily_rations.meal_time')
            ->join('mess_daily_rations', 'mess_orders.rtaion_date', '=', 'mess_daily_rations.ration_date')
            ->where('mess_orders.mess_id', '=', $mess_id)
            ->where('mess_daily_rations.mess_id','=', $mess_id)
            ->where('mess_orders.officer_id', '=', $enumber)
            ->whereBetween('mess_orders.rtaion_date', [$date1, $date2])
            ->get();


        $data_not_found_error_count = 0;

        $html = '<div class="menu_line"><p>Ordered Date</p><p>Menu</p><p>Dessert</p><p>Qty</p><p>Unit Price (Rs.)</p><p>Total (Rs.)</p></div>
        <div class="menu_line2">Messing Details</div>';

        $messing_total = 0;
        $final_total = 0;

        foreach ($messing as $data) {

            if ($data->meal_time == 'breakfast') {
                //AE
                    $dessert = MessDailyRations::join('mess_menu_items','mess_menu_items.id','=','mess_daily_rations.dessert_item_id')
                    ->where('mess_daily_rations.ration_date', $data->rtaion_date)
                    ->where('mess_daily_rations.mess_id', $mess_id)
                    ->get('mess_menu_items.item_name');

                $DessertName = isset($dessert[0]['item_name'])?$dessert[0]['item_name']:'';

                //End AE

                if ($data->order_breakfast == null || $data->order_breakfast == '0') {
                    $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Breakfast</p><p>&nbsp;</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet

                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Breakfast</p> <p>'.$DessertName.'</p> <p>' . $data->order_breakfast . '</p><p>'. number_format($data->tentative_price,2) .'</p><p>' . number_format($data->order_breakfast * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_breakfast * $data->tentative_price); 
                    }
                    else{ // alredy updated price
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Breakfast</p> <p>'.$DessertName.'</p> <p>' . $data->order_breakfast . '</p><p>'. number_format($data->price_final,2) .'</p><p>' . number_format($data->order_breakfast * $data->price_final,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_breakfast * $data->price_final);
                    }

                }
            }

            if ($data->meal_time == 'lunch') {
                //AE
                $dessert = MessDailyRations::join('mess_menu_items','mess_menu_items.id','=','mess_daily_rations.dessert_item_id')
                    ->where('mess_daily_rations.ration_date', $data->rtaion_date)
                    ->where('mess_daily_rations.mess_id', $mess_id)
                    ->get('mess_menu_items.item_name');

                $DessertName = isset($dessert[0]['item_name'])?$dessert[0]['item_name']:'';

                //End AE

                if ($data->order_lunch == null || $data->order_lunch == '0') {
                    $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Lunch</p><p>&nbsp;</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Lunch</p> <p>'.$DessertName.'</p> <p>' . $data->order_lunch . '</p><p>'. number_format($data->tentative_price,2) .'</p><p>' . number_format($data->order_lunch * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_lunch * $data->tentative_price);
                    }
                    else{ // alredy updated price
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Lunch</p> <p>'.$DessertName.'</p> <p>' . $data->order_lunch . '</p><p>'. number_format($data->price_final,2) .'</p><p>' . number_format($data->order_lunch * $data->price_final,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_lunch * $data->price_final);
                    }
                }
            }

            if ($data->meal_time == 'dinner') {



                //AE
                $dessert = MessDailyRations::join('mess_menu_items','mess_menu_items.id','=','mess_daily_rations.dessert_item_id')
                    ->where('mess_daily_rations.ration_date', $data->rtaion_date)
                    ->where('mess_daily_rations.mess_id', $mess_id)
                    ->get('mess_menu_items.item_name');

                $DessertName = isset($dessert[0]['item_name'])?$dessert[0]['item_name']:'';

                //End AE



                if ($data->order_dinner == null || $data->order_dinner == '0') {
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Dinner</p><p>&nbsp;</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Dinner</p> <p>'.$DessertName.'</p> <p>' . $data->order_dinner . '</p><p>'. number_format($data->tentative_price,2) .'</p><p>' . number_format($data->order_dinner * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_dinner * $data->tentative_price);
                    } else { // alredy updated price
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Dinner</p> <p>'.$DessertName.'</p> <p>' . $data->order_dinner . '</p><p>' . number_format($data->price_final, 2) . '</p><p>' . number_format($data->order_dinner * $data->price_final, 2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_dinner * $data->price_final);
                    }

                }
            }

        }

        // View Future Orders
        // $messing2 = DB::table('mess_orders')
        //     ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.rtaion_date')
        //     ->where('mess_orders.mess_id', '=', $mess_id)
        //     ->where('mess_orders.officer_id', '=', $enumber)
        //     ->whereBetween('mess_orders.rtaion_date', [$date1, $date2])
        //     ->get();

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


        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($messing_total, 2) . '</p></div>';

        $final_total = $final_total + $messing_total;

        if ($messing->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }


        ////////////////////// EXTRA MESSING

        $extra_messing = DB::table('extra_orders')
            ->select('extra_orders.meal_time', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.qty', 'extra_orders.ordered_date', 'mess_menu_items.item_name')
            ->join('mess_menu_items', 'extra_orders.item_id', '=', 'mess_menu_items.id')
            ->whereIn('mess_menu_items.category_id', ['2', '3'])
            ->whereNotIn('meal_time', ['0'])
            ->where('extra_orders.mess_id','=', $mess_id)
            ->where('mess_menu_items.mess_id','=', $mess_id)
            ->where('extra_orders.officer_id', '=', $enumber)
            ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
            ->get();

        $html .= '<div class="menu_line2">Extra Messing Details</div>';

        $extra_messing_total = 0;

        foreach ($extra_messing as $data) {

            if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p style="border: none;">'. $data->item_name .'</p><p></p><p>' . $data->qty . '</p><p>'. number_format($data->price,2) .'</p><p>' . number_format($data->qty * $data->price,2) . '</p></div>';

                $extra_messing_total = $extra_messing_total + ($data->qty * $data->price);
            } else { // alredy updated price
                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p style="border: none;">' . $data->item_name . '</p><p></p><p>' . $data->qty . '</p><p>' . number_format($data->price_final, 2) . '</p><p>' . number_format($data->qty * $data->price_final, 2) . '</p></div>';

                $extra_messing_total = $extra_messing_total + ($data->qty * $data->price_final);
            }
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($extra_messing_total, 2) . '</p></div>';

        $final_total = $final_total + $extra_messing_total;

        if ($extra_messing->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }


        // ////////////////////// TEA

        $tea = DB::table('extra_orders')
            ->select('extra_orders.meal_time', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.qty', 'extra_orders.ordered_date', 'mess_menu_items.item_name')
            ->join('mess_menu_items', 'extra_orders.item_id', '=', 'mess_menu_items.id')
            ->whereIn('mess_menu_items.category_id', ['4'])
            ->whereNotIn('meal_time', ['0'])
            ->where('extra_orders.mess_id', '=', $mess_id)
            ->where('mess_menu_items.mess_id','=', $mess_id)
            ->where('extra_orders.officer_id', '=', $enumber)
            ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
            ->get();

        $html .= '<div class="menu_line2">Tea Details</div>';

        $tea_total = 0;

        foreach ($tea as $data) {

            if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet

                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p style="border: none;">' . $data->item_name . '</p><p></p><p>' . $data->qty . '</p><p>' . number_format($data->price, 2) . '</p><p>' . number_format($data->qty * $data->price, 2) . '</p></div>';

                $tea_total = $tea_total + ($data->qty * $data->price);
            } else { // alredy updated price
                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p style="border: none;">' . $data->item_name . '</p><p></p><p>' . $data->qty . '</p><p>' . number_format($data->price_final, 2) . '</p><p>' . number_format($data->qty * $data->price_final, 2) . '</p></div>';

                $tea_total = $tea_total + ($data->qty * $data->price_final);
            }

        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($tea_total, 2) . '</p></div>';

        $final_total = $final_total + $tea_total;

        if ($tea->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }

        $html .= '<div class="sum_populated_fields_total"><p>Meal Orders Bill</p><p>Rs: ' . number_format($final_total, 2) . '</p></div>';

        if ($data_not_found_error_count == 3) { // If no records in all 3 sections in db, display error
            $html = '<p class="no_data alert alert-danger">No Bill is Available for the Selected Date Range</p>';
        }
        
        echo $html;

    }
    


    public function barOrderDetails(Request $req) {

        $mess_id = Auth::user()->mess_id;
        $enumber = $req->enumber;
        $date1 = $req->date1;
        $date2 = $req->date2;

        $html = '<div class="menu_line"><p>Ordered Date</p><p>Item Name</p><p>Qty</p><p>Unit Price (Rs.)</p><p>Total (Rs.)</p></div>';

        // $summery_bar =  DB::table('bars')
        // ->select('items.name', 'bars.qty', 'bars.price', 'bars.order_dt')
        // ->join('items','bars.item','=','items.id')
        // ->whereBetween('bars.order_dt', [$date1, $date2])
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

        $bar_total = 0;
        $final_total = 0;

        foreach($summery_bar as $data){

            $mesure_unit = DB::table('measure_units')
            ->select('measure_units.abbreviation')
            ->where('id','=', $data->measure)
            ->get();

            foreach($mesure_unit as $unit){
                $html .= '<div class="sum_populated_fields"><p>' . $data->order_dt . '</p><p>' . $data->name . ' (' . $unit->abbreviation . ')</p><p>' . $data->qty . '</p><p>'. number_format(($data->price / $data->qty),2) .'</p><p>' . number_format($data->price,2) . '</p></div>';

                $bar_total = $bar_total + $data->price;
            }
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($bar_total,2) . '</p></div>';

        $final_total = $final_total + $bar_total;

        $html .= '<div class="sum_populated_fields_total"><p>Bar Orders Bill</p><p>Rs: ' . number_format($final_total, 2) . '</p></div>';

        if ($summery_bar->count() <= 0) { // If no records in db, count it
            $html = '<p class="no_data alert alert-danger">No Bill is Available for the Selected Date Range</p>';
        }
        
        echo $html;
    }

    public function eventOrderDetails(Request $req) {

        $mess_id = Auth::user()->mess_id;
        $enumber = $req->enumber;
        $date1 = $req->date1;
        $date2 = $req->date2;

        $html = '<div class="menu_line"><p>Ordered Date</p><p>Event Name</p><p>Event Details</p><p>Total (Rs.)</p></div>';

        $summery_event =  DB::table('event_orders_mess')
        ->select('*')
        ->whereBetween('date', [$date1, $date2])
        ->where('officer_id','=', $enumber)
        ->where('mess_id','=', $mess_id)
        ->get();


        $bar_total = 0;
        $final_total = 0;

        foreach($summery_event as $data){

            $html .= '<div class="sum_populated_fields"><p>' . $data->date . '</p><p>' . $data->event_name . '</p><p>' . $data->details . '</p><p>'. number_format($data->value,2) .'</p></div>';

            $bar_total = $bar_total + ($data->value);
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($bar_total,2) . '</p></div>';

        $final_total = $final_total + $bar_total;

        $html .= '<div class="sum_populated_fields_total"><p>Bar Orders Bill</p><p>Rs: ' . number_format($final_total, 2) . '</p></div>';

        if ($summery_event->count() <= 0) { // If no records in db, count it
            $html = '<p class="no_data alert alert-danger">No Bill is Available for the Selected Date Range</p>';
        }
        
        echo $html;
    }

    public function generalDetails(Request $req) {

        $mess_id = Auth::user()->mess_id;
        $enumber = $req->enumber;
        $date1 = $req->date1;
        $date2 = $req->date2;

        $html = '<div class="menu_line"><p>Date</p><p>Deduction</p><p>Total (Rs.)</p></div>';

        $general =  DB::table('general_deduction')
        ->select('*')
        ->whereBetween('date', [$date1, $date2])
        ->where('officer_id','=', $enumber)
        ->where('mess_id','=', $mess_id)
        ->get();

        $bar_total = 0;
        $final_total = 0;

        foreach($general as $data){

            $html .= '<div class="sum_populated_fields"><p>' . $data->date . '</p><p>' . $data->name . '</p><p>'. number_format($data->value,2) .'</p></div>';

            $bar_total = $bar_total + ($data->value);
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($bar_total,2) . '</p></div>';

        $final_total = $final_total + $bar_total;

        $html .= '<div class="sum_populated_fields_total"><p>Bar Orders Bill</p><p>Rs: ' . number_format($final_total, 2) . '</p></div>';

        if ($general->count() <= 0) { // If no records in db, count it
            $html = '<p class="no_data alert alert-danger">No Bill is Available for the Selected Date Range</p>';
        }
        
        echo $html;
    }

    public function allOrderDetails(Request $req)
    {

        //////////////////////  MESSING

        $mess_id = Auth::user()->mess_id;
        $enumber = $req->enumber;
        $date1 = $req->date1;
        $date2 = $req->date2;

        $messing = DB::table('mess_orders')
            ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.rtaion_date', 'mess_daily_rations.tentative_price', 'mess_daily_rations.price_final', 'mess_daily_rations.meal_time')
            ->join('mess_daily_rations', 'mess_orders.rtaion_date', '=', 'mess_daily_rations.ration_date')
            ->where('mess_orders.mess_id', '=', $mess_id)
            ->where('mess_daily_rations.mess_id','=', $mess_id)
            ->where('mess_orders.officer_id', '=', $enumber)
            ->whereBetween('mess_orders.rtaion_date', [$date1, $date2])
            ->get();

        $data_not_found_error_count = 0;

        $html = '<div class="menu_line"><p>Ordered Date</p><p>Menu/Item Name</p><p>Dessert</p><p>Qty</p><p>Unit Price (Rs.)</p><p>Total (Rs.)</p></div>
        <div class="menu_line2">Messing Details</div>';

        $messing_total = 0;
        $final_total = 0;

        foreach ($messing as $data) {

            if ($data->meal_time == 'breakfast') {

                //AE
                $dessert = MessDailyRations::join('mess_menu_items','mess_menu_items.id','=','mess_daily_rations.dessert_item_id')
                    ->where('mess_daily_rations.ration_date', $data->rtaion_date)
                    ->where('mess_daily_rations.mess_id', $mess_id)
                    ->get('mess_menu_items.item_name');

                $DessertName = isset($dessert[0]['item_name'])?$dessert[0]['item_name']:'';

                //End AE

                if ($data->order_breakfast == null || $data->order_breakfast == '0') {
                    $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Breakfast</p><p>&nbsp;</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet

                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Breakfast</p> <p>'.$DessertName.'</p> <p>' . $data->order_breakfast . '</p><p>'. number_format($data->tentative_price,2) .'</p><p>' . number_format($data->order_breakfast * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_breakfast * $data->tentative_price); 
                    }
                    else{ // alredy updated price
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Breakfast</p> <p>'.$DessertName.'</p> <p>' . $data->order_breakfast . '</p><p>'. number_format($data->price_final,2) .'</p><p>' . number_format($data->order_breakfast * $data->price_final,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_breakfast * $data->price_final);
                    }

                }
            }

            if ($data->meal_time == 'lunch') {

                //AE
                $dessert = MessDailyRations::join('mess_menu_items','mess_menu_items.id','=','mess_daily_rations.dessert_item_id')
                    ->where('mess_daily_rations.ration_date', $data->rtaion_date)
                    ->where('mess_daily_rations.mess_id', $mess_id)
                    ->get('mess_menu_items.item_name');

                $DessertName = isset($dessert[0]['item_name'])?$dessert[0]['item_name']:'';

                //End AE

                if ($data->order_lunch == null || $data->order_lunch == '0') {
                    $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Lunch</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Lunch</p> <p>'.$DessertName.'</p> <p>' . $data->order_lunch . '</p><p>'. number_format($data->tentative_price,2) .'</p><p>' . number_format($data->order_lunch * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_lunch * $data->tentative_price);
                    }
                    else{ // alredy updated price
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Lunch</p> <p>'.$DessertName.'</p> <p>' . $data->order_lunch . '</p><p>'. number_format($data->price_final,2) .'</p><p>' . number_format($data->order_lunch * $data->price_final,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_lunch * $data->price_final);
                    }
                }
            }

            if ($data->meal_time == 'dinner') {

                //AE
                $dessert = MessDailyRations::join('mess_menu_items','mess_menu_items.id','=','mess_daily_rations.dessert_item_id')
                    ->where('mess_daily_rations.ration_date', $data->rtaion_date)
                    ->where('mess_daily_rations.mess_id', $mess_id)
                    ->get('mess_menu_items.item_name');

                $DessertName = isset($dessert[0]['item_name'])?$dessert[0]['item_name']:'';

                //End AE

                if ($data->order_dinner == null || $data->order_dinner == '0') {
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Dinner</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Dinner</p> <p>'.$DessertName.'</p> <p>' . $data->order_dinner . '</p><p>'. number_format($data->tentative_price,2) .'</p><p>' . number_format($data->order_dinner * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_dinner * $data->tentative_price);
                    } else { // alredy updated price
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Dinner</p> <p>'.$DessertName.'</p> <p>' . $data->order_dinner . '</p><p>' . number_format($data->price_final, 2) . '</p><p>' . number_format($data->order_dinner * $data->price_final, 2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_dinner * $data->price_final);
                    }

                }
            }

        }

        // View Future Orders
        // $messing2 = DB::table('mess_orders')
        //     ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.rtaion_date')
        //     ->where('mess_orders.mess_id', '=', $mess_id)
        //     ->where('mess_orders.officer_id', '=', $enumber)
        //     ->whereBetween('mess_orders.rtaion_date', [$date1, $date2])
        //     ->get();

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


        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($messing_total, 2) . '</p></div>';

        $final_total = $final_total + $messing_total;

        if ($messing->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }


        ////////////////////// EXTRA MESSING

        $extra_messing = DB::table('extra_orders')
            ->select('extra_orders.meal_time', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.qty', 'extra_orders.ordered_date', 'mess_menu_items.item_name')
            ->join('mess_menu_items', 'extra_orders.item_id', '=', 'mess_menu_items.id')
            ->whereIn('mess_menu_items.category_id', ['2', '3'])
            ->whereNotIn('meal_time', ['0'])
            ->where('extra_orders.mess_id','=', $mess_id)
            ->where('mess_menu_items.mess_id','=', $mess_id)
            ->where('extra_orders.officer_id', '=', $enumber)
            ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
            ->get();

        $html .= '<div class="menu_line2">Extra Messing Details</div>';

        $extra_messing_total = 0;

        foreach ($extra_messing as $data) {

            if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p style="border: none; text-align: center">'. $data->item_name .'</p> <p></p> <p>' . $data->qty . '</p><p>'. number_format($data->price,2) .'</p><p>' . number_format($data->qty * $data->price,2) . '</p></div>';

                $extra_messing_total = $extra_messing_total + ($data->qty * $data->price);
            } else { // alredy updated price
                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p style="border: none; text-align: center">' . $data->item_name . '</p><p></p><p>' . $data->qty . '</p><p>' . number_format($data->price_final, 2) . '</p><p>' . number_format($data->qty * $data->price_final, 2) . '</p></div>';

                $extra_messing_total = $extra_messing_total + ($data->qty * $data->price_final);
            }
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($extra_messing_total, 2) . '</p></div>';

        $final_total = $final_total + $extra_messing_total;

        if ($extra_messing->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }


        // ////////////////////// TEA


        $tea = DB::table('extra_orders')
            ->select('extra_orders.meal_time', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.qty', 'extra_orders.ordered_date', 'mess_menu_items.item_name')
            ->join('mess_menu_items', 'extra_orders.item_id', '=', 'mess_menu_items.id')
            ->whereIn('mess_menu_items.category_id', ['4'])
            ->whereNotIn('meal_time', ['0'])
            ->where('extra_orders.mess_id', '=', $mess_id)
            ->where('mess_menu_items.mess_id','=', $mess_id)
            ->where('extra_orders.officer_id', '=', $enumber)
            ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
            ->get();

        $html .= '<div class="menu_line2">Tea Details</div>';

        $tea_total = 0;

        foreach ($tea as $data) {

            if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet

                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p style="border: none;">' . $data->item_name . '</p><p></p><p>' . $data->qty . '</p><p>' . number_format($data->price, 2) . '</p><p>' . number_format($data->qty * $data->price, 2) . '</p></div>';

                $tea_total = $tea_total + ($data->qty * $data->price);
            } else { // alredy updated price
                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p style="border: none;">' . $data->item_name . '</p><p></p><p>' . $data->qty . '</p><p>' . number_format($data->price_final, 2) . '</p><p>' . number_format($data->qty * $data->price_final, 2) . '</p></div>';

                $tea_total = $tea_total + ($data->qty * $data->price_final);
            }

        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($tea_total, 2) . '</p></div>';

        $final_total = $final_total + $tea_total;

        if ($tea->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }


        // ////////////////////// BAR

        $summery_bar = DB::table('bars')
        ->select('bars.order_dt', 'items.name', 'bars.qty', 'bars.price',  'bars.measure')
        ->join('items','bars.item','=','items.id')
        ->whereBetween('bars.order_dt', [$date1, $date2])
        ->where('bars.mess_id','=', $mess_id)
        ->where('items.establishment_id','=', $mess_id)
        ->where('bars.officer_id','=', $enumber)
        ->get();

        $html .= '<div class="menu_line2">Bar Details</div>';

        $bar_total = 0;

        foreach($summery_bar as $data){

            $mesure_unit = DB::table('measure_units')
            ->select('measure_units.abbreviation')
            ->where('id','=', $data->measure)
            ->get();

            foreach($mesure_unit as $unit){
                $html .= '<div class="sum_populated_fields"><p>' . $data->order_dt . '</p><p style="border: none;">' . $data->name . ' (' . $unit->abbreviation . ')</p><p></p><p>' . $data->qty . '</p><p>'. number_format(($data->price / $data->qty),2) .'</p><p>' . number_format($data->price,2) . '</p></div>';

                $bar_total = $bar_total + $data->price;
            }
        }



        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($bar_total, 2) . '</p></div>';  

        $final_total = $final_total + $bar_total;

        if ($summery_bar->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }




        // ////////////////////// EVENT

        $summery_event =  DB::table('event_orders_mess')
        ->select('*')
        ->whereBetween('date', [$date1, $date2])
        ->where('officer_id','=', $enumber)
        ->where('mess_id','=', $mess_id)
        ->get();

        $html .= '<div class="menu_line2">Event Details</div>';

        $bar_total = 0;

        foreach($summery_event as $data){

            $html .= '<div class="sum_populated_fields"><p>' . $data->date . '</p><p style="width: 80%;">' . $data->event_name . '</p>  <p>' . number_format($data->value,2) . '</p></div>';

            $bar_total = $bar_total + ($data->value);
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($bar_total, 2) . '</p></div>';

        $final_total = $final_total + $bar_total;


        if ($summery_event->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }



        ////////////////////// GENERAL DEDUCTION

        $general =  DB::table('general_deduction')
        ->select('*')
        ->whereBetween('date', [$date1, $date2])
        ->where('officer_id','=', $enumber)
        ->where('mess_id','=', $mess_id)
        ->get();

        $html .= '<div class="menu_line2">General Deduction</div>';

        $bar_total = 0;

        foreach($general as $data){

            $html .= '<div class="sum_populated_fields general_deduction"><p>' . $data->date . '</p><p style="width: 80%;">' . $data->name . '</p><p>' . number_format($data->value,2) . '</p></div>';

            $bar_total = $bar_total + ($data->value);
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($bar_total, 2) . '</p></div>';

        $final_total = $final_total + $bar_total;

        $html .= '<div class="sum_populated_fields_total"><p>Total Bill</p><p>Rs: ' . number_format($final_total, 2) . '</p></div>';

        if ($general->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }

        if ($data_not_found_error_count == 6) { // If no records in all 4 sections in db, display error
            $html = '<p class="no_data alert alert-danger">No Bill is Available for the Selected Date Range</p>';
        }



        echo $html;

    }














    public function allOfficerOrderDetails(Request $req)
    {

        $mess_id = Auth::user()->mess_id;
        $date1 = $req->date1;
        $date2 = $req->date2;

        $enum = '0';

        $all_users = User::select('*')
        ->join('officers_assigns','users.email','=','officers_assigns.enum')
        ->where('officers_assigns.status','=','1')
        ->where('officers_assigns.mess_id','=', $mess_id)
        // ->whereIn('officers_assigns.enum', ['100003519' , '100380855' , '100003252'])
        // ->whereIn('officers_assigns.enum', ['100003252'])
        ->get(); 

        $total_bill = 0;
        $total_bill_all = 0;

        $html = '<div class="menu_line"><p>Officer Details</p><p>Total Bill</p></div>';

        foreach($all_users as $no){

            $enum = $no->email;

            //////////////////////  MESSING
            $messing = DB::table('mess_orders')
                ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.rtaion_date', 'mess_daily_rations.tentative_price', 'mess_daily_rations.price_final', 'mess_daily_rations.meal_time' , 'mess_orders.officer_id')
                ->join('mess_daily_rations', 'mess_orders.rtaion_date', '=', 'mess_daily_rations.ration_date')
                ->where('mess_orders.mess_id', '=', $mess_id)
                ->where('mess_daily_rations.mess_id','=', $mess_id)
                ->where('mess_orders.officer_id', '=', $enum)
                ->whereBetween('mess_orders.rtaion_date', [$date1, $date2])
                ->get();

            $data_not_found_error_count = 0;

            $messing_total = 0;

            foreach ($messing as $data) {
                if ($data->meal_time == 'breakfast') {

                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                        $messing_total = $messing_total + ($data->order_breakfast * $data->tentative_price); 
                    }
                    else{ // alredy updated price
                        $messing_total = $messing_total + ($data->order_breakfast * $data->price_final);
                    }
                }

                if ($data->meal_time == 'lunch') {

                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                        $messing_total = $messing_total + ($data->order_lunch * $data->tentative_price); 
                    }
                    else{ // alredy updated price
                        $messing_total = $messing_total + ($data->order_lunch * $data->price_final);
                    }
                }

                if ($data->meal_time == 'dinner') {

                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                        $messing_total = $messing_total + ($data->order_dinner * $data->tentative_price); 
                    }
                    else{ // alredy updated price
                        $messing_total = $messing_total + ($data->order_dinner * $data->price_final);
                    }
                }
            }

            if ($messing->count() <= 0) { // If no records in db, count it
                $data_not_found_error_count = $data_not_found_error_count + 1;
            }

            ////////////////////// EXTRA MESSING

            $extra_messing = DB::table('extra_orders')
                ->select('extra_orders.meal_time', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.qty', 'extra_orders.ordered_date', 'mess_menu_items.item_name')
                ->join('mess_menu_items', 'extra_orders.item_id', '=', 'mess_menu_items.id')
                ->whereIn('mess_menu_items.category_id', ['2', '3'])
                ->whereNotIn('meal_time', ['0'])
                ->where('extra_orders.mess_id','=', $mess_id)
                ->where('mess_menu_items.mess_id','=', $mess_id)
                ->where('extra_orders.officer_id', '=', $enum)
                ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
                ->get();

            $extra_messing_total = 0;

            foreach ($extra_messing as $data) {

                if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                    $extra_messing_total = $extra_messing_total + ($data->qty * $data->price);
                } else { // alredy updated price
                    $extra_messing_total = $extra_messing_total + ($data->qty * $data->price_final);
                }
            }
            if ($extra_messing->count() <= 0) { // If no records in db, count it
                $data_not_found_error_count = $data_not_found_error_count + 1;
            }

            // ////////////////////// TEA

            $tea = DB::table('extra_orders')
                ->select('extra_orders.meal_time', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.qty', 'extra_orders.ordered_date', 'mess_menu_items.item_name')
                ->join('mess_menu_items', 'extra_orders.item_id', '=', 'mess_menu_items.id')
                ->whereIn('mess_menu_items.category_id', ['4'])
                ->whereNotIn('meal_time', ['0'])
                ->where('extra_orders.mess_id', '=', $mess_id)
                ->where('mess_menu_items.mess_id','=', $mess_id)
                ->where('extra_orders.officer_id', '=', $enum)
                ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
                ->get();

            $tea_total = 0;

            foreach ($tea as $data) {

                if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                    $tea_total = $tea_total + ($data->qty * $data->price);
                } else { // alredy updated price
                    $tea_total = $tea_total + ($data->qty * $data->price_final);
                }

            }

            if ($tea->count() <= 0) { // If no records in db, count it
                $data_not_found_error_count = $data_not_found_error_count + 1;
            }

            // ////////////////////// BAR

            $summery_bar = DB::table('bars')
            ->select('bars.order_dt', 'items.name', 'bars.qty', 'bars.price',  'bars.measure')
            ->join('items','bars.item','=','items.id')
            ->whereBetween('bars.order_dt', [$date1, $date2])
            ->where('bars.mess_id','=', $mess_id)
            ->where('items.establishment_id','=', $mess_id)
            ->where('bars.officer_id','=', $enum)
            ->get();

            $bar_total = 0;

            foreach($summery_bar as $data){

                $mesure_unit = DB::table('measure_units')
                ->select('measure_units.abbreviation')
                ->where('id','=', $data->measure)
                ->get();

                foreach($mesure_unit as $unit){
                    $bar_total = $bar_total + $data->price;
                }
            }

            if ($summery_bar->count() <= 0) { // If no records in db, count it
                $data_not_found_error_count = $data_not_found_error_count + 1;
            }

            // ////////////////////// EVENT

            $summery_event =  DB::table('event_orders_mess')
            ->select('*')
            ->whereBetween('date', [$date1, $date2])
            ->where('officer_id','=', $enum)
            ->where('mess_id','=', $mess_id)
            ->get();

            $event_total = 0;

            foreach($summery_event as $data){
                $event_total = $event_total + ($data->value);
            }

            if ($summery_event->count() <= 0) { // If no records in db, count it
                $data_not_found_error_count = $data_not_found_error_count + 1;
            }

            ////////////////////// GENERAL DEDUCTION

            $general =  DB::table('general_deduction')
            ->select('*')
            ->whereBetween('date', [$date1, $date2])
            ->where('officer_id','=', $enum)
            ->where('mess_id','=', $mess_id)
            ->get();

            $general_total = 0;

            foreach($general as $data){
                $general_total = $general_total + ($data->value);
            }
            

            $total_bill = $messing_total + $extra_messing_total + $tea_total + $bar_total + $event_total + $general_total;

            $html .= '<div class="sum_populated_fields st"><p>'.$no->service_no.' '.$no->rank.' '.$no->name_according_to_part2.' ('.$enum.')</p><p>' . number_format($total_bill, 2) . '</p></div>';

            $total_bill_all = $total_bill_all + $total_bill;

        }

        $html .= '<div class="sum_populated_fields_total"><p>Total Bill</p><p>Rs: ' . number_format($total_bill_all, 2) . '</p></div>';
        
        echo $html;

    }





    public function billingEventSave(Request $req){
        
    }    





}

