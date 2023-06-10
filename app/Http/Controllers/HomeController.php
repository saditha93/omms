<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Establishments;
use App\Models\EventOrders;
use App\Models\ExtraOrders;
use App\Models\LogRecord;
use App\Models\Mess;
use App\Models\MessOrders;
use App\Models\Notifications;
use App\Models\OfficersAssigns;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //getOrderNotifications
    public function getOrderNotifications()
    {

        $breakfastOrders = Notifications::join('mess_orders','mess_orders.id','=','notifications.mess_order_id')
            ->where('mess_orders.mess_id', Auth::user()->mess_id)
            ->where('notifications.order_breakfast',0)
            ->count('notifications.order_breakfast');

        $lunchOrders = Notifications::join('mess_orders','mess_orders.id','=','notifications.mess_order_id')
            ->where('mess_orders.mess_id', Auth::user()->mess_id)
            ->where('notifications.order_lunch',0)
            ->count('notifications.order_lunch');

        $dinnerOrders = Notifications::join('mess_orders','mess_orders.id','=','notifications.mess_order_id')
            ->where('mess_orders.mess_id', Auth::user()->mess_id)
            ->where('notifications.order_dinner',0)
            ->count('notifications.order_dinner');

//        $eventOrders = Notifications::join('mess_orders','mess_orders.id','=','notifications.mess_order_id')
//            ->where('mess_orders.mess_id', Auth::user()->mess_id)
//            ->where('notifications.order_event',0)
//            ->count('notifications.order_event');

        $eventOrders = EventOrders::where('notification',0)
            ->count('status');

        $eventOrderResponse = EventOrders::where('notification',2)
            ->where('ahq_estb', Auth::user()->ahq_estb)
            ->count('status');

        $otherOrders = Notifications::join('mess_orders','mess_orders.id','=','notifications.mess_order_id')
            ->where('mess_orders.mess_id', Auth::user()->mess_id)
            ->where('notifications.order_other',0)
            ->count('notifications.order_other');


        //extra order tbl
        $tea = ExtraOrders::join('mess_menu_items', 'mess_menu_items.id', 'extra_orders.item_id')
            ->where('mess_menu_items.category_id', 4)
            ->where('ordered_date', Carbon::today()->toDateString())
            ->where('extra_orders.mess_id', Auth::user()->mess_id)
            ->where('extra_orders.notification', 0)
            ->count();

        $dessert = ExtraOrders::join('mess_menu_items', 'mess_menu_items.id', 'extra_orders.item_id')
            ->where('mess_menu_items.category_id', 2)
            ->where('ordered_date', Carbon::today()->toDateString())
            ->where('extra_orders.mess_id', Auth::user()->mess_id)
            ->where('extra_orders.notification', 0)
            ->count();

        $extra = ExtraOrders::join('mess_menu_items', 'mess_menu_items.id', 'extra_orders.item_id')
            ->where('mess_menu_items.category_id', 3)
            ->where('ordered_date', Carbon::today()->toDateString())
            ->where('extra_orders.mess_id', Auth::user()->mess_id)
            ->where('extra_orders.notification', 0)
            ->count();

        return ([
            'breakfastOrders' => $breakfastOrders,
            'lunchOrders' => $lunchOrders,
            'dinnerOrders' => $dinnerOrders,
            'eventOrders' => $eventOrders,
            'otherOrders' => $otherOrders,
            'teaOrders' => $tea,
            'dessertOrders' => $dessert,
            'extraOrders' => $extra,
            'eventOrdersResponse' => $eventOrderResponse,
        ]);

    }

    public function establishmentCount()
    {
        $messes = Mess::count();
        $messManagers = Admin::where('user_type',2)
        ->count();
        $establishments = Establishments::count();

        return ['messes' => $messes, 'messManagers' => $messManagers, 'establishments' => $establishments];
    }

    public function rationDataCount()
    {
        $rataionArray = [];

        $breakfastOrders = MessOrders::where('order_breakfast_status', "1")
            ->where('order_breakfast', '>=', 1)
            ->where('rtaion_date', Carbon::today()->toDateString())
            ->where('mess_id', Auth::user()->mess_id)
            ->sum('order_breakfast');

        $lunchOrders = MessOrders::where('order_lunch_status', "1")
            ->where('order_lunch', '>=', 1)
            ->where('rtaion_date', Carbon::today()->toDateString())
            ->where('mess_id', Auth::user()->mess_id)
            ->sum('order_lunch');

        $dinnerOrders = MessOrders::where('order_dinner_status', "1")
            ->where('order_dinner', '>=', 1)
            ->where('rtaion_date', Carbon::today()->toDateString())
            ->where('mess_id', Auth::user()->mess_id)
            ->get()
            ->sum('order_dinner');

        $eventOrders = MessOrders::where('order_event_status', "1")
            ->where('order_event', '>=', 1)
            ->where('rtaion_date', Carbon::today()->toDateString())
            ->where('mess_id', Auth::user()->mess_id)
            ->sum('order_event');

        $otherOrders = MessOrders::where('order_other_status', "1")
            ->where('order_other', '>=', 1)
            ->where('rtaion_date', Carbon::today()->toDateString())
            ->where('mess_id', Auth::user()->mess_id)
            ->sum('order_other');

        $rataionArray['order_breakfast'] = $breakfastOrders;
        $rataionArray['order_lunch'] = $lunchOrders;
        $rataionArray['order_dinner'] = $dinnerOrders;
        $rataionArray['order_event'] = $eventOrders;
        $rataionArray['order_other'] = $otherOrders;

        return $rataionArray;
    }

    public function mealCount()
    {

        date_default_timezone_set('Asia/Kolkata');
        //$date = date('H:i:s');
        $date = date('H');

        $rataionArray = [];


        $officerCount = User::join('officers_assigns','officers_assigns.enum','=','users.email')
            ->where('officers_assigns.mess_id',Auth::user()->mess_id)
            ->count();

        //for lunch
        if($date > 7 && $date <= 13) {

            $lunchOrders = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', "lunch")
                ->where('mess_orders.order_lunch_status', "1")
                ->where('mess_orders.order_lunch', '>=', 1)
                ->where('mess_orders.rtaion_date', Carbon::today()->toDateString())
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_lunch');

            $dinnerOrders = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', "dinner")
                ->where('mess_orders.order_dinner_status', "1")
                ->where('mess_orders.order_dinner', '>=', 1)
                ->where('mess_orders.rtaion_date', Carbon::today()->toDateString())
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_dinner');

            $breakfastOrders = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', "breakfast")
                ->where('mess_orders.order_breakfast_status', "1")
                ->where('mess_orders.order_breakfast', '>=', 1)
                ->where('mess_orders.rtaion_date', Carbon::today()->addDay()->toDateString())
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_breakfast');

            $rataionArray['order_breakfast'] = $breakfastOrders;
            $rataionArray['order_lunch'] = $lunchOrders;
            $rataionArray['order_dinner'] = $dinnerOrders;
            $rataionArray['officer_count'] = $officerCount;

            return $rataionArray;

        }

        //for dinner
        if($date > 13 && $date <= 19) {

            $breakfastOrders = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', "breakfast")
                ->where('mess_orders.order_breakfast_status', "1")
                ->where('mess_orders.order_breakfast', '>=', 1)
                ->where('mess_orders.rtaion_date', Carbon::today()->addDay()->toDateString())
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_breakfast');

            $lunchOrders = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', "lunch")
                ->where('mess_orders.order_lunch_status', "1")
                ->where('mess_orders.order_lunch', '>=', 1)
                ->where('mess_orders.rtaion_date', Carbon::today()->addDay()->toDateString())
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_lunch');

            $dinnerOrders = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', "dinner")
                ->where('mess_orders.order_dinner_status', 1)
                ->where('mess_orders.order_dinner', '>=', 1)
                ->where('mess_orders.rtaion_date', Carbon::today()->toDateString())
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_dinner');

            $rataionArray['order_breakfast'] = $breakfastOrders;
            $rataionArray['order_lunch'] = $lunchOrders;
            $rataionArray['order_dinner'] = $dinnerOrders;
            $rataionArray['officer_count'] = $officerCount;


            return $rataionArray;
        }

        //for breakfast
        if(($date > 19 && $date <= 24) || ($date >= 1 && $date <= 7)) {

            $searchDt = '';
            if ($date > 19 && $date <= 24)
            {
                $searchDt = Carbon::today()->addDay()->toDateString();
            }
            if ($date >= 1 && $date <= 7)
            {
                $searchDt = Carbon::today()->toDateString();
            }

            $breakfastOrders = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', "breakfast")
                ->where('mess_orders.order_breakfast_status', "1")
                ->where('mess_orders.order_breakfast', '>=', 1)
                ->where('mess_orders.rtaion_date', $searchDt)
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_breakfast');


            $lunchOrders = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', "lunch")
                ->where('mess_orders.order_lunch_status', "1")
                ->where('mess_orders.order_lunch', '>=', 1)
                ->where('mess_orders.rtaion_date', $searchDt)
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_lunch');

            $dinnerOrders = MessOrders::join('mess_daily_rations','mess_daily_rations.ration_date','=','mess_orders.rtaion_date')
                ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
                ->where('mess_daily_rations.meal_time', "dinner")
                ->where('mess_orders.order_dinner_status', 1)
                ->where('mess_orders.order_dinner', '>=', 1)
                ->where('mess_orders.rtaion_date', $searchDt)
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->sum('mess_orders.order_dinner');


            $rataionArray['order_breakfast'] = $breakfastOrders;
            $rataionArray['order_lunch'] = $lunchOrders;
            $rataionArray['order_dinner'] = $dinnerOrders;
            $rataionArray['officer_count'] = $officerCount;

            return $rataionArray;
        }


    }


    public function moreInfoEstablishment()
    {
        $establishments = Establishments::get();

        return view('admin.master-data.establishment', compact('establishments'));
    }

    public function moreInfoMesses()
    {
        $messes = Mess::join('establishments','establishments.id','messes.estb')
        ->get(['establishments.establishment','messes.name','messes.location']);

        return view('admin.master-data.officer_messes', compact('messes'));
    }

    public function moreInfoMessManagers()
    {
        $admins = Admin::join('messes','messes.id','admins.mess_id')
            ->where('user_type',2)
            ->get(['messes.name as messName','admins.name','admins.email']);

        return view('admin.master-data.admin_users', compact('admins'));
    }

    public function messInfoOfficers()
    {

        $officers = User::join('officers_assigns','officers_assigns.enum','=','users.email')
            ->where('officers_assigns.mess_id',Auth::user()->mess_id)
            ->get(['users.name_according_to_part2','users.rank','users.email','users.service_no']);

        return view('admin.master-data.officers', compact('officers'));
    }


    public function lastLogin()
    {

        $userIds = LogRecord::where('log_records.admin_id','!=',1)
            ->groupBy('log_records.admin_id')
            ->get('log_records.admin_id');


        foreach ($userIds as $userId)
        {
            $id = LogRecord::latest()
                ->where('log_records.admin_id',$userId->admin_id)
                ->first();

            $data = LogRecord::join('admins','admins.id','=','log_records.admin_id')
                ->leftJoin('messes','messes.id','=','admins.mess_id')
                ->leftJoin('establishments','establishments.id','messes.estb')
                ->where('log_records.id',$id->id)
                ->get(['admins.name','messes.name as mess','establishments.establishment','log_records.created_at']);



            $userId['data'] = $data[0];
        }

        return view('admin.master-data.log.index', compact('userIds'));
    }

    public function officerStr()
    {

        $messes = Mess::get(['id','name']);

        foreach ($messes as $mess)
        {
            $str = OfficersAssigns::where('mess_id',$mess->id)
                ->count();

            $mess['str'] = $str;
        }

        return view('admin.master-data.log.strength', compact('messes'));
    }



    public function clearDashboardNotification(Request $request)
    {

        if($request->clearMenu == 'breakfast')
        {
            $breakfastIds = MessOrders::join('notifications','notifications.mess_order_id','=','mess_orders.id')
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->where('notifications.order_breakfast',0)
                ->get('mess_orders.id');


            foreach ($breakfastIds as $breakfastId)
            {
                Notifications::where('id',$breakfastId->id)
                    ->update([
                        'order_breakfast' => 1,
                    ]);
            }


        }
        if($request->clearMenu == 'lunch')
        {
            $lunchIds = MessOrders::join('notifications','notifications.mess_order_id','=','mess_orders.id')
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->where('notifications.order_lunch',0)
                ->get('mess_orders.id');

            foreach ($lunchIds as $lunchId)
            {

                Notifications::where('id',$lunchId->id)
                    ->update([
                        'order_lunch' => 1,
                    ]);
            }
        }
        if($request->clearMenu == 'dinner')
        {
            $dinnerIds = MessOrders::join('notifications','notifications.mess_order_id','=','mess_orders.id')
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->where('notifications.order_dinner',0)
                ->get('mess_orders.id');

            foreach ($dinnerIds as $dinnerId) {

                Notifications::where('id',$dinnerId->id)
                    ->update([
                        'order_dinner' => 1,
                    ]);
            }
        }
        if($request->clearMenu == 'event')
        {
            $eventIds = MessOrders::join('notifications','notifications.mess_order_id','=','mess_orders.id')
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->where('notifications.order_event',0)
                ->get('mess_orders.id');

            foreach ($eventIds as $eventId) {

                Notifications::where('id',$eventId->id)
                    ->update([
                        'order_event' => 1,
                    ]);
            }

        }
        if($request->clearMenu == 'other')
        {
            $otherIds = MessOrders::join('notifications','notifications.mess_order_id','=','mess_orders.id')
                ->where('mess_orders.mess_id', Auth::user()->mess_id)
                ->where('notifications.order_other',0)
                ->get('mess_orders.id');

            foreach ($otherIds as $otherId) {

                Notifications::where('id',$otherId->id)
                    ->update([
                        'order_other' => 1,
                    ]);
            }

        }



        if($request->clearMenu == 'tea')
        {
            $teaIds = ExtraOrders::join('mess_menu_items','mess_menu_items.id','=','extra_orders.item_id')
                ->where('mess_menu_items.category_id',4)
                ->where('extra_orders.notification',0)
                ->where('extra_orders.mess_id',Auth::user()->mess_id)
                ->get('extra_orders.id');

            foreach ($teaIds as $teaId)
            {
                ExtraOrders::where('id',$teaId->id)
                    ->where('notification', 0)
                    ->update([
                        'notification' => 1,
                    ]);
            }

        }

        if($request->clearMenu == 'extra')
        {
            $teaIds = ExtraOrders::join('mess_menu_items','mess_menu_items.id','=','extra_orders.item_id')
                ->where('mess_menu_items.category_id',3)
                ->where('extra_orders.notification',0)
                ->where('extra_orders.mess_id',Auth::user()->mess_id)
                ->get('extra_orders.id');

            foreach ($teaIds as $teaId)
            {
                ExtraOrders::where('id',$teaId->id)
                    ->where('notification', 0)
                    ->update([
                        'notification' => 1,
                    ]);
            }

        }

        if($request->clearMenu == 'dessert')
        {
            $dessertIds = ExtraOrders::join('mess_menu_items','mess_menu_items.id','=','extra_orders.item_id')
                ->where('mess_menu_items.category_id',2)
                ->where('extra_orders.notification',0)
                ->where('extra_orders.mess_id',Auth::user()->mess_id)
                ->get('extra_orders.id');

            foreach ($dessertIds as $dessertId)
            {
                ExtraOrders::where('id',$dessertId->id)
                    ->where('notification', 0)
                    ->update([
                        'notification' => 1,
                    ]);
            }

        }

    }
}
