<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StockAdjustmentsRequest;
use App\Models\Stock\Category;
use App\Models\Stock\Item;
use App\Models\Stock\Stock;
use App\Models\Stock\StockAdjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $items = Item::with(['measure_unit', 'categories', 'stock'])->whereHas("categories", function ($q) {
            $q->where('is_bar', 0);
        })->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.stockAdjustment.create', compact('items'));
    }

    public function barCreate()
    {
        $barCat = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();

        $items = $barCat->items()->with(['stock', 'categories', 'measure_unit', 'establishment'])->get();

        return view('stock.stockAdjustment.barCreate', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StockAdjustmentsRequest $request)
    {
        StockAdjustment::create(['stock_id' => $request->stock_id, 'pre_stock' => $request->pre_stock,
            'adjusted_stock' => 0, 'remark' => $request->remark, 'ip' => $request->ip(), 'creater_id' => Auth::user()->id]);

        $stock = Stock::find($request->stock_id);

        $stock->update(['item_id' => $request->item_id, 'below_qty' => $request->below_qty]);
        return redirect()->route('stock.index')
            ->with('message', 'Stock adjustment successfully.');
    }

    public function barStore(StockAdjustmentsRequest $request)
    {
        StockAdjustment::create(['stock_id' => $request->stock_id, 'pre_stock' => $request->pre_stock,
            'adjusted_stock' => 0, 'remark' => $request->remark, 'ip' => $request->ip(), 'creater_id' => Auth::user()->id]);

        $stock = Stock::find($request->stock_id);

        $stock->update(['item_id' => $request->item_id, 'below_qty' => $request->below_qty]);
        return redirect()->route('bar.stock')
            ->with('message', 'Stock adjustment successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\StockAdjustment $stockAdjustment
     * @return \Illuminate\Http\Response
     */
    public function show(StockAdjustment $stockAdjustment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StockAdjustment $stockAdjustment
     * @return \Illuminate\Http\Response
     */
    public function edit(StockAdjustment $stockAdjustment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StockAdjustment $stockAdjustment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockAdjustment $stockAdjustment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StockAdjustment $stockAdjustment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockAdjustment $stockAdjustment)
    {
        //
    }
}
