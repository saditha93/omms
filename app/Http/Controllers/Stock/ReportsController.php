<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Mess;
use App\Models\Stock\Category;
use App\Models\Stock\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index()
    {

    }

    public function singleitem()
    {
        $items = Item::with(['establishment', 'stock', 'categories'])->whereHas("categories", function ($q) {
            $q->where('is_bar', 0);
        })->where('establishment_id', Auth::user()->mess_id)->get();
        $parentCat = Category::where('parent_id', 0)->where('is_bar', 0)->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.reports.singleitem', compact('items', 'parentCat'));
    }

    public function barsingleitem()
    {

        $barCat = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();
        $items = $barCat->items()->with(['establishment', 'stock'])->get();

        $parentCat = Category::where('parent_id', 0)->where('is_bar', 1)->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.reports.barsingleitem', compact('items', 'parentCat'));
    }

    public function allitems()
    {

        $categories = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 0)->get();
        $parentCat = Category::where('parent_id', 0)->where('is_bar', 0)->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.reports.allitems', compact('categories', 'parentCat'));
    }

    public function barallitems()
    {
        $categories = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 1)->get();
        $parentCat = Category::where('parent_id', 0)->where('is_bar', 1)->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.reports.allitems', compact('categories', 'parentCat'));
    }

    public function stock()
    {

        $categories = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 0)->get();

        $establisments = Mess::where('id', Auth::user()->mess_id)->get();
        return view('stock.reports.stock', compact('categories', 'establisments'));
    }

    public function barstock()
    {

        $categories = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 1)->get();

        $establisments = Mess::where('id', Auth::user()->mess_id)->get();
        return view('stock.reports.barstock', compact('categories', 'establisments'));
    }

    public function outstock()
    {
        $categories = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 0)->get();
        $parentCat = Category::where('parent_id', 0)->where('is_bar', 0)->where('establishment_id', Auth::user()->mess_id)->get();
        $establisments = Mess::all();
        return view('stock.reports.outstock', compact('categories', 'establisments', 'parentCat'));
    }

    public function baroutstock()
    {
        $categories = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 1)->get();
        $parentCat = Category::where('parent_id', 0)->where('is_bar', 1)->where('establishment_id', Auth::user()->mess_id)->get();
        $establisments = Mess::all();
        return view('stock.reports.outstock', compact('categories', 'establisments', 'parentCat'));
    }

    public function recive_expier()
    {
        return view('stock.reports.recive_expier');
    }

    public function grnin()
    {
        $items = Item::with(['establishment', 'stock', 'categories'])->whereHas("categories", function ($q) {
            $q->where('is_bar', 0);
        })->where('establishment_id', Auth::user()->mess_id)->get();

        $parentCat = Category::where('parent_id', 0)->where('is_bar', 0)->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.reports.grnin', compact('items', 'parentCat'));
    }

    public function bargrnin()
    {
        $barCat = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();
        $items = $barCat->items()->with(['establishment', 'stock'])->get();

        $parentCat = Category::where('parent_id', 0)->where('is_bar', 1)->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.reports.bargrnin', compact('items', 'parentCat'));
    }

    public function in()
    {
        $items = Item::with(['establishment', 'stock', 'categories'])->whereHas("categories", function ($q) {
            $q->where('is_bar', 0);
        })->where('establishment_id', Auth::user()->mess_id)->get();

        $establisments = Mess::all();
        $parentCat = Category::where('parent_id', 0)->where('is_bar', 0)->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.reports.in', compact('items', 'establisments', 'parentCat'));
    }

    public function grnprice()
    {
        $items = Item::with(['establishment', 'stock', 'categories'])->whereHas("categories", function ($q) {
            $q->where('is_bar', 0);
        })->where('establishment_id', Auth::user()->mess_id)->get();

        $establisments = Mess::all();
        $parentCat = Category::where('parent_id', 0)->where('is_bar', 0)->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.reports.grnprice', compact('items', 'establisments', 'parentCat'));
    }

    public function bargrnprice()
    {
        $barCat = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();
        $items = $barCat->items()->with(['establishment', 'stock'])->get();

        $establisments = Mess::all();
        $parentCat = Category::where('parent_id', 0)->where('is_bar', 1)->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.reports.bargrnprice', compact('items', 'establisments', 'parentCat'));
    }

}
