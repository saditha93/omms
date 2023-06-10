<?php

namespace App\Http\Controllers;

use App\DataTables\MessMenuDataTable;
use App\Http\Requests\StoreMessMenuRequest;
use App\Models\ItemPrices;
use App\Models\MessDailyRations;
use App\Models\MessMenu;
use App\Models\MessMenuDetails;
use App\Models\MessMenuItem;
use App\Models\MessMenuItemCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\Fractal\Resource\Item;
use PhpParser\Node\Stmt\Foreach_;
use function Ramsey\Uuid\Lazy\toString;
use Yajra\DataTables\DataTables;

class MessMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MessMenuDataTable $dataTable)
    {
        $menuNumber = MessMenuDetails::count();

        $code = (sprintf('%03d', $menuNumber));
        $code++;
        $code = sprintf('%03d', $code);

        $items = MessMenuItem::join('mess_menu_item_categories', 'mess_menu_item_categories.id', '=', 'mess_menu_items.category_id')
            ->where('mess_menu_items.mess_id', Auth::user()->mess_id)
            ->where('mess_menu_item_categories.id', '1')
            ->where('mess_menu_items.status',1)
            ->get('mess_menu_items.*');

        return $dataTable->render('admin.master-data.mess_menu.menu.index', compact('items', 'code'));
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
    public function store(StoreMessMenuRequest $request)
    {



        $validatedData = $request->validated();
        $item = $validatedData['menu_items'];


        $uniqueName = MessMenu::join('mess_menu_details','mess_menu_details.id','=','mess_menus.mess_menu_id')
            ->where('mess_menu_details.menu_name',$validatedData['menu_name'])
            ->where('mess_menus.mess_id',Auth::user()->mess_id)
            ->get('mess_menu_details.id');

        if(isset($uniqueName[0]->id))
        {
            return redirect()->back()
                ->with('waring', 'Menu name exists. Use different menu name.');
        }

        $menuNumber = MessMenuDetails::count();
        $code = (sprintf('%03d', $menuNumber));
        $code++;
        $code = sprintf('%03d', $code);

        $menuCode = strtolower(str_replace(' ', '-', $validatedData['menu_name'] . '-' . $code));

        DB::beginTransaction();
        try {


            $mess = MessMenuDetails::create([
                'mess_menu_id' => $code,
                'menu_name' => $validatedData['menu_name'],
//                'menu_type' => $validatedData['menu_type'],
                'menu_code' => $menuCode,
                'remarks' => $request->remarks,
                'note' => 0,
                'meal_type' => $validatedData['meal_type'],
                'status' => $validatedData['status'],
                'created_by' => Auth::user()->id,
                'version' => 1
            ]);

            foreach ($validatedData['menu_items'] as $item) {
                MessMenu::create([
                    'mess_id' => Auth::user()->mess_id,
                    'mess_menu_id' => $mess['id'],
                    'item_id' => $item,
                    'created_by' => Auth::user()->id,
                    'version' => 1
                ]);
            }

            DB::commit();
            return to_route('menu.index')->with('status', 'Menu Created');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

    }


    public function viewDailyMenus()
    {

        $rations = MessDailyRations::join('mess_menu_details','mess_menu_details.id','=','mess_daily_rations.mess_menu_id')
            ->join('mess_menus','mess_menus.mess_menu_id','=','mess_menu_details.id')
            ->where('mess_menu_details.status',1)
            ->where('mess_daily_rations.mess_id',Auth::user()->mess_id)
            ->where('mess_daily_rations.ration_date',Carbon::today()->toDateString())
            ->groupBy('mess_daily_rations.mess_menu_id','mess_daily_rations.dessert_item_id','mess_daily_rations.tentative_price', 'mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id','mess_menu_details.menu_name','mess_daily_rations.id','mess_menu_details.meal_type')
            ->get(['mess_daily_rations.id','mess_daily_rations.mess_menu_id','mess_daily_rations.dessert_item_id','mess_daily_rations.tentative_price','mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id',
                'mess_menu_details.menu_name','mess_menu_details.meal_type']);


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
            ->where('mess_menu_item_prices.status',1)
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
            ->where('mess_menu_item_prices.status',1)
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
            ->where('mess_menu_item_prices.status',1)
            ->where('mess_menu_items.mess_id',Auth::user()->mess_id)
            ->groupBy('mess_menu_item_prices.item_id','mess_menu_items.item_name','mess_menu_item_prices.scale')
            ->get(['mess_menu_item_prices.item_id','mess_menu_items.item_name','mess_menu_item_prices.scale']);

        foreach ($desserts as $dessert)
        {
            $dessertsLatestPrice = ItemPrices::where('item_id',$dessert->item_id)->orderBy('id', 'DESC')->first();
            $dessert->price = $dessertsLatestPrice->price;
            $dessert->id = $dessertsLatestPrice->id;
        }

        $date = Carbon::today()->toDateString();

        $day = Carbon::today()->format('l');

        $today = $date.' - '.$day;


        return view('admin.master-data.mess_menu.daily_ration.view_daily_menu',compact('today','rations','teaitems','extraMessings','desserts'));
    }




    public function dailyMenuFilter(Request $request)
    {

        $rations = MessDailyRations::join('mess_menu_details','mess_menu_details.id','=','mess_daily_rations.mess_menu_id')
            ->join('mess_menus','mess_menus.mess_menu_id','=','mess_menu_details.id')
            ->where('mess_menu_details.status',1)
            ->where('mess_daily_rations.mess_id',Auth::user()->mess_id)
            ->where('mess_daily_rations.ration_date',$request->date)
            ->groupBy('mess_daily_rations.mess_menu_id','mess_daily_rations.dessert_item_id','mess_daily_rations.tentative_price', 'mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id','mess_menu_details.menu_name','mess_daily_rations.id','mess_menu_details.meal_type')
            ->get(['mess_daily_rations.id','mess_daily_rations.mess_menu_id','mess_daily_rations.dessert_item_id','mess_daily_rations.tentative_price','mess_daily_rations.meal_time',
                'mess_menus.mess_menu_id',
                'mess_menu_details.menu_name','mess_menu_details.meal_type']);

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
            ->where('mess_menu_item_prices.status',1)
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
            ->where('mess_menu_item_prices.status',1)
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
            ->where('mess_menu_item_prices.status',1)
            ->where('mess_menu_items.mess_id',Auth::user()->mess_id)
            ->groupBy('mess_menu_item_prices.item_id','mess_menu_items.item_name','mess_menu_item_prices.scale')
            ->get(['mess_menu_item_prices.item_id','mess_menu_items.item_name','mess_menu_item_prices.scale']);

        foreach ($desserts as $dessert)
        {
            $dessertsLatestPrice = ItemPrices::where('item_id',$dessert->item_id)->orderBy('id', 'DESC')->first();
            $dessert->price = $dessertsLatestPrice->price;
            $dessert->id = $dessertsLatestPrice->id;
        }

        $date = Carbon::today()->toDateString();
        $day = Carbon::today()->format('l');

        $today = $date.' - '.$day;

        $filteredDate = $request->date;

        return view('admin.master-data.mess_menu.daily_ration.view_daily_menu',compact('filteredDate','today','rations','teaitems','extraMessings','desserts'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessMenu $messMenu
     * @return \Illuminate\Http\Response
     */
    public function show(MessMenu $messMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessMenu $messMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(MessMenuDataTable $dataTable, MessMenuDetails $menu)
    {
        $items = MessMenuItem::join('mess_menu_item_categories', 'mess_menu_item_categories.id', '=', 'mess_menu_items.category_id')
            ->where('mess_menu_items.mess_id', Auth::user()->mess_id)
            ->where('mess_menu_items.status',1)
            ->where('mess_menu_item_categories.id', '1')
            ->get('mess_menu_items.*');


        $codeNumber = MessMenuDetails::where('id', $menu->id)
            ->get(['menu_code','meal_type','remarks','menu_name']);


        $array_of_piece = explode('-', $codeNumber[0]['menu_code']);
        $numberPies = (end($array_of_piece));

        $menuItems = MessMenu::where('mess_menu_id',$menu->id)
            ->where('mess_id',Auth::user()->mess_id)
            ->get('item_id');

        $idArray = array();
        foreach ($menuItems as $id) {
            array_push($idArray, $id->item_id);
        }

        $returnIdArray = $idArray;
        $menu->menu_code = ($codeNumber[0]->menu_code);
        $menu->meal_type = ($codeNumber[0]->meal_type);
        $menu->remarks = ($codeNumber[0]->remarks);
        $menu->menu_name = ($codeNumber[0]->menu_name);

        return $dataTable->render('admin.master-data.mess_menu.menu.index', compact('items', 'menu', 'numberPies', 'returnIdArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\MessMenu $messMenu
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMessMenuRequest $request, MessMenuDetails $menu)
    {
        $validatedData = $request->validated();
        $item = $validatedData['menu_items'];

        $codeNumber = MessMenuDetails::where('id', $menu->id)
            ->get('menu_code');

        $array_of_piece = explode('-', $codeNumber[0]['menu_code']);
        $numberPies = (end($array_of_piece));

        $menuCode = strtolower(str_replace(' ', '-', $validatedData['menu_name']) . '-' . $numberPies);

        DB::beginTransaction();
        try {

            $mess = MessMenuDetails::where('id', $menu->id)
                ->update([
                    'menu_name' => $validatedData['menu_name'],
//                    'menu_type' => $validatedData['menu_type'],
                    'meal_type' => $validatedData['meal_type'],
                    'menu_code' => $menuCode,
                    'remarks' => $request->remarks,
                    'status' => $validatedData['status'],
                    'updated_by' => Auth::user()->id,
                    'version' => 1
                ]);

            DB::table('mess_menus')->where('mess_menu_id', $menu->id)->delete();

            foreach ($validatedData['menu_items'] as $item) {

                MessMenu::create([
                    'mess_menu_id' => $menu->id,
                    'mess_id' => Auth::user()->mess_id,
                    'item_id' => $item,
                    'created_by' => Auth::user()->id,
                    'version' => 1
                ]);
            }

            MessMenu::where('mess_menu_id', $menu->id)->increment('version', 1);
            MessMenuDetails::where('id', $menu->id)->increment('version', 1);

            DB::commit();
            return to_route('menu.index')->with('status', 'Menu updated');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessMenu $messMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessMenuDetails $menu)
    {



        $exist = MessDailyRations::where('mess_menu_id',$menu->id)
            ->where('mess_id',Auth::user()->mess_id)
            ->count();
//        where('ration_date','>=',Carbon::today()->toDateString())

        if($exist >= 1)
        {
            return to_route('menu.index')->with('waring', 'Menu cannot delete. Menu exist in daily menus');
        }
        else
        {
            MessMenuDetails::where('id',$menu->id)->delete();
            MessMenu::where('mess_menu_id',$menu->id)->delete();
            return to_route('menu.index')->with('status', 'Menu deleted');
        }


    }


    public function getMenuItems(Request $request)
    {
        $data = MessMenuItem::join('mess_menu_item_categories','mess_menu_item_categories.id','=','mess_menu_items.category_id')
            ->where('mess_menu_items.mess_id',Auth::user()->mess_id)
            ->get(['mess_menu_items.id','mess_menu_items.item_name','mess_menu_items.status','mess_menu_items.item_code','mess_menu_item_categories.category_name']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btnEdit = '<a class="btn btn-sm btn-warning" href="'.route('item.edit',$row->id).'">Edit</a>';
                $btnDelete ='<form method="POST" action="'.route('item.destroy',$row->id).'" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
                             '.csrf_field().'
                             '.method_field('DELETE').'
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>';
                return $btnEdit.' '.$btnDelete;
            })
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make(true);
    }

    public function getMessMenus(Request $request)
    {
        $data = MessMenuDetails::join('mess_menus','mess_menus.mess_menu_id','=','mess_menu_details.id')
            ->where('mess_menus.mess_id',Auth::user()->mess_id)
            ->groupBy('mess_menu_details.id','mess_menu_details.menu_name','mess_menu_details.status','mess_menu_details.meal_type')
            ->get(['mess_menu_details.id','mess_menu_details.menu_name','mess_menu_details.status','mess_menu_details.meal_type']);


        foreach ($data as $td)
        {

            $items = DB::table('mess_menus')
                ->join('mess_menu_items','mess_menu_items.id','=','mess_menus.item_id')
                ->where('mess_menus.mess_menu_id', $td->id)
                ->where('mess_menus.mess_id', Auth::user()->mess_id)
                ->get('item_name');

            $menuItems = array();
            foreach ($items as $item)
            {
                $itemElement = '<span class="badge badge-info">'.$item->item_name.'</span>&nbsp;';
                array_push($menuItems,$itemElement);
            }


            $td->items = $menuItems;
        }

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
