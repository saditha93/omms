<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Mess;
use App\Models\Stock\Category;
use App\Models\Stock\GRNDetail;
use App\Models\Stock\GRNHeader;
use App\Models\Stock\IssueDetail;
use App\Models\Stock\IssueHeader;
use App\Models\Stock\Item;
use App\Models\Stock\MeasureUnit;
use App\Models\Stock\Stock;
use App\Models\Stock\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ajaxController extends Controller
{


    public function getSection(request $request)
    {
        if ($request->ajax()) {
            return Mess::find(empty($request->id) ? Auth::user()->mess_id : $request->id)->section;
        }
    }

    public function getPrice(request $request)
    {
        if ($request->ajax()) {

            $mesureUnit = MeasureUnit::find($request->measure);
            $item = Item::find($request->item);
            if ($mesureUnit->size_type == 'ml' && $item->measure_unit->size_type == 'ml') {
                $grnPrice = GRNDetail::with(['item'])->where('item_id', $request->item)->latest()->limit(1)->first()->unit_price;
                $shot = $grnPrice / ($item->measure_unit->size / $mesureUnit->size);
                $price = $shot * $request->qty;
            } else {
                $grnPrice = GRNDetail::with(['item'])->where('item_id', $request->item)->latest()->limit(1)->first()->unit_price;
                $price = $grnPrice * $request->qty;
            }
            return $price;
        }
    }

    public function getCategory(request $request)
    {
        if ($request->ajax()) {
            return Category::where('establishment_id', empty($request->id) ? Auth::user()->mess_id : $request->id)->get();
        }
    }

    public function getTreeCategory(request $request)
    {
        if ($request->ajax()) {
            if (isset($request->category_id)) {
                $categories = Category::where('parent_id', '=', empty($request->category_id) ? 0 : $request->category_id)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();
                return $categories;
            }
        }
    }

    public function getItem(request $request)
    {
        if ($request->ajax()) {
            return Item::with(['establishment', 'stock', 'categories', 'measure_unit'])->where('id', $request->id)->first();
        }
    }

    public function getCatStock(request $request)
    {
        if ($request->ajax()) {
            if ($request->id != 0) {
                $categry = Category::find($request->id);
                return $categry->items()->with(['establishment', 'stock', 'measure_unit'])->get();
            } else {
                return Item::with(['establishment', 'stock', 'measure_unit'])->get();
            }
        }
    }

    public function getMesCategory(request $request)
    {
        if ($request->ajax()) {
            if ($request->category_id != 0) {
                $categry = Category::find($request->category_id);
                return $categry->measure_units()->get();
            } else {
                return MeasureUnit::all();
            }
        }
    }

    public function getOutStock(request $request)
    {
        if ($request->ajax()) {
            if ($request->id != 0) {

                $categry = Category::find($request->id);
                return $categry->items()->with(['establishment', 'stock', 'measure_unit'])->where('establishment_id', Auth::user()->mess_id)->whereHas("stock", function ($q) use ($request) {
                    $q->whereColumn('qty', '<=', 'below_qty');
                })->get();

            } else {
                return Item::with(['establishment', 'stock', 'measure_unit'])->where('establishment_id', Auth::user()->mess_id)->whereHas("stock", function ($q) use ($request) {
                    $q->whereColumn('qty', '<=', 'below_qty');
                })->get();
            }
        }
    }

    public function getOutStockRation(request $request)
    {
        if ($request->ajax()) {
            $items = Item::with(['establishment', 'stock', 'categories', 'measure_unit'])->whereHas("categories", function ($q) {
                $q->where('is_bar', 0);
            })->where('establishment_id', Auth::user()->mess_id);

            $outStock = $items->with(['establishment', 'stock', 'measure_unit'])->where('establishment_id', Auth::user()->mess_id)->whereHas("stock", function ($q) use ($request) {
                $q->whereColumn('qty', '<=', 'below_qty');
            })->get();

            return $outStock;
        }
    }

    public function getOutStockBar(request $request)
    {
        if ($request->ajax()) {
            $barCat = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();
            $barItem = $barCat->items()->with(['stock', 'categories', 'measure_unit', 'establishment'])->where('establishment_id', Auth::user()->mess_id)->whereHas("stock", function ($q) use ($request) {
                $q->whereColumn('qty', '<=', 'below_qty');
            })->get();
            return $barItem;
        }
    }

    public function getCatEstStock(request $request)
    {
        if ($request->ajax()) {
            if ($request->category_ids != 0) {
                $categry = Category::find($request->category_ids);

                foreach ($categry as $item) {
                    if (!isset($items)) {
                        $items = $item->items()->with(['establishment', 'stock', 'measure_unit'])->where('establishment_id', $request->establishment_id)->get();
                    } else {
                        $newItems = $item->items()->with(['establishment', 'stock', 'measure_unit'])->where('establishment_id', $request->establishment_id)->get();
                        foreach ($newItems as $itemData) {
                            if (!isset($items->find($itemData->id)->id))
                                $items->push($itemData);
                        }
                    }
                }
                return $items;
            } else {
                return Item::with(['establishment', 'stock', 'measure_unit', 'categories'])->whereHas("categories", function ($q) use ($request) {
                    $q->where('is_bar', $request->bar);
                })->where('establishment_id', $request->establishment_id)->get();
            }
        }
    }

    public
    function getSupplier(request $request)
    {
        if ($request->ajax()) {
            return Supplier::where('establishment_id', empty($request->id) ? Auth::user()->mess_id : $request->id)->where('active', 1)->get();
        }
    }

    public
    function getStock(request $request)
    {
        if ($request->ajax()) {
            return Stock::where('item_id', $request->id)->first();
        }
    }

    public
    function getMeasureUnit(request $request)
    {
        if ($request->ajax()) {
            return MeasureUnit::where('establishment_id', empty($request->id) ? Auth::user()->mess_id : $request->id)->get();
        }
    }

    public
    function getGRN(request $request)
    {
        if ($request->ajax()) {
            return GRNDetail::with(['header', 'item', 'header.establishment'])->where('item_id', $request->id)
                ->whereHas("header", function ($q) use ($request) {
                    $q->whereBetween('date', [$request->start, $request->end]);
                })->get();
        }
    }

    function closeGRN(request $request)
    {
        if ($request->ajax()) {
            $grnHeader = GRNHeader::find($request->id);
            $grnHeader->update(['active' => 2]);
            return $grnHeader;
        }
    }

    function closeIN(request $request)
    {
        if ($request->ajax()) {
            $issuHeader = IssueHeader::find($request->id);
            $issuHeader->update(['active' => 2]);
            return $issuHeader;
        }
    }

    public
    function grnAvalable(request $request)
    {
        if ($request->ajax()) {
            return GRNDetail::with(['header', 'item'])->where('item_id', $request->id)->where('avl_qty', '>', 0)->orderBy('expire_date', 'asc')->get();
        }
    }

    public
    function getGRNExpir(request $request)
    {
        if ($request->ajax()) {
            return GRNDetail::with(['header', 'item', 'header.establishment'])->whereHas("header", function ($q) use ($request) {
                $q->where('establishment_id', Auth::user()->mess_id);
            })->whereHas("item.categories", function ($q) use ($request) {
                $q->where('is_bar', 0);
            })->whereBetween('expire_date', [$request->start, $request->end])->get();
        }
    }

    public
    function getIN(request $request)
    {
        if ($request->ajax()) {
            if ($request->id == 0) {
                return IssueDetail::with(['header', 'item', 'header.establishment'])
                    ->whereHas("header", function ($q) use ($request) {
                        $q->whereBetween('date', [$request->start, $request->end])->where('establishment_id', Auth::user()->mess_id);
                    })->get();
            } else {
                return IssueDetail::with(['header', 'item', 'header.establishment'])->where('item_id', $request->id)
                    ->whereHas("header", function ($q) use ($request) {
                        $q->whereBetween('date', [$request->start, $request->end]);
                    })->get();
            }
        }
    }

    public
    function getINEST(request $request)
    {
        if ($request->ajax()) {
            if ($request->id == 0) {
                return IssueDetail::with(['header', 'item', 'header.establishment'])
                    ->whereHas("header", function ($q) use ($request) {
                        $q->where('establishment_id', $request->establishment_id)->whereBetween('date', [$request->start, $request->end]);
                    })->get();
            } else {
                return IssueDetail::with(['header', 'item', 'header.establishment'])->where('item_id', $request->id)
                    ->whereHas("header", function ($q) use ($request) {
                        $q->where('establishment_id', $request->establishment_id)->whereBetween('date', [$request->start, $request->end]);
                    })->get();
            }

        }
    }

    public
    function getGRNPrice(request $request)
    {
        if ($request->ajax()) {
            if ($request->id == 0) {
                return GRNDetail::with(['header', 'item', 'item.categories', 'header.establishment', 'header.supplier'])->whereHas("item.categories", function ($q) use ($request) {
                    $q->where('is_bar', $request->bar);
                })->whereHas("header", function ($q) {
                    $q->where('establishment_id', Auth::user()->mess_id);
                })->latest()->get()->unique('item_id');
            } else {
                return GRNDetail::with(['header', 'item', 'header.establishment', 'header.supplier'])->where('item_id', $request->id)->latest()->limit(1)->get();

            }
        }
    }

}
