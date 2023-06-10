<?php

namespace App\Http\Controllers;

use App\DataTables\MessMenuItemCategoryDataTable;
use App\Http\Requests\StoreMessMenuItemCategoryRequest;
use App\Models\MessMenuItem;
use App\Models\MessMenuItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessMenuItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MessMenuItemCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.master-data.mess_menu.category.index');
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
    public function store(StoreMessMenuItemCategoryRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try{

            MessMenuItemCategory::create([
                'category_name' => $validatedData['name'],
                'created_by' => Auth::user()->id,
                'version' => 1
            ]);

            DB::commit();
            return to_route('category.index')->with('status','Mess Created');
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
     * @param  \App\Models\MessMenuItemCategory  $messMenuItemCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MessMenuItemCategory $messMenuItemCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessMenuItemCategory  $messMenuItemCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MessMenuItemCategoryDataTable $dataTable, MessMenuItemCategory $category)
    {
        return $dataTable->render('admin.master-data.mess_menu.category.index',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessMenuItemCategory  $messMenuItemCategory
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMessMenuItemCategoryRequest $request, MessMenuItemCategory $category)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try{

            MessMenuItemCategory::where('id', $category->id)
                ->update([
                    'category_name' => $validatedData['name'],
                    'updated_by' => Auth::user()->id
                ]);

            MessMenuItemCategory::where('id',$category->id)->increment('version', 1);

            DB::commit();
            return to_route('category.index')->with('status','Category updated');
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
     * @param  \App\Models\MessMenuItemCategory  $messMenuItemCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessMenuItemCategory $category)
    {
        $catHasItem = MessMenuItem::where('category_id',$category->id)->first();
        if(!empty($catHasItem))
        {
            return to_route('category.index')->with('foreign','Delete restricted! Category contain items.');
        }
        else
        {
            MessMenuItemCategory::find($category->id)->delete();
            return to_route('category.index')->with('status','Category deleted');
        }


    }
}
