<?php

namespace App\Http\Controllers;

use App\Models\EventOrders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $officers = User::join('officers_assigns','officers_assigns.enum','=','users.email')
//            ->where('officers_assigns.status',1)
//            ->where('officers_assigns.mess_id',Auth::user()->mess_id)
//            ->get();
//
//       return view('admin.master-data.event_orders.index', compact('officers'));
    }



    public function saveEventOrderData(Request $request)
    {

        $this->validate($request, [
            'event' => 'required',
            'place' => 'required',
            'eventDate' => 'required',
            'order_details' => 'required',
            'contact_person' => 'required',
            'rank' => 'required',
            'appointment' => 'required',
            'contact_number' => 'required',
        ]);



        EventOrders::create([
            'ahq_estb' => Auth::user()->ahq_estb,
            'event_name' => $request['event'],
            'event_place' => $request['place'],
            'event_date' => $request['eventDate'],
            'event_order_details' => $request['order_details'],
            'contact_person' => $request['contact_person'],
            'contact_person_rank' => $request['rank'],
            'contact_person_appoinment' => $request['appointment'],
            'contact_person_contact_no' => $request['contact_number'],
            'status' => 0,
            'notification' => 0,
            'created_by' => Auth::user()->id,
        ]);


        $eventOrders = EventOrders::where('ahq_estb',Auth::user()->ahq_estb)
        ->get();

        return redirect()->route('event-order',compact('eventOrders'))->with('status','Event order saved');
    }


    public function viewRequestedEventOrders(Request $request)
    {

        $eventOrders = EventOrders::join('ahq_establishments','ahq_establishments.id','=','event_orders.ahq_estb')
            ->where('event_orders.id',$request->rowId)
            ->get(['event_orders.id','event_orders.event_name','event_orders.event_date','event_orders.event_place','event_orders.event_order_details','event_orders.contact_person','event_orders.contact_person_rank','event_orders.contact_person_appoinment',
                'event_orders.contact_person_contact_no','event_orders.special_remarks','event_orders.status',
                'ahq_establishments.ahq_establishment']);

        return $eventOrders;
    }

    public function updateEventOrderStatus(Request $request)
    {

        if($request->status == 'approve')
        {
            EventOrders::where('id',$request->eventId)
                ->update([
                    'special_remarks'=>$request->specialRem,
                    'status'=>1,
                    'notification' => 2,
                    'response_by'=>Auth::user()->id
                ]);
        }

        if($request->status == 'decline')
        {
            EventOrders::where('id',$request->eventId)
                ->update([
                    'special_remarks'=>$request->specialRem,
                    'status'=>2,
                    'notification' => 2,
                    'response_by'=>Auth::user()->id
                ]);
        }

        return true;
    }

    public function rspndEventNtfClear()
    {

        EventOrders::where('notification',2)
            ->update([
                'notification' => 3,
            ]);

        $eventOrders = EventOrders::where('ahq_estb',Auth::user()->ahq_estb)
            ->get();

        return view('admin.master-data.establishment.event_orders',compact('eventOrders'));
    }

    public function eventCount()
    {

        if (!Auth::user()->ahq_estb)
        {
            $pendingEventOrders = EventOrders::where('status',0)
                ->count('status');

            $ApprovedEventOrders = EventOrders::where('status',1)
                ->count('status');

            $declinedEventOrders = EventOrders::where('status',2)
                ->count('status');
        }
        else
        {
            $pendingEventOrders = EventOrders::where('ahq_estb',Auth::user()->ahq_estb)
                ->where('status',0)
                ->count('status');

            $ApprovedEventOrders = EventOrders::where('ahq_estb',Auth::user()->ahq_estb)
                ->where('status',1)
                ->count('status');

            $declinedEventOrders = EventOrders::where('ahq_estb',Auth::user()->ahq_estb)
                ->where('status',2)
                ->count('status');
        }


        return ([
            'pendingEventOrders' => $pendingEventOrders,
            'ApprovedEventOrders' => $ApprovedEventOrders,
            'declinedEventOrders' => $declinedEventOrders,
        ]);

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
     * @param  \App\Models\EventOrders  $eventOrders
     * @return \Illuminate\Http\Response
     */
    public function show(EventOrders $eventOrders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventOrders  $eventOrders
     * @return \Illuminate\Http\Response
     */
    public function edit(EventOrders $eventOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventOrders  $eventOrders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventOrders $eventOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventOrders  $eventOrders
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventOrders $eventOrders)
    {
        //
    }
}
