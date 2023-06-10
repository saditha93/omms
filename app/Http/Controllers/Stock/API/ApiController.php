<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Establishment;
use App\Models\GRNDetail;
use App\Models\Item;
use App\Models\MeasureUnit;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function items($code)
    {
        $items = Item::with(['establishment', 'stock', 'categories', 'measure_unit'])->whereHas("establishment", function ($q) use ($code) {
            $q->where('code', $code);
        })->get();
        return response()->json([
            'status' => 'success',
            'items' => $items,
        ]);
    }

    public function GetMeasureUnits($code)
    {
        $establisment_id = Establishment::where('code', $code)->first()->id;

        $items = MeasureUnit::where('establishment_id', $establisment_id)->get();
        return response()->json([
            'status' => 'success',
            'Measure Units' => $items,
        ]);
    }

    public function GetEstablisment()
    {
        $establisments = Establishment::all();

        return response()->json([
            'status' => 'success',
            'Establishments' => $establisments,
        ]);
    }

    public function item($id)
    {
        $item = Item::with(['stock' => function ($stock) {
            $stock->select('item_id', 'qty');
        }])->with(['measure_unit' => function ($company) {
            $company->select('id', 'name', 'abbreviation');
        }])->where('id', $id)->get()->map->only([
            'id', 'name', 'code', 'active', 'stock', 'measure_unit'
        ])->first();

        $grnData = GRNDetail::where('item_id', $item['id'])->latest()->first();
        if (isset($grnData->id)) {
            $price = $grnData->unit_price;
        } else {
            $price = null;
        }
        $item['price'] = $price;

        return response()->json([
            'status' => 'success',
            'item' => $item,
        ]);
    }

    public function categories($code)
    {
        $categories = Category::with(['establishment', 'items'])->whereHas("establishment", function ($q) use ($code) {
            $q->where('code', $code);
        })->get();
        return response()->json([
            'status' => 'success',
            'categories' => $categories,
        ]);
    }

    public function category($id)
    {
        $category = Category::with(['establishment', 'items'])->where('id', $id)->first();
        return response()->json([
            'status' => 'success',
            'categories' => $category,
        ]);
    }

    public function latestPrice($code)
    {
        $latestPrice = GRNDetail::with(['header', 'item', 'header.establishment', 'header.supplier'])->whereHas("header.establishment", function ($q) use ($code) {
            $q->where('code', $code);
        })->latest()->get()->unique('item_id');
        return response()->json([
            'status' => 'success',
            'latestPrice' => $latestPrice,
        ]);
    }

    public function itemsCatCode($est_code, $cat_code)
    {
        $items = Item::with(['stock' => function ($company) {
            $company->select('item_id', 'qty');
        }])->whereHas("establishment", function ($q) use ($est_code) {
            $q->where('code', $est_code);
        })->whereHas("categories", function ($q) use ($cat_code) {
            $q->where('code', $cat_code);
        })->get()->map->only([
            'id', 'name', 'code', 'active', 'stock'
        ]);

        $data = [];
        foreach ($items as $item) {
            $grnData = GRNDetail::where('item_id', $item['id'])->latest()->first();
            if (isset($grnData->id)) {
                $price = $grnData->unit_price;
            } else {
                $price = null;
            }
            $item['price'] = $price;
            $data[] = $item;
        }

        return response()->json([
            'status' => 'success',
            'items' => $data,
        ]);
    }

    public function itemCreate(Request $request)
    {
        try {

            $request->validate([
                'item_code' => 'required|numeric',
                'establishment_code' => 'required',
                'measure_unit_id' => 'required'
            ]);

            $request->validate(['name' => ['required', 'max:255', Rule::unique('items')->where(function ($query) use ($request) {
                return $query->where('establishment_id', $request->establishment_id);
            })],]);

            $establisment_id = Establishment::where('code', $request->establishment_code)->first()->id;

            $item = Item::create(['name' => $request->name, 'establishment_id' => $establisment_id, 'code' => $request->item_code,
                'measure_unit_id' => $request->measure_unit_id, 'latest_user_tbl_id' => Auth::user()->id, 'latest_ip' => $request->ip(), 'active' => empty($request->active) ? 0 : $request->active]);

            $selectCategory = Category::where('code', $request->category_code)->first();

            $categories = [];
            if (isset($selectCategory->id)) {
                $categories[] = $selectCategory->id;
                $parent_1 = $this->getTreeCategory($selectCategory, $establisment_id);
                if (isset($parent_1->id)) {
                    $categories[] = $parent_1->id;
                    $parent_2 = $this->getTreeCategory($parent_1, $establisment_id);
                    if (isset($parent_2->id)) {
                        $categories[] = $parent_2->id;
                        $parent_3 = $this->getTreeCategory($parent_2, $establisment_id);
                        if (isset($parent_3->id)) {
                            $categories[] = $parent_3->id;
                        }
                    }
                }
            }

            $item->categories()->attach($categories);

            Stock::create(['item_id' => $item->id, 'qty' => 0, 'last_txn_type' => 'in']);

            return response()->json([
                'status' => 'success',
                'message' => 'Item created successfully',
                'item' => $item,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Faild',
                'message' => $e->getMessage()
            ]);
        }

    }
    public function CategoryTree($est_code, $cat_code)
    {
        $establisment_id = Establishment::where('code', $est_code)->first()->id;
        $selectCategory = Category::where('code', $cat_code)->first();

        if (isset($selectCategory->id)) {
            $categories = Category::where('parent_id', '=', $selectCategory->id)->where('establishment_id', $establisment_id)->get();
            return $categories;
        }
    }

    public function getTreeCategory($category, $establisment_id)
    {
        if (isset($category->id)) {
            $categories = Category::where('id', $category->parent_id)->where('establishment_id', $establisment_id)->first();
            return $categories;
        }
    }

}
