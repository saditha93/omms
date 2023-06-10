<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Mess;
use App\Models\Stock\Item;
use App\Models\Stock\Stock;
use App\Models\Stock\StockBook;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockBookController extends Controller
{
    public function SelcetQuarter(Request $request)
    {
        $establisments = Mess::all();
        return view('stock.stockBook.selcetQuarter', compact('establisments'));
    }

    public function DetailsQuarter(Request $request)
    {

        if (isset($request->item_id)) {
            $items = Stock::with('item')->whereHas("item", function ($q) use ($request) {
                $q->where('id', $request->item_id)->where('establishment_id', Auth::user()->mess_id);
            })->get();
        } else {
            $items = Stock::with(['item',])->whereHas("item", function ($q) use ($request) {
                $q->where('establishment_id', Auth::user()->mess_id);
            })->whereHas("item.categories", function ($q) {
                $q->where('is_bar', 0);
            })->get();
        }

        if (isset($request->establishment_id)) {
            $itemNames = Item::with(['categories'])->where('establishment_id', $request->establishment_id)->whereHas("categories", function ($q) {
                $q->where('is_bar', 0);
            })->get();
        } else {
            $itemNames = Item::with(['categories'])->where('establishment_id', Auth::user()->mess_id)->whereHas("categories", function ($q) {
                $q->where('is_bar', 0);
            })->get();
        }
        $establishment_id = $request->establishment_id;
        $select_id = $request->item_id;
        $stockBooks = StockBook::all();
        $balanceQty = StockBook::whereBetween('date', ['0000-00-00', $request->start])->select('balance_qty', 'item_id')->orderBy('date', 'desc')->get()->unique('item_id');
        $begin = new DateTime($request->start);
        $end = new DateTime($request->end);
        return view('stock.stockBook.detailsQuarter', compact('items', 'begin', 'end', 'stockBooks', 'itemNames', 'select_id', 'balanceQty', 'establishment_id'));
    }
}
