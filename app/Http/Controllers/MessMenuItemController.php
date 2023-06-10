<?php

namespace App\Http\Controllers;

use App\DataTables\MessMenuItemDataTable;
use App\Http\Requests\StoreMessMenuItemRequest;
use App\Http\Requests\UpdateMessMenuItemRequest;
use App\Models\MessDailyRations;
use App\Models\MessMenuItem;
use App\Models\MessMenuItemCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Yajra\DataTables\Html\retrieve;

class MessMenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemCategories = MessMenuItemCategory::get();
        $itemNumber = MessMenuItem::count();
        $code = (sprintf('%03d', $itemNumber));
        $code++;
        $code = sprintf('%03d', $code);

        return view('admin.master-data.mess_menu.item.index',compact('itemCategories', 'code'));
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
    public function store(StoreMessMenuItemRequest $request)
    {


        $validatedData = $request->validated();

        $itemCategories = MessMenuItemCategory::get();
        $itemNumber = MessMenuItem::count();
        $code = (sprintf('%03d', $itemNumber));
        $code++;
        $code = sprintf('%03d', $code);

        $catName = MessMenuItemCategory::where('id',$validatedData['category_id'])
            ->get('category_name');

        $itemCode = strtolower($catName[0]['category_name'].'-'.str_replace(' ', '-', $validatedData['item_name']).'-'.$code);

        DB::beginTransaction();
        try{

            MessMenuItem::create([
                'category_id' => $validatedData['category_id'],
                'item_name' => $validatedData['item_name'],
                'item_code' => $itemCode,
                'mess_id' => Auth::user()->mess_id,
                'status' => $validatedData['status'],
                'created_by' => Auth::user()->id,
                'version' => 1
            ]);

            DB::commit();
            return to_route('item.index')->with('status','Item Created');
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessMenuItem  $messMenuItem
     * @return \Illuminate\Http\Response
     */
    public function show(MessMenuItem $messMenuItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessMenuItem  $messMenuItem
     * @return \Illuminate\Http\Response
     */
    public function edit(MessMenuItem $item)
    {
        $itemCategories = MessMenuItemCategory::all();
        $codeNumber = MessMenuItem::where('id',$item->id)
            ->get('item_code');

        $array_of_piece = explode('-', $codeNumber[0]['item_code']);
        $numberPiese = (end($array_of_piece));

        return view('admin.master-data.mess_menu.item.index',compact('item','itemCategories','numberPiese'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessMenuItem  $messMenuItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessMenuItemRequest $request, MessMenuItem $item)
    {
        $validatedData = $request->validated();

        $codeNumber = MessMenuItem::where('id',$item->id)
            ->get('item_code');
        $array_of_piece = explode('-', $codeNumber[0]['item_code']);
        $numberPiese = (end($array_of_piece));
        $catName = MessMenuItemCategory::where('id',$validatedData['category_id'])
            ->get('category_name');

        $itemCode = strtolower($catName[0]['category_name'].'-'.str_replace(' ', '-', $validatedData['item_name']).'-'.$numberPiese);

        DB::beginTransaction();
        try{

            MessMenuItem::where('id', $item->id)
                ->update([
                    'category_id' => $validatedData['category_id'],
                    'item_name' => $validatedData['item_name'],
                    'item_code' => $itemCode,
                    'status' => $validatedData['status'],
                    'updated_by' => Auth::user()->id
                ]);

            MessMenuItemCategory::where('id',$item->id)->increment('version', 1);

            DB::commit();
            return to_route('item.index')->with('status','Item updated');
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessMenuItem  $messMenuItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessMenuItem $item)
    {

        $exist = MessDailyRations::leftJoin('mess_menus','mess_menus.mess_menu_id','=','mess_daily_rations.mess_menu_id')
            ->where('mess_daily_rations.mess_id',Auth::user()->mess_id)
            ->where('mess_menus.mess_id',Auth::user()->mess_id)
            ->where('mess_menus.item_id',$item->id)
            ->count();

        if($exist >= 1)
        {
            return to_route('item.index')->with('waring', 'Menu item cannot delete. Menu item exist in daily menus');
        }
        else
        {
            MessMenuItem::find($item->id)->delete();
            return to_route('item.index')->with('status','Item deleted');
        }


    }

}
