<?php

namespace App\Http\Controllers;

use App\Models\EventOrders;
use App\Models\ExtraOrders;
use App\Models\ItemPrices;
use App\Models\MessDailyRations;
use App\Models\MessMenu;
use App\Models\MessMenuDetails;
use App\Models\MessMenuItem;
use App\Models\MessOrders;
use App\Models\Notifications;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;
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
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->get();

        $rations = MessDailyRations::join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_daily_rations.mess_menu_id')
            ->join('mess_menus', 'mess_menus.mess_menu_id', '=', 'mess_menu_details.id')
            ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
            ->where('mess_daily_rations.ration_date', Carbon::today()->toDateString())
            ->groupBy('mess_daily_rations.mess_menu_id', 'mess_daily_rations.dessert_item_id', 'mess_daily_rations.tentative_price', 'mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id', 'mess_menu_details.menu_name', 'mess_daily_rations.id')
            ->get(['mess_daily_rations.id', 'mess_daily_rations.mess_menu_id', 'mess_daily_rations.dessert_item_id', 'mess_daily_rations.tentative_price', 'mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id',
                'mess_menu_details.menu_name']);


        foreach ($rations as $ration) {

            $rationDate = MessDailyRations::where('id', $ration->id)
                ->get('ration_date');
            $ration->ration_date = $rationDate[0]->ration_date;

            $todaysDessert = MessMenuItem::where('id', $ration->dessert_item_id)
                ->get('item_name');
            $ration->dessert = isset($todaysDessert[0]->item_name) ? $todaysDessert[0]->item_name : 'No Dessert Added';

            $items = MessMenu::join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_menus.mess_menu_id')
                ->join('mess_menu_items', 'mess_menu_items.id', 'mess_menus.item_id')
                ->where('mess_menus.mess_menu_id', $ration->mess_menu_id)
                ->get('mess_menu_items.item_name');

            $dailyRation = array();
            foreach ($items as $item) {
                array_push($dailyRation, $item['item_name']);
            }
            $ration->items = $dailyRation;
        }


        $teaitems = ItemPrices::join('mess_menu_items', 'mess_menu_items.id', 'mess_menu_item_prices.item_id')
            ->where('mess_menu_items.category_id', 4)
            ->where('mess_menu_item_prices.status', 1)
            ->where('mess_menu_items.mess_id', Auth::user()->mess_id)
            ->groupBy('mess_menu_item_prices.item_id', 'mess_menu_items.item_name', 'mess_menu_item_prices.scale')
            ->get(['mess_menu_item_prices.item_id', 'mess_menu_items.item_name', 'mess_menu_item_prices.scale']);

        foreach ($teaitems as $teaitem) {

            $teaItemLatestPrice = ItemPrices::where('item_id', $teaitem->item_id)->orderBy('id', 'DESC')->first();
            $teaitem->price = $teaItemLatestPrice->price;
            $teaitem->id = $teaItemLatestPrice->id;
        }


        $extraMessings = ItemPrices::join('mess_menu_items', 'mess_menu_items.id', 'mess_menu_item_prices.item_id')
            ->where('mess_menu_items.category_id', 3)
            ->where('mess_menu_item_prices.status', 1)
            ->where('mess_menu_items.mess_id', Auth::user()->mess_id)
            ->groupBy('mess_menu_item_prices.item_id', 'mess_menu_items.item_name', 'mess_menu_item_prices.scale')
            ->get(['mess_menu_item_prices.item_id', 'mess_menu_items.item_name', 'mess_menu_item_prices.scale']);

        foreach ($extraMessings as $extraMessing) {
            $extraMessingLatestPrice = ItemPrices::where('item_id', $extraMessing->item_id)->orderBy('id', 'DESC')->first();
            $extraMessing->price = $extraMessingLatestPrice->price;
            $extraMessing->id = $extraMessingLatestPrice->id;
        }

        $desserts = ItemPrices::join('mess_menu_items', 'mess_menu_items.id', 'mess_menu_item_prices.item_id')
            ->where('mess_menu_items.category_id', 2)
            ->where('mess_menu_item_prices.status', 1)
            ->where('mess_menu_items.mess_id', Auth::user()->mess_id)
            ->groupBy('mess_menu_item_prices.item_id', 'mess_menu_items.item_name', 'mess_menu_item_prices.scale')
            ->get(['mess_menu_item_prices.item_id', 'mess_menu_items.item_name', 'mess_menu_item_prices.scale']);

        foreach ($desserts as $dessert) {
            $dessertsLatestPrice = ItemPrices::where('item_id', $dessert->item_id)->orderBy('id', 'DESC')->first();
            $dessert->price = $dessertsLatestPrice->price;
            $dessert->id = $dessertsLatestPrice->id;
        }


        return view('admin.master-data.orders.index', compact('officers', 'rations', 'teaitems', 'extraMessings', 'desserts'));
    }

    public function getOfficerDetails(Request $request)
    {
        $officerDetails = User::join('officers_assigns','officers_assigns.enum','=','users.email')
        ->where('officers_assigns.id', $request->officer_id)
            ->get();

        return $officerDetails;
    }


    public function placeAnOrder(Request $request)
    {
        if ($request->order_type == "dessert") {

            $item = ItemPrices::where('id', $request->order_id)
                ->get(['mess_menu_item_prices.price', 'mess_menu_item_prices.item_id']);

            $order = ExtraOrders::create([
                'mess_id' => Auth::user()->mess_id,
                'officer_id' => $request->service_number,
                'item_id' => $item[0]->item_id,
                'meal_time' => $request->time,
                'qty' => $request->qty,
                'price' => $item[0]->price,
                'ordered_date' => $request->order_date,
                'notification' => 0,
                'note' => $request->remarks,
                'ip' => request()->ip(),
                'status' => 1,
                'created_by' => Auth::user()->id,
            ]);

            return json_encode(true);
        }


        if ($request->order_type == "extra") {

            $item = ItemPrices::where('id', $request->order_id)
                ->get(['mess_menu_item_prices.price', 'mess_menu_item_prices.item_id']);

            $order = ExtraOrders::create([
                'mess_id' => Auth::user()->mess_id,
                'officer_id' => $request->service_number,
                'item_id' => $item[0]->item_id,
                'meal_time' => $request->time,
                'qty' => $request->qty,
                'price' => $item[0]->price,
                'ordered_date' => $request->order_date,
                'notification' => 0,
                'note' => $request->remarks,
                'ip' => request()->ip(),
                'status' => 1,
                'created_by' => Auth::user()->id,

            ]);

            return json_encode(true);
        }

        if ($request->order_type == "tea") {

            $item = ItemPrices::where('id', $request->order_id)
                ->get(['mess_menu_item_prices.price', 'mess_menu_item_prices.item_id']);

            $order = ExtraOrders::create([
                'mess_id' => Auth::user()->mess_id,
                'officer_id' => $request->service_number,
                'item_id' => $item[0]->item_id,
                'meal_time' => $request->time,
                'qty' => $request->qty,
                'price' => $item[0]->price,
                'ordered_date' => $request->order_date,
                'notification' => 0,
                'note' => $request->remarks,
                'ip' => request()->ip(),
                'status' => 1,
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
                $other_status = 1;
            }

            $existOrdersForToday = MessOrders::where('officer_id', $request->service_number)
                ->where('rtaion_date', $orderType[0]->ration_date)
                ->where('mess_id', Auth::user()->mess_id)
                ->get('id');


            if (isset($existOrdersForToday[0]->id)) {


                if ($orderType[0]->meal_time == 'breakfast') {
                    MessOrders::where('id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_breakfast' => $breakfast,
                            'order_breakfast_status' => $breakfast_status,
                        ]);

                    Notifications::where('mess_order_id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_breakfast' => 0,
                        ]);

                }
                if ($orderType[0]->meal_time == 'lunch') {

                    MessOrders::where('id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_lunch' => $lunch,
                            'order_lunch_status' => $lunch_status,
                        ]);

                    Notifications::where('mess_order_id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_lunch' => 0,
                        ]);
                }
                if ($orderType[0]->meal_time == 'dinner') {

                    MessOrders::where('id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_dinner' => $dinner,
                            'order_dinner_status' => $dinner_status,
                        ]);

                    Notifications::where('mess_order_id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_dinner' => 0,
                        ]);

                }
                if ($orderType[0]->meal_time == 'event') {

                    MessOrders::where('id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_event' => $event,
                            'order_event_status' => $event_status,
                        ]);

                    Notifications::where('mess_order_id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_event' => 0,
                        ]);

                }
                if ($orderType[0]->meal_time == 'other') {

                    MessOrders::where('id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_other' => $other,
                            'order_other_status' => $other_status,
                        ]);

                    Notifications::where('mess_order_id', $existOrdersForToday[0]->id)
                        ->update([
                            'order_other' => 0,
                        ]);


                }
                return json_encode(true);
            } else {
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


                if ($breakfast >= 1) {
                    Notifications::create([
                        'mess_order_id' => $order->id,
                        'order_breakfast' => 0
                    ]);
                }
                if ($lunch >= 1) {
                    Notifications::create([
                        'mess_order_id' => $order->id,
                        'order_lunch' => 0
                    ]);
                }
                if ($dinner >= 1) {
                    Notifications::create([
                        'mess_order_id' => $order->id,
                        'order_dinner' => 0
                    ]);
                }
                if ($event >= 1) {
                    Notifications::create([
                        'mess_order_id' => $order->id,
                        'order_event' => 0
                    ]);
                }
                if ($other >= 1) {
                    Notifications::create([
                        'mess_order_id' => $order->id,
                        'order_other' => 0
                    ]);
                }


                return json_encode(true);
            }


        }

    }

    public function rationSearch(Request $request)
    {


        $rations = MessDailyRations::join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_daily_rations.mess_menu_id')
            ->join('mess_menus', 'mess_menus.mess_menu_id', '=', 'mess_menu_details.id')
            ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
            ->where('mess_daily_rations.ration_date', $request->date)
            ->groupBy('mess_daily_rations.mess_menu_id', 'mess_daily_rations.dessert_item_id', 'mess_daily_rations.tentative_price', 'mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id', 'mess_menu_details.menu_name', 'mess_daily_rations.id')
            ->get(['mess_daily_rations.id', 'mess_daily_rations.mess_menu_id', 'mess_daily_rations.dessert_item_id', 'mess_daily_rations.tentative_price', 'mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id',
                'mess_menu_details.menu_name']);


        foreach ($rations as $ration) {

            $rationDate = MessDailyRations::where('id', $ration->id)
                ->get('ration_date');
            $ration->ration_date = $rationDate[0]->ration_date;

            $todaysDessert = MessMenuItem::where('id', $ration->dessert_item_id)
                ->get('item_name');
            $ration->dessert = isset($todaysDessert[0]->item_name) ? $todaysDessert[0]->item_name : 'No Dessert Added';

            $items = MessMenu::join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_menus.mess_menu_id')
                ->join('mess_menu_items', 'mess_menu_items.id', 'mess_menus.item_id')
                ->where('mess_menus.mess_menu_id', $ration->mess_menu_id)
                ->get(['mess_menu_items.item_name', 'mess_menu_details.meal_type',
                    'mess_menu_details.menu_name']);

            $ration->meal_type = $items[0]->meal_type;

            $dailyRation = array();
            foreach ($items as $item) {
                array_push($dailyRation, '<li>' . $item['item_name'] . '</li>');
            }

//            $strArry = json_encode($dailyRation);
//            $ration->items = str_replace(array('\\', '"', '[', ']', ','), '', $strArry);
            $ration->items = $dailyRation;

        }
        return $rations;

    }

    public function orderDetails(Request $request)
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->get();

        return view('admin.master-data.orders.view', compact('officers'));
    }

    public function officerRespectiveOrders(Request $request)
    {
        $date = isset($request->filter_dt) ? $request->filter_dt : Carbon::today()->toDateString();

        $orderArray['attributes'] = (object)array();

        $officersOrderPlaced = MessOrders::join('users', 'users.email', '=', 'mess_orders.officer_id')
            ->where('mess_orders.rtaion_date', $date)
            ->where('mess_orders.mess_id', Auth::user()->mess_id)
            ->get(['mess_orders.officer_id', 'users.name_according_to_part2', 'mess_orders.id']);

        foreach ($officersOrderPlaced as $officer) {
            $breakfastOrders = MessOrders::join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
                ->where('mess_daily_rations.meal_time', "breakfast")
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_orders.officer_id', $officer['officer_id'])
                ->where('mess_orders.order_breakfast_status', "1")
                ->where('mess_orders.order_breakfast', '>=', 1)
                ->where('mess_orders.rtaion_date', $date)
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_breakfast');

            $lunchOrders = MessOrders::join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
                ->where('mess_daily_rations.meal_time', "lunch")
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_orders.officer_id', $officer['officer_id'])
                ->where('mess_orders.order_lunch_status', "1")
                ->where('mess_orders.order_lunch', '>=', 1)
                ->where('mess_orders.rtaion_date', $date)
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_lunch');

            $dinnerOrders = MessOrders::join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
                ->where('mess_daily_rations.meal_time', "dinner")
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_orders.officer_id', $officer['officer_id'])
                ->where('mess_orders.order_dinner_status', "1")
                ->where('mess_orders.order_dinner', '>=', 1)
                ->where('mess_orders.rtaion_date', $date)
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_dinner');

            $eventOrders = MessOrders::join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
                ->where('mess_daily_rations.meal_time', "event")
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_orders.officer_id', $officer['officer_id'])
                ->where('mess_orders.order_event_status', "1")
                ->where('mess_orders.order_event', '>=', 1)
                ->where('mess_orders.rtaion_date', $date)
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_event');

            $otherOrders = MessOrders::join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
                ->where('mess_daily_rations.meal_time', "other")
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_orders.officer_id', $officer['officer_id'])
                ->where('mess_orders.order_other_status', "1")
                ->where('mess_orders.order_other', '>=', 1)
                ->where('mess_orders.rtaion_date', $date)
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_other');

            $officer['breakfastOrders'] = $breakfastOrders;
            $officer['lunchOrders'] = $lunchOrders;
            $officer['dinnerOrders'] = $dinnerOrders;
            $officer['eventOrders'] = $eventOrders;
            $officer['otherOrders'] = $otherOrders;
        }


        return DataTables::of($officersOrderPlaced)
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make(true);

    }


    public function officerRespectiveExtraOrders(Request $request)
    {
        $date = isset($request->filter_dt) ? $request->filter_dt : Carbon::today()->toDateString();

        $extraOrders = ExtraOrders::join('users', 'users.email', '=', 'extra_orders.officer_id')
            ->join('mess_menu_items', 'mess_menu_items.id', '=', 'extra_orders.item_id')
            ->where('extra_orders.ordered_date', $date)
            ->where('extra_orders.mess_id', Auth::user()->mess_id)
            ->where('extra_orders.status', '1')
            ->get(['users.name_according_to_part2', 'mess_menu_items.item_name',
                'extra_orders.id',
                'extra_orders.qty',
                'extra_orders.meal_time',
                'extra_orders.note',
                'mess_menu_items.category_id'
            ]);


        return DataTables::of($extraOrders)
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make(true);

    }

//    public function acceptRationOrder(Request $request)
//    {
//        $rtime = MessOrders::join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
//            ->where('mess_orders.id', $request->rowId)
//            ->get('mess_daily_rations.meal_time');
//
//        $rtimeBreakfast = 0;
//        $rtimeLunch = 0;
//        $rtimeDinner = 0;
//        $rtimeOther = 0;
//        $rtimeEvent = 0;
//
//
//        if ($rtime[0]->meal_time == 'breakfast') {
//            $rtimeBreakfast = 1;
//        }
//        if ($rtime[0]->meal_time == 'lunch') {
//            $rtimeLunch = 1;
//        }
//        if ($rtime[0]->meal_time == 'dinner') {
//            $rtimeDinner = 1;
//        }
//        if ($rtime[0]->meal_time == 'event') {
//            $rtimeEvent = 1;
//        }
//        if ($rtime[0]->meal_time == 'other') {
//            $rtimeOther = 1;
//        }
//
//
//        MessOrders::where('id', $request->rowId)
//            ->update([
//                'order_breakfast_status' => $rtimeBreakfast,
//                'order_lunch_status' => $rtimeLunch,
//                'order_dinner_status' => $rtimeDinner,
//                'order_event_status' => $rtimeEvent,
//                'order_other_status' => $rtimeOther,
//                'accepted_by' => Auth::user()->id,
//            ]);
//
//        return true;
//    }


    public function cancelRationOrder(Request $request)
    {
        if ($request->meal_time == 'breakfast') {

            MessOrders::where('rtaion_date', $request->rationDate)
                ->where('id', $request->rowId)
                ->update([
                    'order_breakfast' => 0,
                    'order_breakfast_status' => 0,
                ]);

            Notifications::where('mess_order_id',$request->rowId)
                ->update([
                    'order_breakfast'=>null
                ]);
        }
        if ($request->meal_time == 'lunch') {


            MessOrders::where('rtaion_date', $request->rationDate)
                ->where('id', $request->rowId)
                ->update([
                    'order_lunch' => 0,
                    'order_lunch_status' => 0,
                ]);

            Notifications::where('mess_order_id',$request->rowId)
                ->update([
                    'order_lunch'=>null
                ]);


        }
        if ($request->meal_time == 'dinner') {

            MessOrders::where('rtaion_date', $request->rationDate)
                ->where('id', $request->rowId)
                ->update([
                    'order_dinner' => 0,
                    'order_dinner_status' => 0,
                ]);

            Notifications::where('mess_order_id',$request->rowId)
                ->update([
                    'order_dinner'=>null
                ]);

        }
        if ($request->meal_time == 'event') {

            MessOrders::where('rtaion_date', $request->rationDate)
                ->where('id', $request->rowId)
                ->update([
                    'order_event' => 0,
                    'order_event_status' => 0,
                ]);

            Notifications::where('mess_order_id',$request->rowId)
                ->update([
                    'order_event'=>null
                ]);
        }
        if ($request->meal_time == 'other') {

            MessOrders::where('rtaion_date', $request->rationDate)
                ->where('id', $request->rowId)
                ->update([
                    'order_other' => 0,
                    'order_other_status' => 0,
                ]);

            Notifications::where('mess_order_id',$request->rowId)
                ->update([
                    'order_other'=>null
                ]);
        }
        if ($request->meal_time == 'extra') {

            ExtraOrders::where('ordered_date', $request->rationDate)
                ->where('id', $request->rowId)
                ->delete();
        }


        $ids = MessOrders::where('order_breakfast', 0)
            ->where('order_lunch', 0)
            ->where('order_dinner', 0)
            ->where('order_event', 0)
            ->where('order_other', 0)
            ->get('id');



        if (isset($ids))
        {
            foreach ($ids as $id)
            {

                MessOrders::where('id',$id->id)
                    ->delete();


                if ($request->meal_time == 'breakfast') {

                    Notifications::where('mess_order_id',$id->id)
                        ->update([
                            'order_breakfast'=>null
                        ]);
                }
                if ($request->meal_time == 'lunch') {

                    Notifications::where('mess_order_id',$id->id)
                        ->update([
                            'order_lunch'=>null
                        ]);

                }
                if ($request->meal_time == 'dinner') {

                    Notifications::where('mess_order_id',$id->id)
                        ->update([
                            'order_dinner'=>null
                        ]);
                }
                if ($request->meal_time == 'event') {

                    Notifications::where('mess_order_id',$id->id)
                        ->update([
                            'order_event'=>null
                        ]);
                }
                if ($request->meal_time == 'other') {

                    Notifications::where('mess_order_id',$id->id)
                        ->update([
                            'order_other'=>null
                        ]);
                }

            }
        }




        return true;
    }


    public function allBbreakfast(Request $request)
    {
        return view('admin.master-data.orders.all_breakfast_orders');
    }

    public function allLunch(Request $request)
    {
        return view('admin.master-data.orders.all_lunch_orders');
    }

    public function allDinner(Request $request)
    {
        return view('admin.master-data.orders.all_dinner_orders');
    }

    public function allEvent(Request $request)
    {
        EventOrders::where('notification', 0)
            ->update([
                'notification' => 1
            ]);
//        return view('admin.master-data.orders.all_event_orders');
        $eventOrders = EventOrders::join('ahq_establishments','ahq_establishments.id','=','event_orders.ahq_estb')
            ->get(['event_orders.id','ahq_establishments.ahq_establishment','event_orders.event_name','event_orders.event_date','event_orders.status']);

        return view('admin.master-data.establishment.view_event_orders',compact('eventOrders'));
    }

    public function allOther(Request $request)
    {
        return view('admin.master-data.orders.all_other_orders');
    }

    public function allTea(Request $request)
    {
        return view('admin.master-data.orders.all_tea_orders');
    }

    public function allExtra(Request $request)
    {
        return view('admin.master-data.orders.all_extra_orders');
    }

    public function allDessert(Request $request)
    {
        return view('admin.master-data.orders.all_dessert_orders');
    }

    public function getAllBreakfasts(Request $request)
    {

//        dd($request);


        if ($request->ajax()) {

            $data = MessOrders::join('users', 'users.email', '=', 'mess_orders.officer_id')
                ->join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
                ->join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_daily_rations.mess_menu_id')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', 'breakfast')
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->where('mess_orders.order_breakfast_status', 1)
                ->when((($request->fromDate != 0) && ($request->toDate != 0)), function ($query) use ($request) {
                    return $query->whereBetween('mess_orders.rtaion_date', [$request->fromDate, $request->toDate]);
                })
                ->get(['users.name', 'mess_orders.order_breakfast', 'mess_daily_rations.ration_date', 'mess_menu_details.menu_name']);


            return DataTables::of($data)
                ->setRowId('id')
                ->make(true);

        }
    }

    public function getAllLunch(Request $request)
    {
        if ($request->ajax()) {

            $data = MessOrders::join('users', 'users.email', '=', 'mess_orders.officer_id')
                ->join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
                ->join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_daily_rations.mess_menu_id')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', 'lunch')
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->when((($request->fromDate != 0) && ($request->toDate != 0)), function ($query) use ($request) {
                    return $query->whereBetween('mess_orders.rtaion_date', [$request->fromDate, $request->toDate]);
                })
                ->where('mess_orders.order_lunch_status', 1)
                ->get(['users.name', 'mess_orders.order_lunch', 'mess_daily_rations.ration_date', 'mess_menu_details.menu_name']);


            return DataTables::of($data)
                ->setRowId('id')
                ->make(true);

        }
    }

    public function getAllDinner(Request $request)
    {
        if ($request->ajax()) {

            $data = MessOrders::join('users', 'users.email', '=', 'mess_orders.officer_id')
                ->join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
                ->join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_daily_rations.mess_menu_id')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', 'dinner')
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->when((($request->fromDate != 0) && ($request->toDate != 0)), function ($query) use ($request) {
                    return $query->whereBetween('mess_orders.rtaion_date', [$request->fromDate, $request->toDate]);
                })
                ->where('mess_orders.order_dinner_status', 1)
                ->get(['users.name', 'mess_orders.order_dinner', 'mess_daily_rations.ration_date', 'mess_menu_details.menu_name']);

            return DataTables::of($data)
                ->setRowId('id')
                ->make(true);

        }
    }

    public function getAllEvent(Request $request)
    {
        if ($request->ajax()) {

            $data = MessOrders::join('users', 'users.email', '=', 'mess_orders.officer_id')
                ->join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
                ->join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_daily_rations.mess_menu_id')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', 'event')
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->where('mess_orders.order_event_status', 1)
                ->get(['users.name', 'mess_orders.order_event', 'mess_daily_rations.ration_date', 'mess_menu_details.menu_name']);


            return DataTables::of($data)
                ->setRowId('id')
                ->make(true);

        }
    }

    public function getAllOtherOrder(Request $request)
    {
        if ($request->ajax()) {

            $data = MessOrders::join('users', 'users.email', '=', 'mess_orders.officer_id')
                ->join('mess_daily_rations', 'mess_daily_rations.ration_date', '=', 'mess_orders.rtaion_date')
                ->join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_daily_rations.mess_menu_id')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', 'other')
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->when((($request->fromDate != 0) && ($request->toDate != 0)), function ($query) use ($request) {
                    return $query->whereBetween('mess_orders.rtaion_date', [$request->fromDate, $request->toDate]);
                })
                ->where('mess_orders.order_other_status', 1)
                ->get(['users.name', 'mess_orders.order_other', 'mess_daily_rations.ration_date', 'mess_menu_details.menu_name']);


            return DataTables::of($data)
                ->setRowId('id')
                ->make(true);

        }
    }

    public function getAllTea(Request $request)
    {
        if ($request->ajax()) {

            $data = ExtraOrders::join('users', 'users.email', '=', 'extra_orders.officer_id')
                ->join('mess_menu_items', 'mess_menu_items.id', '=', 'extra_orders.item_id')
                ->join('mess_menu_item_categories', 'mess_menu_item_categories.id', '=', 'mess_menu_items.category_id')
                ->where('mess_menu_item_categories.id', 4)
                ->when((($request->fromDate != 0) && ($request->toDate != 0)), function ($query) use ($request) {
                    return $query->whereBetween('extra_orders.ordered_date', [$request->fromDate, $request->toDate]);
                })
                ->get(['mess_menu_items.item_name', 'extra_orders.meal_time', 'extra_orders.qty', 'extra_orders.ordered_date', 'extra_orders.note',
                    'users.name_according_to_part2']);


            return DataTables::of($data)
                ->setRowId('id')
                ->make(true);

        }
    }

    public function getAllExtra(Request $request)
    {
        if ($request->ajax()) {

            $data = ExtraOrders::join('users', 'users.email', '=', 'extra_orders.officer_id')
                ->join('mess_menu_items', 'mess_menu_items.id', '=', 'extra_orders.item_id')
                ->join('mess_menu_item_categories', 'mess_menu_item_categories.id', '=', 'mess_menu_items.category_id')
                ->where('mess_menu_item_categories.id', 3)
                ->when((($request->fromDate != 0) && ($request->toDate != 0)), function ($query) use ($request) {
                    return $query->whereBetween('extra_orders.ordered_date', [$request->fromDate, $request->toDate]);
                })
                ->get(['mess_menu_items.item_name', 'extra_orders.meal_time', 'extra_orders.qty', 'extra_orders.ordered_date', 'extra_orders.note',
                    'users.name_according_to_part2']);


            return DataTables::of($data)
                ->setRowId('id')
                ->make(true);

        }
    }

    public function getAllDessert(Request $request)
    {
        if ($request->ajax()) {

            $data = ExtraOrders::join('users', 'users.email', '=', 'extra_orders.officer_id')
                ->join('mess_menu_items', 'mess_menu_items.id', '=', 'extra_orders.item_id')
                ->join('mess_menu_item_categories', 'mess_menu_item_categories.id', '=', 'mess_menu_items.category_id')
                ->where('mess_menu_item_categories.id', 2)
                ->when((($request->fromDate != 0) && ($request->toDate != 0)), function ($query) use ($request) {
                    return $query->whereBetween('extra_orders.ordered_date', [$request->fromDate, $request->toDate]);
                })
                ->get(['mess_menu_items.item_name', 'extra_orders.meal_time', 'extra_orders.qty', 'extra_orders.ordered_date', 'extra_orders.note',
                    'users.name_according_to_part2']);


            return DataTables::of($data)
                ->setRowId('id')
                ->make(true);

        }
    }

    public function getTotalRationForTheDay(Request $request)
    {

        $rataionArray = [];

        $breakfastOrders = MessOrders::where('order_breakfast_status', "1")
            ->where('order_breakfast', '>=', 1)
            ->where('rtaion_date', $request->date)
            ->where('mess_id', Auth::user()->mess_id)
            ->sum('order_breakfast');

        $lunchOrders = MessOrders::where('order_lunch_status', "1")
            ->where('order_lunch', '>=', 1)
            ->where('rtaion_date', $request->date)
            ->where('mess_id', Auth::user()->mess_id)
            ->sum('order_lunch');

        $dinnerOrders = MessOrders::where('order_dinner_status', "1")
            ->where('order_dinner', '>=', 1)
            ->where('rtaion_date', $request->date)
            ->where('mess_id', Auth::user()->mess_id)
            ->get()
            ->sum('order_dinner');

        $eventOrders = MessOrders::where('order_event_status', "1")
            ->where('order_event', '>=', 1)
            ->where('rtaion_date', $request->date)
            ->where('mess_id', Auth::user()->mess_id)
            ->sum('order_event');

        $otherOrders = MessOrders::where('order_other_status', "1")
            ->where('order_other', '>=', 1)
            ->where('rtaion_date', $request->date)
            ->where('mess_id', Auth::user()->mess_id)
            ->sum('order_other');

        $rataionArray['order_breakfast'] = $breakfastOrders;
        $rataionArray['order_lunch'] = $lunchOrders;
        $rataionArray['order_dinner'] = $dinnerOrders;
        $rataionArray['order_event'] = $eventOrders;
        $rataionArray['order_other'] = $otherOrders;

        return $rataionArray;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessOrders $orders
     * @return \Illuminate\Http\Response
     */
    public function show(MessOrders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessOrders $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(MessOrders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\MessOrders $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessOrders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessOrders $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessOrders $orders)
    {
        //
    }



    //////// BILLING ////////

    public function billingMess(){
        return view('admin.master-data.billing.billing_mess');
    }
    public function billingEvent(){

        $mess_id = Auth::user()->mess_id;
        
        $officers = User::select('*')
        ->join('officers_assigns','users.email','=','officers_assigns.enum')
        ->where('officers_assigns.status','=','1')
        ->where('officers_assigns.mess_id','=', $mess_id)
        ->get();

        return view('admin.master-data.billing.billing_event' , compact('officers'));
    }

    public function billingGeneral(){

        $mess_id = Auth::user()->mess_id;

        $officers = User::select('*')
        ->join('officers_assigns','users.email','=','officers_assigns.enum')
        ->where('officers_assigns.status','=','1')
        ->where('officers_assigns.mess_id','=', $mess_id)
        ->get();
        return view('admin.master-data.billing.billing_general' , compact('officers'));
    }
    
    //// MESSING ////
    public function billingMessing(Request $req){

        $mess_id = Auth::user()->mess_id;

        $billing = DB::table('mess_daily_rations')
            ->select('mess_daily_rations.id', 'mess_menu_details.menu_name', 'mess_daily_rations.meal_time', 'mess_menu_details.meal_type', 'mess_daily_rations.tentative_price', 'mess_daily_rations.price_final')
            ->join('mess_menu_details', 'mess_daily_rations.mess_menu_id', '=', 'mess_menu_details.id')
            ->where('mess_daily_rations.ration_date', '=', $req->date)
            ->where('mess_daily_rations.mess_id', '=', $mess_id)
            ->get();

        // dd($billing);

        $html = '';

        foreach ($billing as $data) {

            $price_final = $data->price_final;
            if ($price_final == "" || $price_final == null) {
                $price_final = "-";
            }

            $meal_type = $data->meal_type;
            if ($meal_type == "1") {
                $meal_type = "Non-Veg";
            } else {
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

    public function billingMessingUpdate(Request $req)
    {

        $order_id = $req->order_id;
        $updated_price = $req->updated_price;
        DB::table('mess_daily_rations')->where('id', $order_id)->update(['price_final' => $updated_price]);
    }
    //// MESSING ////


    //// EXTRA MESSING ////
    public function billingExtraMessing(Request $req)
    {

        $mess_id = Auth::user()->mess_id;

        $billing = DB::table('extra_orders')
            ->select('extra_orders.id', 'extra_orders.officer_id', 'extra_orders.price', 'extra_orders.price_final', 'mess_menu_items.item_name')
            ->join('mess_menu_items', 'extra_orders.item_id', '=', 'mess_menu_items.id')
            ->where('extra_orders.ordered_date', '=', $req->date)
            ->where('extra_orders.mess_id', '=', $mess_id)
            ->whereIn('mess_menu_items.category_id', [2, 3])
            ->get();


        $html = '';

        foreach ($billing as $data) {

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

    public function billingExtraMessingUpdate(Request $req)
    {
        $order_id = $req->order_id;
        $updated_price = $req->updated_price;
        DB::table('extra_orders')->where('id', $order_id)->update(['price_final' => $updated_price]);
    }
    //// EXTRA MESSING ////


    //// TEA ////
    public function billingTea(Request $req)
    {

        $mess_id = Auth::user()->mess_id;

        $billing = DB::table('extra_orders')
            ->select('extra_orders.id', 'extra_orders.officer_id', 'extra_orders.price', 'extra_orders.price_final', 'mess_menu_items.item_name')
            ->join('mess_menu_items', 'extra_orders.item_id', '=', 'mess_menu_items.id')
            ->where('extra_orders.ordered_date', '=', $req->date)
            ->where('extra_orders.mess_id', '=', $mess_id)
            ->where('mess_menu_items.category_id', '=', '4')
            ->get();

        $html = '';

        foreach ($billing as $data) {

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

    public function billingTeaUpdate(Request $req)
    {
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



    public function billingEventSave(Request $req){

        $mess_id = Auth::user()->mess_id;
        $user = $req->user;

        foreach($user as $key => $no){
            
            DB::table('event_orders_mess')->insertGetID([
                'date' => $req->order_date,
                'event_name' => $req->event_name,
                'details' => $req->details,
                'officer_id' => $no,
                'value' => $req->billing_value,
                'mess_id' => $mess_id,
            ]);
        
        }  
    }


    public function generalSave(Request $req){

        $mess_id = Auth::user()->mess_id;
        $user = $req->user;

        $except_list = [];

        if ($req->user2 == null) {
            $except_list = [];
        }
        else{
            $except_list = $req->user2;
        }

        $all_users = User::select('*')
        ->join('officers_assigns','users.email','=','officers_assigns.enum')
        ->where('officers_assigns.status','=','1')
        ->where('officers_assigns.mess_id','=', $mess_id)
        ->whereNotIn('officers_assigns.enum', $except_list )
        ->get(); 

        if ($user[0] == 1) { // All the members
            foreach($all_users as $key => $no){

                DB::table('general_deduction')->insertGetID([
                    'date' => $req->order_date,
                    'name' => $req->deducation_name,
                    'value' => $req->deducation_value,
                    'officer_id' => $no->email,
                    'mess_id' => $mess_id,
                ]);
            }
        }

        else{  // Selected members
            foreach($user as $key => $no){

                DB::table('general_deduction')->insertGetID([
                    'date' => $req->order_date,
                    'name' => $req->deducation_name,
                    'value' => $req->deducation_value,
                    'officer_id' => $no,
                    'mess_id' => $mess_id,
                ]);
            }  
        }

    }


    public function remainingPayment(Request $req){

        $mess_id = Auth::user()->mess_id;

        $mess_bill_payment_details =  DB::table('mess_bill_payment_details')
        ->select('total_balance')
        ->where('enum','=', $req->enumber)
        ->where('mess_id','=', $mess_id)
        ->get();

        if ($mess_bill_payment_details->count() === 0) {
            echo 'nodata';
        } else {
            foreach ($mess_bill_payment_details as $data) {
                echo $data->total_balance;
            }
        }

    }
        


    public function billPayment(Request $req){
        
        $mess_id = Auth::user()->mess_id;

        // Save Single Pyament Details
        $mess_bill_payment = DB::table('mess_bill_payment')->insert([
            'mess_id' => $mess_id,
            'enum' => $req->enumber,
            'amount' => $req->amount,
            'payment_date' => $req->date1,
            'note' => $req->note,
        ]);
        if ($mess_bill_payment == true) {
            echo 'success';
        }
        else{
            echo 'fail';
        }
        // Save Single Pyament Details



        
        // Save All Pyament Details
        $total_bill = 0;
        $enum = $req->enumber;

        //////////////////////  MESSING
        $messing = DB::table('mess_orders')
            ->select('mess_orders.order_breakfast', 'mess_orders.order_lunch', 'mess_orders.order_dinner', 'mess_orders.rtaion_date', 'mess_daily_rations.tentative_price', 'mess_daily_rations.price_final', 'mess_daily_rations.meal_time' , 'mess_orders.officer_id')
            ->join('mess_daily_rations', 'mess_orders.rtaion_date', '=', 'mess_daily_rations.ration_date')
            ->where('mess_orders.mess_id', '=', $mess_id)
            ->where('mess_daily_rations.mess_id','=', $mess_id)
            ->where('mess_orders.officer_id', '=', $enum)
            // ->whereBetween('mess_orders.rtaion_date', [$date1, $date2])
            ->get();

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

        ////////////////////// EXTRA MESSING

        $extra_messing = DB::table('extra_orders')
            ->select('extra_orders.meal_time', 'extra_orders.price', 'extra_orders.price_final', 'extra_orders.qty', 'extra_orders.ordered_date', 'mess_menu_items.item_name')
            ->join('mess_menu_items', 'extra_orders.item_id', '=', 'mess_menu_items.id')
            ->whereIn('mess_menu_items.category_id', ['2', '3'])
            ->whereNotIn('meal_time', ['0'])
            ->where('extra_orders.mess_id','=', $mess_id)
            ->where('mess_menu_items.mess_id','=', $mess_id)
            ->where('extra_orders.officer_id', '=', $enum)
            // ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
            ->get();

        $extra_messing_total = 0;

        foreach ($extra_messing as $data) {

            if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                $extra_messing_total = $extra_messing_total + ($data->qty * $data->price);
            } else { // alredy updated price
                $extra_messing_total = $extra_messing_total + ($data->qty * $data->price_final);
            }
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
            // ->whereBetween('extra_orders.ordered_date', [$date1, $date2])
            ->get();

        $tea_total = 0;

        foreach ($tea as $data) {

            if ($data->price_final == null || $data->price_final == "0") { // Not updated price yet
                $tea_total = $tea_total + ($data->qty * $data->price);
            } else { // alredy updated price
                $tea_total = $tea_total + ($data->qty * $data->price_final);
            }

        }

        // ////////////////////// BAR

        $summery_bar = DB::table('bars')
        ->select('bars.order_dt', 'items.name', 'bars.qty', 'bars.price',  'bars.measure')
        ->join('items','bars.item','=','items.id')
        // ->whereBetween('bars.order_dt', [$date1, $date2])
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

        // ////////////////////// EVENT

        $summery_event =  DB::table('event_orders_mess')
        ->select('*')
        // ->whereBetween('date', [$date1, $date2])
        ->where('officer_id','=', $enum)
        ->where('mess_id','=', $mess_id)
        ->get();

        $event_total = 0;

        foreach($summery_event as $data){
            $event_total = $event_total + ($data->value);
        }

        ////////////////////// GENERAL DEDUCTION

        $general =  DB::table('general_deduction')
        ->select('*')
        // ->whereBetween('date', [$date1, $date2])
        ->where('officer_id','=', $enum)
        ->where('mess_id','=', $mess_id)
        ->get();

        $general_total = 0;

        foreach($general as $data){
            $general_total = $general_total + ($data->value);
        }

        $total_bill = $messing_total + $extra_messing_total + $tea_total + $bar_total + $event_total + $general_total;


        //////////


        // Get Total Payments
        $bill_payments =  DB::table('mess_bill_payment')
        ->select('*')
        // ->whereBetween('date', [$date1, $date2])
        ->where('mess_id','=', $mess_id)
        ->where('enum','=', $enum)
        ->get();

        $bill_payments_total = 0;

        foreach($bill_payments as $data){
            $bill_payments_total = $bill_payments_total + ($data->amount);
        }
        
        $remaining_balance = $total_bill - $bill_payments_total;


        //////////


        // Save in DB
        $mess_bill_payment_details = DB::table('mess_bill_payment_details')->updateOrInsert(
            [ 'enum' => $req->enumber],
            [ 'mess_id' => $mess_id,
            'enum' => $req->enumber,
            'total_bill' => $total_bill,
            'total_payment' => $bill_payments_total,
            'total_balance' => $remaining_balance, ]);
        // Save All Pyament Details


    }



}