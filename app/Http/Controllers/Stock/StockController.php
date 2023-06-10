<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\Stock\StockBarDataTable;
use App\DataTables\Stock\StockDataTable;
use App\Http\Controllers\Controller;
use App\Models\Mess;
use App\Models\Stock\GRNDetail;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:stock-list');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StockDataTable $dataTable)
    {
        return $dataTable->render('stock.stock.index');
    }

    public function barStock(StockBarDataTable $dataTable)
    {
        return $dataTable->render('stock.stock.index');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        $grnAvalables = GRNDetail::with(['header', 'item'])->where('item_id', $stock->item->id)->where('avl_qty', '>', 0)->get();
        $establishment = Mess::find($stock->item->establishment_id);
        return view('stock.stock.show', compact('stock','establishment','grnAvalables'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
