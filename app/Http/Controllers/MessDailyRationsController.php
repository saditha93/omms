<?php

namespace App\Http\Controllers;

use App\DataTables\DessertDataTable;
use App\DataTables\ExtraMessingDataTable;
use App\DataTables\MessDailyRationDataTable;
use App\DataTables\TeaItemPriceDataTable;
use App\Http\Requests\StoreDailyRationRequest;
use App\Http\Requests\StoreExtraMessingPriceRequest;
use App\Http\Requests\StoreMessItemPriceRequest;
use App\Http\Requests\UpdateExtraMessingPriceRequest;
use App\Http\Requests\UpdateMessItemPriceRequest;
use App\Models\ItemPrices;
use App\Models\MealOrderTime;
use App\Models\MessDailyRations;
use App\Models\MessMenu;
use App\Models\MessMenuDetails;
use App\Models\MessMenuItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MessDailyRationsController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:manage-pricing', ['only' => ['index','extraMessing','teaItems']]);
//    }

    public function dailyRationDatatable(Request $request)
    {
        if ($request->ajax()) {

            $data = MessDailyRations::join('mess_menu_details','mess_menu_details.id','=','mess_daily_rations.mess_menu_id')
            ->leftJoin('mess_menus','mess_menus.id','=','mess_menu_details.id')
            ->where('mess_daily_rations.mess_id',Auth::user()->mess_id)
            ->when((($request->fromDate != 0) && ($request->toDate != 0)), function ($query) use ($request) {
                return $query->whereBetween('mess_daily_rations.ration_date', [$request->fromDate, $request->toDate]);
            })
                ->groupBy( 'mess_daily_rations.id',
                    'mess_menu_details.menu_name',
                    'mess_menu_details.meal_type',
                    'mess_daily_rations.meal_time',
                    'mess_daily_rations.ration_date',
                    'mess_daily_rations.tentative_price')
                ->get([
                    'mess_daily_rations.id',
                    'mess_menu_details.menu_name',
                    'mess_menu_details.meal_type',
                    'mess_daily_rations.meal_time',
                    'mess_daily_rations.ration_date',
                    'mess_daily_rations.tentative_price',
                ]);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btnEdit = '<a class="btn btn-sm btn-warning" href="'.route('ration.edit',$row->id ).'">Edit</a>';
                    $btnDelete ='<form method="POST" action="' . route('ration.destroy', $row->id) . '" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
                             ' . csrf_field() . '
                             ' . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>';
                    return $btnEdit.' '.$btnDelete;
                })
                ->rawColumns(['action'])
                ->setRowId('id')
                ->make(true);

        }



    }

    public function index(Request $request)
    {
        $menus = MessMenuDetails::join('mess_menus','mess_menus.mess_menu_id','=','mess_menu_details.id')
            ->where('mess_menus.mess_id', Auth::user()->mess_id)
            ->where('mess_menu_details.status', 1)
            ->groupBy('mess_menu_details.menu_name', 'mess_menu_details.id')
            ->get(['mess_menu_details.menu_name', 'mess_menu_details.id']);

        $desserts = MessMenuItem::where('category_id', 2)
            ->where('mess_id', Auth::user()->mess_id)
            ->where('status',1)
            ->get(['id', 'item_name']);

        return view('admin.master-data.mess_menu.daily_ration.index', compact('menus', 'desserts'));
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
    public function store(StoreDailyRationRequest $request)
    {

//        dd($request->menu_type);
//        dd($request->date);


        $validatedData = $request->validated();

        $exist = MessDailyRations::where('ration_date',$validatedData['date'])
            ->where('mess_id', Auth::user()->mess_id)
            ->where('meal_time', $validatedData['menu_type'])
            ->get();
//        where('mess_menu_id',$validatedData['menu'])

        if (isset($exist[0]['id']))
        {
            return to_route('ration.index')->with('waring', 'Ration already added');
        }


        //time validation
        $times = MealOrderTime::where('mess_id', Auth::user()->mess_id)
            ->get();

        if (!isset($times[0])) {

            return to_route('ration.index')->with('waring', 'Please add the meal order time in settings menu');
        }

        $today = strtotime(date('Y-m-d', strtotime(Carbon::today()->toDateString()) ) );
        $mealDate = strtotime($validatedData['date']);


        //commented acording to SLLI requirement on 20 04 2023
//       if ($mealDate < $today) {
//
//           return to_route('ration.index')->with('waring', 'Ration add time exceeded');
//        }
//        if ($mealDate == $today)
//        {
//
//            $time = date('H');
//
//            if($validatedData['menu_type'] == 'breakfast')
//            {
//                if ( $times[0]['for_breakfast'] <= $time )
//                {
//                    return to_route('ration.index')->with('waring', 'Ration breakfast add time exceeded');
//
//                }
//
//
//            }
//
//
//            if($validatedData['menu_type'] == 'lunch')
//            {
//
//                if ( $times[0]['for_lunch'] <= $time )
//                {
//                    return to_route('ration.index')->with('waring', 'Ration lunch add time exceeded');
//                }
//
//
//            }
//
//            if($validatedData['menu_type'] == 'dinner')
//            {
//
//                if ( $times[0]['for_dinner'] <= $time )
//                {
//                    return to_route('ration.index')->with('waring', 'Ration dinner add time exceeded');
//                }
//
//            }
//
//        }
//END commented acording to SLLI requirement on 20 04 2023

        DB::beginTransaction();
        try {

            MessDailyRations::create([
                'mess_id' => Auth::user()->mess_id,
                'mess_menu_id' => $validatedData['menu'],
                'dessert_item_id' => $validatedData['desert'],
                'tentative_price' => $validatedData['price'],
                'ration_date' => $validatedData['date'],
                'meal_time' => $validatedData['menu_type'],
                'created_by' => Auth::user()->id,
                'version' => 1
            ]);

            DB::commit();
            return to_route('ration.index')->with('status', 'Ration Created');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessDailyRations $messDailyRations
     * @return \Illuminate\Http\Response
     */
    public function show(MessDailyRations $messDailyRations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessDailyRations $messDailyRations
     * @return \Illuminate\Http\Response
     */
    public function edit(MessDailyRations $ration)
    {

        $menus = MessMenuDetails::join('mess_menus','mess_menus.mess_menu_id','=','mess_menu_details.id')
            ->where('mess_menus.mess_id', Auth::user()->mess_id)
            ->where('mess_menu_details.status', 1)
            ->groupBy('mess_menu_details.menu_name', 'mess_menu_details.id')
            ->get(['mess_menu_details.menu_name', 'mess_menu_details.id']);
        $desserts = MessMenuItem::where('category_id', '2')
            ->where('mess_id', Auth::user()->mess_id)
            ->where('status',1)
            ->get(['id', 'item_name']);


        $rationOf = MessDailyRations::join('mess_menu_details','mess_menu_details.id','=','mess_daily_rations.mess_menu_id')
            ->join('mess_menus','mess_menus.mess_menu_id','=','mess_menu_details.id')
            ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
            ->where('mess_menus.mess_id', Auth::user()->mess_id)
            ->where('mess_menu_details.status', 1)
            ->where('mess_daily_rations.id', $ration->id)
            ->groupBy('mess_menu_details.meal_type','mess_daily_rations.id','mess_daily_rations.dessert_item_id','mess_daily_rations.meal_time',
                'mess_daily_rations.tentative_price','mess_daily_rations.mess_menu_id','mess_daily_rations.ration_date','mess_menu_details.remarks')
            ->get(['mess_menu_details.meal_type','mess_daily_rations.id','mess_daily_rations.dessert_item_id','mess_daily_rations.meal_time',
                'mess_daily_rations.tentative_price','mess_daily_rations.mess_menu_id','mess_daily_rations.ration_date','mess_menu_details.remarks']);


        $items = MessDailyRations::join('mess_menu_details','mess_menu_details.id','=','mess_daily_rations.mess_menu_id')
            ->join('mess_menus','mess_menus.mess_menu_id','=','mess_menu_details.id')
            ->join('mess_menu_items','mess_menu_items.id','=','mess_menus.item_id')
            ->where('mess_menus.mess_id', Auth::user()->mess_id)
            ->where('mess_menu_details.status', 1)
            ->where('mess_menu_details.id', $ration->mess_menu_id)
            ->where('mess_daily_rations.id', $ration->id)
            ->get(['mess_menu_items.item_name']);

        $menuItems = array();
        foreach ($items as $item) {
            $itemElement = '<span class="badge badge-info">' . $item->item_name . '</span>&nbsp;';
            array_push($menuItems, $itemElement);
        }

        $htmlData = str_replace(',', '', implode(",", $menuItems));

        return view('admin.master-data.mess_menu.daily_ration.index', compact('rationOf', 'menus', 'htmlData', 'desserts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\MessDailyRations $messDailyRations
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDailyRationRequest $request, MessDailyRations $ration)
    {

        $validatedData = $request->validated();
        DB::beginTransaction();
        try {

            MessDailyRations::where('id', $ration->id)
                ->update([
                    'mess_id' => Auth::user()->mess_id,
                    'mess_menu_id' => $validatedData['menu'],
                    'dessert_item_id' => $validatedData['desert'],
                    'tentative_price' => $validatedData['price'],
                    'meal_time' => $validatedData['menu_type'],
                    'ration_date' => $validatedData['date'],
                    'updated_by' => Auth::user()->id
                ]);

            MessDailyRations::where('id', $ration->id)->increment('version', 1);

            DB::commit();
            return to_route('ration.index')->with('status', 'Ration updated');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessDailyRations $messDailyRations
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessDailyRations $ration)
    {
        MessDailyRations::find($ration->id)->delete();
        return to_route('ration.index')->with('status', 'Ration deleted');
    }

    public function menuItems(Request $request)
    {
        $menuItems = MessMenuDetails::join('mess_menus','mess_menus.mess_menu_id','=','mess_menu_details.id')
            ->join('mess_menu_items','mess_menu_items.id','=','mess_menus.item_id')
            ->where('mess_menus.mess_id', Auth::user()->mess_id)
            ->where('mess_menu_details.status', 1)
            ->where('mess_menu_details.id', $request->menuId)
            ->get(['mess_menu_details.menu_name','mess_menu_details.meal_type', 'mess_menu_details.id','mess_menu_items.item_name','mess_menu_details.remarks']);


        $data = array();
        foreach ($menuItems as $itemName) {

            $itemElement = '<span class="badge badge-info">' . $itemName->item_name . '</span>&nbsp;';
            array_push($data, $itemElement);
        }
        return [$data, $menuItems];
    }




//    public function rationCount()
//    {
//        $non_veg = MessDailyRations::join('mess_menus', 'mess_menus.id', '=', 'mess_daily_rations.mess_menu_id')
//            ->where('mess_daily_rations.date', Carbon::today()->toDateString())
//            ->where('mess_menus.meal_type', 1)
//            ->whereIn('mess_menus.menu_type', ['breakfast', 'lunch', 'dinner'])
//            ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
//            ->select('mess_daily_rations.meal_type')->count();
//
//        $veg = MessDailyRations::join('mess_menus', 'mess_menus.id', '=', 'mess_daily_rations.mess_menu_id')
//            ->where('mess_daily_rations.date', Carbon::today()->toDateString())
//            ->where('mess_menus.meal_type', 0)
//            ->whereIn('mess_menus.menu_type', ['breakfast', 'lunch', 'dinner'])
//            ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
//            ->select('mess_daily_rations.meal_type')->count();
//
//        $event = MessDailyRations::join('mess_menus', 'mess_menus.id', '=', 'mess_daily_rations.mess_menu_id')
//            ->where('mess_daily_rations.date', Carbon::today()->toDateString())
//            ->where('mess_menus.menu_type', 'event')
//            ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
//            ->select('mess_daily_rations.meal_type')->count();
//
//        $other = MessDailyRations::join('mess_menus', 'mess_menus.id', '=', 'mess_daily_rations.mess_menu_id')
//            ->where('mess_daily_rations.date', Carbon::today()->toDateString())
//            ->where('mess_menus.menu_type', 'other')
//            ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
//            ->select('mess_daily_rations.meal_type')->count();
//
//        $arr = [];
//        $arr["nonVeg"] = $non_veg;
//        $arr["veg"] = $veg;
//        $arr["event"] = $event;
//        $arr["other"] = $other;
//
//        return $arr;
//    }


//  TEA ITEMS
    public function teaItems()
    {

        $teaItems = MessMenuItem::where('category_id', 4)
            ->where('mess_id', Auth::user()->mess_id)
            ->where('status', 1)
//            ->whereNotIn('id', DB::table('mess_menu_item_prices')->pluck('item_id')->toArray())
            ->get(['id', 'item_name']);

        return view('admin.master-data.mess_menu.tea_item.index', compact('teaItems'));
    }

    public function teaItemsPriceSet(StoreMessItemPriceRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {

            ItemPrices::create([
                'mess_id' => Auth::user()->mess_id,
                'item_id' => $validatedData['item'],
                'scale' => $validatedData['scale'],
                'price' => $validatedData['price'],
                'date' => Carbon::today()->toDateString(),
                'status' => $validatedData['status'],
                'created_by' => Auth::user()->id,
                'version' => 1
            ]);

            DB::commit();
            return to_route('tea-items')->with('status', 'Tea item price added');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

    }

    public function teaItemEdit($id)
    {
        $teaItems = MessMenuItem::where('category_id', 4)
            ->where('mess_id', Auth::user()->mess_id)
            ->where('status', 1)
            ->get(['id', 'item_name']);


        $data = ItemPrices::join('mess_menu_items', 'mess_menu_items.id', 'mess_menu_item_prices.item_id')
            ->where('mess_menu_item_prices.id', $id)
            ->get(['mess_menu_item_prices.id', 'mess_menu_item_prices.item_id', 'mess_menu_item_prices.scale', 'mess_menu_item_prices.price', 'mess_menu_item_prices.status', 'mess_menu_items.item_name']);

        $item = $data[0];
        return view('admin.master-data.mess_menu.tea_item.index', compact('teaItems', 'item'));
    }

    public function teaItemUpdate(UpdateMessItemPriceRequest $request, $id)
    {


        $validatedData = $request->validated();
        DB::beginTransaction();
        try {

            ItemPrices::where('id', $id)
                ->update([
                    'scale' => $validatedData['scale'],
                    'price' => $validatedData['price'],
                    'status' => $validatedData['status'],
                    'updated_by' => Auth::user()->id
                ]);

            ItemPrices::where('id', $id)->increment('version', 1);

            DB::commit();
            return to_route('tea-items')->with('status', 'Item price details updated');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }


    //EXTRA MESSING

    public function extraMessing()
    {
        $extaMessingItems = MessMenuItem::where('category_id', 3)
            ->where('mess_id', Auth::user()->mess_id)
            ->where('status', 1)
//            ->whereNotIn('id', DB::table('mess_menu_item_prices')->pluck('item_id')->toArray())
            ->get(['id', 'item_name']);

        return view('admin.master-data.mess_menu.extra-messing.index', compact('extaMessingItems'));
    }

    public function extraMessingPriceSet(StoreExtraMessingPriceRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {

            ItemPrices::create([
                'mess_id' => Auth::user()->mess_id,
                'item_id' => $validatedData['item'],
                'scale' => $validatedData['scale'],
                'price' => $validatedData['price'],
                'date' => Carbon::today()->toDateString(),
                'status' => $validatedData['status'],
                'created_by' => Auth::user()->id,
                'version' => 1
            ]);

            DB::commit();
            return to_route('extra-messing')->with('status', 'Extra messing item price added');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function extraMessingEdit($id)
    {
        $extaMessingItems = MessMenuItem::where('category_id', 3)
            ->where('mess_id', Auth::user()->mess_id)
            ->where('status', 1)
            ->get(['id', 'item_name']);

        $data = ItemPrices::join('mess_menu_items', 'mess_menu_items.id', 'mess_menu_item_prices.item_id')
            ->where('mess_menu_item_prices.id', $id)
            ->get(['mess_menu_item_prices.id', 'mess_menu_item_prices.item_id', 'mess_menu_item_prices.scale', 'mess_menu_item_prices.price', 'mess_menu_item_prices.status', 'mess_menu_items.item_name']);

        $item = $data[0];

        return view('admin.master-data.mess_menu.extra-messing.index', compact('extaMessingItems', 'item'));
    }

    public function extraMessingUpdate(UpdateExtraMessingPriceRequest $request, $id)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try {

            ItemPrices::where('id', $id)
                ->update([
                    'scale' => $validatedData['scale'],
                    'price' => $validatedData['price'],
                    'status' => $validatedData['status'],
                    'updated_by' => Auth::user()->id
                ]);

            ItemPrices::where('id', $id)->increment('version', 1);

            DB::commit();
            return to_route('extra-messing')->with('status', 'Extra-messing details updated');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }


    //Dessert Items

    public function dessert()
    {
        $dessertItems = MessMenuItem::where('category_id', 2)
            ->where('mess_id', Auth::user()->mess_id)
            ->where('status', 1)
//            ->whereNotIn('id', DB::table('mess_menu_item_prices')->pluck('item_id')->toArray())
            ->get(['id', 'item_name']);

        return view('admin.master-data.mess_menu.dessert_item.index', compact('dessertItems'));
    }

    public function dessertItemsPriceSet(StoreMessItemPriceRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {

            ItemPrices::create([
                'mess_id' => Auth::user()->mess_id,
                'date' => Carbon::today()->toDateString(),
                'item_id' => $validatedData['item'],
                'scale' => $validatedData['scale'],
                'price' => $validatedData['price'],
                'status' => $validatedData['status'],
                'created_by' => Auth::user()->id,
                'version' => 1
            ]);

            DB::commit();
            return to_route('dessert')->with('status', 'Dessert item price added');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

    }

    public function dessertItemEdit($id)
    {
        $dessertItems = MessMenuItem::where('category_id', 2)
            ->where('mess_id', Auth::user()->mess_id)
            ->where('status', 1)
            ->get(['id', 'item_name']);

        $data = ItemPrices::join('mess_menu_items', 'mess_menu_items.id', 'mess_menu_item_prices.item_id')
            ->where('mess_menu_item_prices.id', $id)
            ->get(['mess_menu_item_prices.id', 'mess_menu_item_prices.item_id', 'mess_menu_item_prices.scale', 'mess_menu_item_prices.price', 'mess_menu_item_prices.status', 'mess_menu_items.item_name']);

        $item = $data[0];
        return view('admin.master-data.mess_menu.dessert_item.index', compact('dessertItems', 'item'));
    }

    public function dessertItemUpdate(UpdateMessItemPriceRequest $request, $id)
    {


        $validatedData = $request->validated();
        DB::beginTransaction();
        try {

            ItemPrices::where('id', $id)
                ->update([
                    'scale' => $validatedData['scale'],
                    'price' => $validatedData['price'],
                    'status' => $validatedData['status'],
                    'updated_by' => Auth::user()->id
                ]);

            ItemPrices::where('id', $id)->increment('version', 1);

            DB::commit();
            return to_route('dessert')->with('status', 'Dessert price details updated');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }


    public function getTeaItems(Request $request)
    {
        $data = ItemPrices::join('mess_menu_items','mess_menu_items.id','=','mess_menu_item_prices.item_id')
            ->where('mess_menu_item_prices.mess_id',Auth::user()->mess_id)
            ->where('mess_menu_items.category_id','4')
            ->get(['mess_menu_item_prices.id','mess_menu_item_prices.date','mess_menu_item_prices.scale','mess_menu_item_prices.price','mess_menu_item_prices.status',
                'mess_menu_items.item_name']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btnEdit = '<a class="btn btn-sm btn-warning" href="'.route('tea-item-edit',$row->id ).'">Edit</a>';
                $btnDelete ='<form method="POST" action="" class="d-inline" >
                             ' . csrf_field() . '
                             ' . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm" disabled type="submit">Delete</button>
                        </form>';
                return $btnEdit.' '.$btnDelete;
            })
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make(true);
    }

    public function getExtraMessingItems(Request $request)
    {
        $data = ItemPrices::join('mess_menu_items','mess_menu_items.id','=','mess_menu_item_prices.item_id')
            ->where('mess_menu_item_prices.mess_id',Auth::user()->mess_id)
            ->where('mess_menu_items.category_id','3')
            ->get(['mess_menu_item_prices.id','mess_menu_item_prices.date','mess_menu_item_prices.scale','mess_menu_item_prices.price','mess_menu_item_prices.status',
                'mess_menu_items.item_name']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btnEdit = '<a class="btn btn-sm btn-warning" href="'.route('extra-messing-edit',$row->id ).'">Edit</a>';
                $btnDelete ='<form method="POST" action="" class="d-inline" >
                             ' . csrf_field() . '
                             ' . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm" disabled type="submit">Delete</button>
                        </form>';
                return $btnEdit.' '.$btnDelete;
            })
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make(true);
    }

    public function getDessertItems(Request $request)
    {
        $data = ItemPrices::join('mess_menu_items','mess_menu_items.id','=','mess_menu_item_prices.item_id')
            ->where('mess_menu_item_prices.mess_id',Auth::user()->mess_id)
            ->where('mess_menu_items.category_id','2')
            ->get(['mess_menu_item_prices.id','mess_menu_item_prices.date','mess_menu_item_prices.scale','mess_menu_item_prices.price','mess_menu_item_prices.status',
                'mess_menu_items.item_name']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btnEdit = '<a class="btn btn-sm btn-warning" href="'.route('dessert-item-edit',$row->id).'">Edit</a>';
                $btnDelete ='<form method="POST" action="" class="d-inline" >
                             ' . csrf_field() . '
                             ' . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm" disabled type="submit">Delete</button>
                        </form>';
                return $btnEdit.' '.$btnDelete;
            })
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make(true);
    }

}

