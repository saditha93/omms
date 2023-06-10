<?php

namespace App\Http\Controllers;

use App\Models\ExtraOrders;
use App\Models\ItemPrices;
use App\Models\MessDailyRations;
use App\Models\MessMenu;
use App\Models\MessMenuDetails;
use App\Models\MessMenuItem;
use App\Models\MessOrders;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cookie;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $officers = User::join('officers_assigns','officers_assigns.enum','=','users.email')
            ->where('officers_assigns.status',1)
            ->where('officers_assigns.mess_id',Auth::user()->mess_id)
            ->get();

        $rations = MessDailyRations::join('mess_menu_details','mess_menu_details.id','=','mess_daily_rations.mess_menu_id')
            ->join('mess_menus','mess_menus.mess_menu_id','=','mess_menu_details.id')
            ->where('mess_daily_rations.mess_id',Auth::user()->mess_id)
            ->where('mess_daily_rations.ration_date',Carbon::today()->toDateString())
            ->groupBy('mess_daily_rations.mess_menu_id','mess_daily_rations.dessert_item_id','mess_daily_rations.tentative_price', 'mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id','mess_menu_details.menu_name','mess_daily_rations.id')
            ->get(['mess_daily_rations.id','mess_daily_rations.mess_menu_id','mess_daily_rations.dessert_item_id','mess_daily_rations.tentative_price','mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id',
                'mess_menu_details.menu_name']);


        foreach ($rations as $ration) {

            $rationDate = MessDailyRations::where('id',$ration->id)
                ->get('ration_date');
            $ration->ration_date = $rationDate[0]->ration_date;

            $todaysDessert = MessMenuItem::where('id',$ration->dessert_item_id)
                ->get('item_name');
            $ration->dessert = isset($todaysDessert[0]->item_name)?$todaysDessert[0]->item_name:'No Dessert Added';

            $items = MessMenu::join('mess_menu_details','mess_menu_details.id','=','mess_menus.mess_menu_id')
                ->join('mess_menu_items','mess_menu_items.id','mess_menus.item_id')
                ->where('mess_menus.mess_menu_id', $ration->mess_menu_id)
                ->get('mess_menu_items.item_name');

            $dailyRation = array();
            foreach ($items as $item)
            {
                array_push($dailyRation,$item['item_name']) ;
            }
            $ration->items = $dailyRation;
        }



        $teaitems = ItemPrices::join('mess_menu_items','mess_menu_items.id','mess_menu_item_prices.item_id')
            ->where('mess_menu_items.category_id',4)
            ->where('mess_menu_items.mess_id',Auth::user()->mess_id)
            ->groupBy('mess_menu_item_prices.item_id','mess_menu_items.item_name','mess_menu_item_prices.scale')
            ->get(['mess_menu_item_prices.item_id','mess_menu_items.item_name','mess_menu_item_prices.scale']);

        foreach ($teaitems as $teaitem)
        {

            $teaItemLatestPrice = ItemPrices::where('item_id',$teaitem->item_id)->orderBy('id', 'DESC')->first();
            $teaitem->price = $teaItemLatestPrice->price;
            $teaitem->id = $teaItemLatestPrice->id;
        }


        $extraMessings = ItemPrices::join('mess_menu_items','mess_menu_items.id','mess_menu_item_prices.item_id')
            ->where('mess_menu_items.category_id',3)
            ->where('mess_menu_items.mess_id',Auth::user()->mess_id)
            ->groupBy('mess_menu_item_prices.item_id','mess_menu_items.item_name','mess_menu_item_prices.scale')
            ->get(['mess_menu_item_prices.item_id','mess_menu_items.item_name','mess_menu_item_prices.scale']);

        foreach ($extraMessings as $extraMessing)
        {
            $extraMessingLatestPrice = ItemPrices::where('item_id',$extraMessing->item_id)->orderBy('id', 'DESC')->first();
            $extraMessing->price = $extraMessingLatestPrice->price;
            $extraMessing->id = $extraMessingLatestPrice->id;
        }

        $desserts = ItemPrices::join('mess_menu_items','mess_menu_items.id','mess_menu_item_prices.item_id')
            ->where('mess_menu_items.category_id',2)
            ->where('mess_menu_items.mess_id',Auth::user()->mess_id)
            ->groupBy('mess_menu_item_prices.item_id','mess_menu_items.item_name','mess_menu_item_prices.scale')
            ->get(['mess_menu_item_prices.item_id','mess_menu_items.item_name','mess_menu_item_prices.scale']);

        foreach ($desserts as $dessert)
        {
            $dessertsLatestPrice = ItemPrices::where('item_id',$dessert->item_id)->orderBy('id', 'DESC')->first();
            $dessert->price = $dessertsLatestPrice->price;
            $dessert->id = $dessertsLatestPrice->id;
        }


       return view('admin.master-data.orders.index', compact('officers', 'rations','teaitems','extraMessings','desserts'));
    }

    public function getOfficerDetails(Request $request)
    {
        $officerDetails = User::where('id', $request->officer_id)
            ->get();

        return $officerDetails;
    }


    public function placeAnOrder(Request $request)
    {
        if ($request->order_type == "dessert")
        {

            $item = ItemPrices::where('id',$request->order_id)
                ->get(['mess_menu_item_prices.price','mess_menu_item_prices.item_id']);

            $order = ExtraOrders::create([
                'mess_id' => Auth::user()->mess_id,
                'officer_id' => $request->service_number,
                'item_id' => $item[0]->item_id,
                'meal_time' => $request->time,
                'qty' => $request->qty,
                'price' => $item[0]->price,
                'ordered_date' => $request->order_date,
                'note' => $request->remarks,
                'ip' => request()->ip(),
                'status' => 0,
                'created_by' => Auth::user()->id,

            ]);

            return json_encode(true);
        }



        if ($request->order_type == "extra")
        {

            $item = ItemPrices::where('id',$request->order_id)
                ->get(['mess_menu_item_prices.price','mess_menu_item_prices.item_id']);

            $order = ExtraOrders::create([
                'mess_id' => Auth::user()->mess_id,
                'officer_id' => $request->service_number,
                'item_id' => $item[0]->item_id,
                'meal_time' => $request->time,
                'qty' => $request->qty,
                'price' => $item[0]->price,
                'ordered_date' => $request->order_date,
                'note' => $request->remarks,
                'ip' => request()->ip(),
                'status' => 0,
                'created_by' => Auth::user()->id,

            ]);

            return json_encode(true);
        }

        if ($request->order_type == "tea")
        {

            $item = ItemPrices::where('id',$request->order_id)
                ->get(['mess_menu_item_prices.price','mess_menu_item_prices.item_id']);

            $order = ExtraOrders::create([
                'mess_id' => Auth::user()->mess_id,
                'officer_id' => $request->service_number,
                'item_id' => $item[0]->item_id,
                'meal_time' => $request->time,
                'qty' => $request->qty,
                'price' => $item[0]->price,
                'ordered_date' => $request->order_date,
                'note' => $request->remarks,
                'ip' => request()->ip(),
                'status' => 0,
                'created_by' => Auth::user()->id,

            ]);

            return json_encode(true);
        }

        if ($request->order_type == "ration") {


            $orderType = MessDailyRations::join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_daily_rations.mess_menu_id')
                ->where('mess_daily_rations.id', $request->order_id)
                ->get(['mess_daily_rations.meal_time', 'mess_daily_rations.ration_date']);


            $breakfast = 0;
            $lunch = 0;
            $dinner = 0;
            $event = 0;
            $other = 0;

            $breakfast_status = '';
            $lunch_status = '';
            $dinner_status = '';
            $event_status = '';
            $other_status = '';

            if ($orderType[0]->meal_time == 'breakfast') {
                $breakfast = $request->qty;
                $breakfast_status = 1;
            }
            if ($orderType[0]->meal_time == 'lunch') {
                $lunch = $request->qty;
                $lunch_status = 1;
            }
            if ($orderType[0]->meal_time == 'dinner') {
                $dinner = $request->qty;
                $dinner_status = 1;
            }
            if ($orderType[0]->meal_time == 'event') {
                $event = $request->qty;
                $event_status = 1;
            }
            if ($orderType[0]->meal_time == 'other') {
                $other = $request->qty;
                $other_status =1;
            }

            $existOrdersForToday = MessOrders::where('officer_id',$request->service_number)
                ->where('rtaion_date',$orderType[0]->ration_date)
                ->get('id');

            if (isset($existOrdersForToday[0]->id))
            {


                if ($orderType[0]->meal_time == 'breakfast') {

                    MessOrders::where('id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_breakfast' => $breakfast,
                            'order_breakfast_status' => $breakfast_status,
                        ]);

                }
                if ($orderType[0]->meal_time == 'lunch') {

                    MessOrders::where('id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_lunch' => $lunch,
                            'order_lunch_status' => $lunch_status,
                        ]);
                }
                if ($orderType[0]->meal_time == 'dinner') {

                    MessOrders::where('id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_dinner' => $dinner,
                            'order_dinner_status' => $dinner_status,
                        ]);

                }
                if ($orderType[0]->meal_time == 'event') {

                    MessOrders::where('id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_event' => $event,
                            'order_event_status' => $event_status,
                        ]);

                }
                if ($orderType[0]->meal_time == 'other') {

                    MessOrders::where('id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_other' => $other,
                            'order_other_status' => $other_status,
                        ]);

                }
                return json_encode(true);
            }
            else
            {
                $order = MessOrders::create([
                    'mess_id' => Auth::user()->mess_id,
                    'officer_id' => $request->service_number,
                    'order_breakfast' => $breakfast,
                    'order_breakfast_status' => intval($breakfast_status),
                    'order_lunch' => $lunch,
                    'order_lunch_status' => intval($lunch_status),
                    'order_dinner' => $dinner,
                    'order_dinner_status' => intval($dinner_status),
                    'order_event' => $event,
                    'order_event_status' => intval($event_status),
                    'order_other' => $other,
                    'order_other_status' => intval($other_status),
                    'ordered_date' => Carbon::today()->toDateString(),
                    'rtaion_date' => $orderType[0]->ration_date,
                    'created_by' => Auth::user()->id,
                    'ip' => request()->ip(),
                ]);
                return json_encode(true);
            }




        }

    }

    public function rationSearch(Request $request)
    {



        $rations = MessDailyRations::join('mess_menu_details','mess_menu_details.id','=','mess_daily_rations.mess_menu_id')
            ->join('mess_menus','mess_menus.mess_menu_id','=','mess_menu_details.id')
            ->where('mess_daily_rations.mess_id',Auth::user()->mess_id)
            ->where('mess_daily_rations.ration_date', $request->date)
            ->groupBy('mess_daily_rations.mess_menu_id','mess_daily_rations.dessert_item_id','mess_daily_rations.tentative_price','mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id','mess_menu_details.menu_name','mess_daily_rations.id')
            ->get(['mess_daily_rations.id','mess_daily_rations.mess_menu_id','mess_daily_rations.dessert_item_id','mess_daily_rations.tentative_price','mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id',
                'mess_menu_details.menu_name']);


        foreach ($rations as $ration) {

            $rationDate = MessDailyRations::where('id',$ration->id)
                ->get('ration_date');
            $ration->ration_date = $rationDate[0]->ration_date;

            $todaysDessert = MessMenuItem::where('id',$ration->dessert_item_id)
                ->get('item_name');
            $ration->dessert = isset($todaysDessert[0]->item_name)?$todaysDessert[0]->item_name:'No Dessert Added';

            $items = MessMenu::join('mess_menu_details','mess_menu_details.id','=','mess_menus.mess_menu_id')
                ->join('mess_menu_items','mess_menu_items.id','mess_menus.item_id')
                ->where('mess_menus.mess_menu_id', $ration->mess_menu_id)
                ->get(['mess_menu_items.item_name','mess_menu_details.meal_type',
                    'mess_menu_details.menu_name']);

            $ration->meal_type = $items[0]->meal_type;

            $dailyRation = array();
            foreach ($items as $item)
            {
                array_push($dailyRation,'<li>'.$item['item_name'].'</li>') ;
            }
            $strArry = json_encode($dailyRation);
            $ration->items = str_replace( array( '\\', '"','[' , ']',',' ), '', $strArry);

        }
        return json_encode($rations);

    }

    public function orderDetails(Request $request)
    {
        $officers = User::join('officers_assigns','officers_assigns.enum','=','users.email')
            ->where('officers_assigns.status',1)
            ->where('officers_assigns.mess_id',Auth::user()->mess_id)
            ->get();

        return view('admin.master-data.orders.view', compact('officers'));
    }

    
    public function orderReport(Request $request)
    {
        $officers = User::all();
        return view('admin.master-data.orders.report', compact('officers'));
    }

    public function officerRespectiveOrders(Request $request)
    {

        $s_number = User::where('id',$request->officer_id)
            ->get('email');

        $returnArray= array();

        $orderType='';
        $orderQty ='';
        $orderStatus='';

        $orders = MessOrders::where('officer_id',$s_number[0]->email)->get(['id','rtaion_date']);


        foreach ($orders as $order)
        {


            $breakfast = MessOrders::where('id',$order->id)
                ->get(['order_breakfast','order_breakfast_status']);

            if ($breakfast[0]->order_breakfast >=1)
            {
                $orderType='Breakfast';
                $orderQty = $breakfast[0]->order_breakfast;
                $orderStatus=$breakfast[0]->order_breakfast_status;
            }


            $lunch = MessOrders::where('id',$order->id)
                 ->get(['order_lunch','order_lunch_status']);
            if ($lunch[0]->order_lunch >=1)
            {
                $orderType='Lunch';
                $orderQty = $lunch[0]->order_lunch;
                $orderStatus=$lunch[0]->order_lunch_status;
            }

            $dinner = MessOrders::where('id',$order->id)
                ->get(['order_dinner','order_dinner_status']);
            if ($dinner[0]->order_dinner >=1)
            {
                $orderType='Dinner';
                $orderQty = $dinner[0]->order_dinner;
                $orderStatus=$dinner[0]->order_dinner_status;
            }

            $event = MessOrders::where('id',$order->id)
                ->get(['order_event','order_event_status']);
            if ($event[0]->order_event >=1)
            {
                $orderType='Event';
                $orderQty = $event[0]->order_event;
                $orderStatus=$event[0]->order_event_status;
            }

            $other = MessOrders::where('id',$order->id)
                ->get(['order_other','order_other_status']);
            if ($other[0]->order_other >=1)
            {
                $orderType='Other';
                $orderQty = $other[0]->order_other;
                $orderStatus=$other[0]->order_other_status;
            }

            $order['orderType'] = $orderType;
            $order['orderQtye'] = $orderQty;
            $order['orderStatus'] = $orderStatus;
        }


        return DataTables::of($orders)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                if ($row->orderStatus ==1)
                {
                    $btnEdit = '<button class="btn btn-sm btn-success " href="" disabled="disabled">Approved</button>';
                }
                else
                {
                    $btnEdit = '<a class="btn btn-sm btn-success btn-ration-order-approve" href="">Approve</a>';
                }

                return $btnEdit;
            })
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make(true);

    }

    public function acceptRationOrder(Request $request)
    {
        $rtime = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
            ->where('mess_orders.id',$request->rowId)
            ->get('mess_daily_rations.meal_time');

        $rtimeBreakfast = 0;
        $rtimeLunch = 0;
        $rtimeDinner = 0;
        $rtimeOther = 0;
        $rtimeEvent = 0;


        if ($rtime[0]->meal_time == 'breakfast')
        {
            $rtimeBreakfast = 1;
        }
        if ($rtime[0]->meal_time == 'lunch')
        {
            $rtimeLunch = 1;
        }
        if ($rtime[0]->meal_time == 'dinner')
        {
            $rtimeDinner = 1;
        }
        if ($rtime[0]->meal_time == 'event')
        {
            $rtimeEvent = 1;
        }
        if ($rtime[0]->meal_time == 'other')
        {
            $rtimeOther = 1;
        }


        MessOrders::where('id',$request->rowId)
            ->update([
                'order_breakfast_status' => $rtimeBreakfast,
                'order_lunch_status' => $rtimeLunch,
                'order_dinner_status' => $rtimeDinner,
                'order_event_status' => $rtimeEvent,
                'order_other_status' => $rtimeOther,
                'accepted_by' => Auth::user()->id,
            ]);

        return true;
    }




    public function allBbreakfast(Request $request)
    {
        return view('admin.master-data.orders.all_breakfast_orders');
    }

    public function getAllBreakfasts(Request $request)
    {

        if ($request->ajax()) {

            $data = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
                ->join('users','users.email','=','mess_orders.officer_id')
                ->join('mess_menu_details','mess_menu_details.id','=','mess_daily_rations.mess_menu_id')
                ->where('mess_orders.mess_id',Auth::user()->mess_id)
                ->where('mess_orders.order_breakfast','>=',1)

                ->when((($request->fromDate != 0) && ($request->toDate != 0)), function ($query) use ($request) {
                    return $query->whereBetween('mess_orders.rtaion_date', [$request->fromDate, $request->toDate]);
                })
                ->groupBy(['users.name_according_to_part2','mess_menu_details.menu_name','mess_orders.order_breakfast','mess_orders.officer_id','mess_orders.rtaion_date'])
                ->get(['users.name_according_to_part2','mess_menu_details.menu_name','mess_orders.order_breakfast','mess_orders.officer_id','mess_orders.rtaion_date']);


            return DataTables::of($data)
                ->setRowId('id')
                ->make(true);

        }
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessOrders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(MessOrders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessOrders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(MessOrders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessOrders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessOrders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessOrders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessOrders $orders)
    {
        //
    }




    public function orderReportDetails(Request $req)
    {


        //////////////////////  MESSING

        $mess_id = Auth::user()->mess_id;
        $enumber = $req->enumber;
        $date1 = $req->date1;
        $date2 = $req->date2;      

        $messing = DB::table('mess_orders')
        ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.rtaion_date')
        ->where('mess_orders.mess_id','=', $mess_id)
        ->where('mess_orders.officer_id','=', $enumber)
        ->whereBetween('mess_orders.rtaion_date', [$date1, $date2])
        ->get();

        // dd($messing);

        // $messing = DB::table('mess_orders')
        // ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.rtaion_date', 'mess_daily_rations.tentative_price' , 'mess_daily_rations.price_final' , 'mess_daily_rations.meal_time')
        // ->join('mess_daily_rations','mess_orders.rtaion_date','=','mess_daily_rations.ration_date')
        // ->where('mess_orders.mess_id','=', $mess_id)
        // ->where('mess_orders.officer_id','=', $enumber)
        // ->whereBetween('mess_orders.rtaion_date', [$date1, $date2])
        // ->get();
        

        // dd($messing);

        $data_not_found_error_count = 0;

        $html = '<div class="menu_line"><p>Ordered Date</p><p>Menu</p><p>Qty</p><p>Unit Price (Rs.)</p><p>Total (Rs.)</p></div>
        <div class="menu_line2">Messing Details</div>';

        $messing_total = 0;
        $final_total = 0;

        foreach($messing as $data){

            if ($data->meal_time == 'breakfast') {

                if ($data->order_breakfast == null || $data->order_breakfast == '0') {
                    $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Breakfast</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet

                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Breakfast</p><p>' . $data->order_breakfast . '</p><p>'. number_format($data->tentative_price,2) .'</p><p>' . number_format($data->order_breakfast * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_breakfast * $data->tentative_price); 
                    }
                    else{ // alredy updated price
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Breakfast</p><p>' . $data->order_breakfast . '</p><p>'. number_format($data->price_final,2) .'</p><p>' . number_format($data->order_breakfast * $data->price_final,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_breakfast * $data->price_final);
                    }

                }
            }

            if ($data->meal_time == 'lunch') {

                if ($data->order_lunch == null || $data->order_lunch == '0') {
                    $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Lunch</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Lunch</p><p>' . $data->order_lunch . '</p><p>'. number_format($data->tentative_price,2) .'</p><p>' . number_format($data->order_lunch * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_lunch * $data->tentative_price);
                    }
                    else{ // alredy updated price
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Lunch</p><p>' . $data->order_lunch . '</p><p>'. number_format($data->price_final,2) .'</p><p>' . number_format($data->order_lunch * $data->price_final,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_lunch * $data->price_final);
                    }
                }
            }

            if ($data->meal_time == 'dinner') {

                if ($data->order_dinner == null || $data->order_dinner == '0') {
                    $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Dinner</p><p class="not">- Not Ordered -</p></div>';
                }
                else{
                    if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Dinner</p><p>' . $data->order_dinner . '</p><p>'. number_format($data->tentative_price,2) .'</p><p>' . number_format($data->order_dinner * $data->tentative_price,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_dinner * $data->tentative_price);
                    }
                    else{ // alredy updated price 
                        $html .= '<div class="sum_populated_fields"><p>' . $data->rtaion_date . '</p><p>Dinner</p><p>' . $data->order_dinner . '</p><p>'. number_format($data->price_final,2) .'</p><p>' . number_format($data->order_dinner * $data->price_final,2) . '</p></div>';

                        $messing_total = $messing_total + ($data->order_dinner * $data->price_final);
                    }

                }
            }

        }

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
        // ->where('extra_orders.mess_id','=', $mess_id)
        ->where('extra_orders.officer_id','=', $enumber)
        ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
        ->get();

        $html .= '<div class="menu_line2">Extra Messing Details</div>';

        $extra_messing_total = 0;

        foreach($extra_messing as $data){

            if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p>'. $data->item_name .'</p><p>' . $data->qty . '</p><p>'. number_format($data->price,2) .'</p><p>' . number_format($data->qty * $data->price,2) . '</p></div>';

                $extra_messing_total = $extra_messing_total + ($data->qty * $data->price);
            }
            else{ // alredy updated price 
                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p>'. $data->item_name .'</p><p>' . $data->qty . '</p><p>'. number_format($data->price_final,2) .'</p><p>' . number_format($data->qty * $data->price_final,2) . '</p></div>';

                $extra_messing_total = $extra_messing_total + ($data->qty * $data->price_final);
            }
        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($extra_messing_total,2) . '</p></div>';

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
        ->where('extra_orders.officer_id','=', $enumber)
        ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
        ->get();

        $html .= '<div class="menu_line2">Tea Details</div>';

        $tea_total = 0;

        foreach($tea as $data){

            if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet 
            
                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p>'. $data->item_name .'</p><p>' . $data->qty . '</p><p>'. number_format($data->price,2) .'</p><p>' . number_format($data->qty * $data->price,2) . '</p></div>';

                $tea_total = $tea_total + ($data->qty * $data->price);
            }
            else{ // alredy updated price 
                $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p>'. $data->item_name .'</p><p>' . $data->qty . '</p><p>'. number_format($data->price_final,2) .'</p><p>' . number_format($data->qty * $data->price_final,2) . '</p></div>';

                $tea_total = $tea_total + ($data->qty * $data->price_final);
            }

        }

        $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($tea_total,2) . '</p></div>';

        $final_total = $final_total + $tea_total;

        if ($tea->count() <= 0) { // If no records in db, count it
            $data_not_found_error_count = $data_not_found_error_count + 1;
        }



        // ////////////////////// CANTEEN

        // $summery_canteen = DB::table('extra_orders')
        // ->select("*") 
        // ->where('extra_orders.meal_time','=', 0)
        // ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
        // // ->where('extra_orders.mess_id','=', $mess_id)
        // ->where('extra_orders.officer_id','=', $enumber)
        // ->get();

        // $html .= '<div class="menu_line2">Canteen Details</div>';

        // $canteen_total = 0;

        // foreach($summery_canteen as $data){

        //     $item_name_extract = explode("|", $data->note );
        //     $item_name = $item_name_extract[0];

        //     $html .= '<div class="sum_populated_fields"><p>' . $data->ordered_date . '</p><p>' . $item_name . '</p><p>' . $data->qty . '</p><p>'. number_format($data->price,2) .'</p><p>' . number_format($data->qty * $data->price,2) . '</p></div>';

        //     $canteen_total = $canteen_total + ($data->qty * $data->price);
        // }

        // $html .= '<div class="sum_populated_fields st"><p class="p1">Sub Total</p><p class="p2">' . number_format($canteen_total,2) . '</p></div>';

        // $final_total = $final_total + $canteen_total;

        $html .= '<div class="sum_populated_fields_total"><p>Total Bill</p><p>Rs: ' . number_format($final_total,2) . '</p></div>';

        // if ($summery_canteen->count() <= 0) { // If no records in db, count it
        //     $data_not_found_error_count = $data_not_found_error_count + 1;
        // }




        if ($data_not_found_error_count == 3) { // If no records in all 3 sections in db, display error
            $html = '<p class="no_data">No Bill is Available for the Selected Month</p>';
        }
        

        echo $html;

    }





    //////// BILLING ////////

    public function billing(){
        return view('admin.master-data.billing.billing');
    }


    //// MESSING ////
    public function billingMessing(Request $req){

        $mess_id = Auth::user()->mess_id;

        $billing = DB::table('mess_daily_rations')
        ->select('mess_daily_rations.id', 'mess_menu_details.menu_name', 'mess_daily_rations.meal_time', 'mess_menu_details.meal_type', 'mess_daily_rations.tentative_price' , 'mess_daily_rations.price_final')
        ->join('mess_menu_details','mess_daily_rations.mess_menu_id','=','mess_menu_details.id')
        ->where('mess_daily_rations.ration_date','=', $req->date)
        ->where('mess_daily_rations.mess_id','=', $mess_id)
        ->get();

        // dd($billing);

        $html = '';

        foreach($billing as $data){

            $price_final = $data->price_final;
            if ($price_final == "" || $price_final == null) {
                $price_final = "-";
            }

            $meal_type = $data->meal_type;
            if ($meal_type == "1") {
                $meal_type = "Non-Veg";
            }
            else{
                $meal_type = "Veg";
            }

            $html .= '<tr>';
            $html .= "<td>{$data->menu_name}</td>";
            $html .= "<td>{$meal_type}</td>";
            $html .= "<td>{$data->meal_time}</td>";
            $html .= "<td>Rs. {$data->tentative_price}</td>";
            $html .= "<td class='updated_price_td'>Rs. {$price_final}</td>";
            $html .= "<td class='final_price'><div><input class='updated_price form-control' type='number'><button id='{$data->id}' class='update_m btn btn-primary'>Update</button><button id='{$data->id}' data-price='{$data->tentative_price}' class='update_same_m btn btn-primary'>Same</button></div></td>";
            $html .= '</tr>';

        }
        echo $html;

    }

    public function billingMessingUpdate(Request $req){

        $order_id = $req->order_id;
        $updated_price = $req->updated_price;
        DB::table('mess_daily_rations')->where('id', $order_id)->update(['price_final' => $updated_price]);
    }
    //// MESSING ////




    //// EXTRA MESSING ////
    public function billingExtraMessing(Request $req){

        $mess_id = Auth::user()->mess_id;

        $billing = DB::table('extra_orders')
        ->select('extra_orders.id', 'extra_orders.officer_id', 'extra_orders.price', 'extra_orders.price_final', 'mess_menu_items.item_name')
        ->join('mess_menu_items','extra_orders.item_id','=','mess_menu_items.id')
        ->where('extra_orders.ordered_date','=', $req->date)
        ->where('extra_orders.mess_id','=', $mess_id)
        ->whereIn('mess_menu_items.category_id' , [2, 3] )
        ->get();
        

        $html = '';

        foreach($billing as $data){

            $price_final = $data->price_final;
            if ($price_final == "" || $price_final == null) {
                $price_final = "-";
            }

            $html .= '<tr>';
            $html .= "<td>{$data->id}</td>";
            $html .= "<td>{$data->officer_id}</td>";
            $html .= "<td>{$data->item_name}</td>";
            $html .= "<td>Rs. {$data->price}</td>";
            $html .= "<td class='updated_price_td'>Rs. {$price_final}</td>";
            $html .= "<td class='final_price'><div><input class='updated_price form-control' type='number'><button id='{$data->id}' class='update_em btn btn-primary'>Update</button><button id='{$data->id}' data-price='{$data->price}' class='update_same_em btn btn-primary'>Same</button></div></td>";
            $html .= '</tr>';

        }
        echo $html;
    }

    public function billingExtraMessingUpdate(Request $req){
        $order_id = $req->order_id;
        $updated_price = $req->updated_price;
        DB::table('extra_orders')->where('id', $order_id)->update(['price_final' => $updated_price]);
    }
    //// EXTRA MESSING ////





    //// TEA ////
    public function billingTea(Request $req){

        $mess_id = Auth::user()->mess_id;

        $billing = DB::table('extra_orders')
        ->select('extra_orders.id', 'extra_orders.officer_id', 'extra_orders.price', 'extra_orders.price_final', 'mess_menu_items.item_name')
        ->join('mess_menu_items','extra_orders.item_id','=','mess_menu_items.id')
        ->where('extra_orders.ordered_date','=', $req->date)
        ->where('extra_orders.mess_id','=', $mess_id)
        ->where('mess_menu_items.category_id','=', '4')
        ->get();

        $html = '';

        foreach($billing as $data){

            $price_final = $data->price_final;
            if ($price_final == "" || $price_final == null) {
                $price_final = "-";
            }

            $html .= '<tr>';
            $html .= "<td>{$data->id}</td>";
            $html .= "<td>{$data->officer_id}</td>";
            $html .= "<td>{$data->item_name}</td>";
            $html .= "<td>Rs. {$data->price}</td>";
            $html .= "<td class='updated_price_td'>Rs. {$price_final}</td>";
            $html .= "<td class='final_price'><div><input class='updated_price form-control' type='number'><button id='{$data->id}' class='update_tea btn btn-primary'>Update</button><button id='{$data->id}' data-price='{$data->price}' class='update_same_tea btn btn-primary'>Same</button></div></td>";
            $html .= '</tr>';

        }
        echo $html;
    }

    public function billingTeaUpdate(Request $req){
        $order_id = $req->order_id;
        $updated_price = $req->updated_price;
        DB::table('extra_orders')->where('id', $order_id)->update(['price_final' => $updated_price]);
    }
    //// TEA ////




    //// TEA ////
    // public function billingTea(Request $req){

    //     $mess_id = Auth::user()->mess_id;

    //     $billing = DB::table('mess_menu_items')
    //     ->select( 'mess_menu_item_prices.id', 'mess_menu_items.item_name', 'mess_menu_item_prices.price', 'mess_menu_item_prices.status')
    //     ->join('mess_menu_item_prices','mess_menu_items.id','=','mess_menu_item_prices.item_id')
    //     ->where('mess_menu_item_prices.date','=', $req->date)
    //     ->where('mess_menu_items.category_id','=', '4')
    //     ->where('mess_menu_items.mess_id','=', $mess_id)
    //     ->get();

    //     dd($billing);

    //     $html = '';

    //     foreach($billing as $data){

    //         // $price_final = $data->price_final;
    //         // if ($price_final == "" || $price_final == null) {
    //         //     $price_final = "-";
    //         // }

    //         $html .= '<tr>';
    //         $html .= "<td>{$data->item_name}</td>";
    //         $html .= "<td class='updated_price_td'>Rs. {$data->price}</td>";
    //         // $html .= "<td class='updated_price_td'>Rs. {$data->price}</td>";
    //         $html .= "<td class='final_price'><div><input class='updated_price form-control' type='number'><button id='{$data->id}' class='update_tea btn btn-primary'>Update</button></div></td>";
    //         $html .= '</tr>';

    //     }
    //     echo $html;
    // }

    // public function billingTeaUpdate(Request $req){
    //     $item_price_id = $req->item_price_id;
    //     $updated_price = $req->updated_price;
    //     DB::table('mess_menu_item_prices')->where('id', $item_price_id)->update(['price' => $updated_price]);
    // }
    //// TEA ////

    





}
