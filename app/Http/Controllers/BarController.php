<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Models\Stock\Category;
use App\Models\Stock\GRNDetail;
use App\Models\Stock\Item;
use App\Models\Stock\MeasureUnit;
use App\Models\Stock\Stock;
use App\Models\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->get();

        $barCat = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();
        $barId = $barCat->id;

        $barCats = Category::where('establishment_id', Auth::user()->mess_id)
            ->where('parent_id', $barId)
            ->get(['name', 'id']);

        $items = $barCat->items()->get();

        $measureUnits = MeasureUnit::where('establishment_id', Auth::user()->mess_id)->whereNotNull('size_type')->get();

        return view('admin.master-data.Bar.index', compact('officers', 'barCats', 'measureUnits', 'items'));
    }

    public function getBarItems(Request $request)
    {
        $categry = Category::find($request->catId);
        return $categry->items()->with(['stock', 'measure_unit'])->get();

    }

    public function getBarQty(Request $request)
    {
        if ($request->ajax()) {
            $item = Item::with(['stock', 'measure_unit'])->find($request->id);
            if (isset(GRNDetail::with(['item'])->where('item_id', $request->id)->latest()->limit(1)->first()->unit_price)) {
                $price = 'RS ' . ' ' . GRNDetail::with(['item'])->where('item_id', $request->id)->latest()->limit(1)->first()->unit_price;
            } else {
                $price = 0;
            }
            if ($item->stock->shot != 0) {
                $value = $item->measure_unit->abbreviation . ': ' . $item->stock->qty . ' and shot: ' . $item->stock->shot;
            } else {
                $value = $item->measure_unit->abbreviation . ': ' . $item->stock->qty;
            }
            $data[1] = $value;
            $data[2] = $price;

            return response()->json($data);
        }

    }

    public function saveBarOrders(Request $request)
    {
        $request->validate([
            'officers' => 'required',
            'order_dt' => 'required',
            'category' => 'required',
            'item' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'measure' => 'required',
        ]);

        $item = Item::with(['stock', 'measure_unit'])->find($request->item);
        $mesureUnit = MeasureUnit::find($request->measure);

        $availStock = $item->stock->qty;
        $availShot = $item->stock->shot;

        if ($availStock <= 0 && $availShot <= 0) {
            return to_route('bar.index')->with('status', 'Product not available');
        }

        if ($mesureUnit->size_type != 'ml' && $item->measure_unit->size_type == 'ml') {
            return to_route('bar.index')->with('status', 'Please select valid Measure Unit');
        }

        if ($availStock * $item->measure_unit->size < $request->qty * $mesureUnit->size) {
            return to_route('bar.index')->with('status', 'Product not available');
        }

        if (count($request->officers) == 1) {

            Bar::create([
                'officer_id' => $request->officers[0],
                'order_dt' => $request->order_dt,
                'category' => $request->category,
                'item' => $request->item,
                'measure' => $request->measure,
                'qty' => $request->qty,
                'price' => $request->price,
                'mess_id' => Auth::user()->mess_id,
                'created_by' => Auth::user()->id,
            ]);

            if ($mesureUnit->size_type == 'ml' && $item->measure_unit->size_type == 'ml') {

                $availStock = $availStock * $item->measure_unit->size + $availShot * 50;
                $requestSize = $request->qty * $mesureUnit->size;

                $newAvailbleSize = $availStock - $requestSize;
                $newStock = intdiv($newAvailbleSize, $item->measure_unit->size);
                $newShot = fmod($newAvailbleSize, $item->measure_unit->size) / 50;

            } else {
                $newStock = $availStock - $request->qty;
                $newShot = 0;
            }

            $item->stock->update(['qty' => $newStock, 'shot' => $newShot]);
            return to_route('bar.index')->with('status', 'Bar order created');

        } elseif (count($request->officers) > 1) {

            $qty = $request->qty / count($request->officers);
            $price = $request->price / count($request->officers);

            foreach ($request->officers as $officer) {

                Bar::create([
                    'officer_id' => $request->officers[0],
                    'order_dt' => $request->order_dt,
                    'category' => $request->category,
                    'item' => $request->item,
                    'measure' => $request->measure,
                    'qty' => $qty,
                    'price' => $price,
                    'mess_id' => Auth::user()->mess_id,
                    'created_by' => Auth::user()->id,
                ]);

                if ($mesureUnit->size_type == 'ml' && $item->measure_unit->size_type == 'ml') {

                    $availStock = $availStock * $item->measure_unit->size + $availShot * 50;
                    $requestSize = $qty * $mesureUnit->size;

                    $newAvailbleSize = $availStock - $requestSize;
                    $newStock = intdiv($newAvailbleSize, $item->measure_unit->size);
                    $newShot = fmod($newAvailbleSize, $item->measure_unit->size) / 50;

                } else {
                    $newStock = $availStock - $qty;
                    $newShot = 0;
                }

                $item->stock->update(['qty' => $newStock, 'shot' => $newShot]);
            }
            return to_route('bar.index')->with('status', 'Bar order created');
        }
    }


    public function officerRespectiveBarOrders(Request $request)
    {

        if (isset($request->officer_id)) {
            $data = Bar::join('users', 'users.email', 'bars.officer_id')
                ->join('categories', 'categories.id', 'bars.category')
                ->join('items', 'items.id', 'bars.item')
                ->join('measure_units', 'measure_units.id', 'bars.measure')
                ->where('users.email', $request->officer_id)
                ->where('bars.mess_id', Auth::user()->mess_id)
                ->get([
                    'bars.id',
                    'bars.qty',
                    'bars.order_dt',
                    'bars.price',
                    'categories.name as catName',
                    'items.name as itemName',
                    'measure_units.name as measureNAme',
                    'users.name_according_to_part2'
                ]);
        } else {
            $data = Bar::join('users', 'users.email', 'bars.officer_id')
                ->join('categories', 'categories.id', 'bars.category')
                ->join('items', 'items.id', 'bars.item')
                ->join('measure_units', 'measure_units.id', 'bars.measure')
                ->where('bars.mess_id', Auth::user()->mess_id)
                ->get([
                    'bars.id',
                    'bars.qty',
                    'bars.order_dt',
                    'bars.price',
                    'categories.name as catName',
                    'items.name as itemName',
                    'measure_units.name as measureNAme',
                    'users.name_according_to_part2'
                ]);
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<a class="btn btn-sm btn-warning" href="' . route('bar.edit', $row->id) . '">Edit</a>';
            })
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make(true);

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
     * @param \App\Models\Bar $bar
     * @return \Illuminate\Http\Response
     */
    public function show(Bar $bar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Bar $bar
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Bar $bar)
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->get();

        $barCat = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();
        $barId = $barCat->id;

        $barCats = Category::where('establishment_id', Auth::user()->mess_id)
            ->where('parent_id', $barId)
            ->get(['name', 'id']);

        $parencat = Category::find($bar->category);
        $selectCat = Category::where('parent_id', $parencat->parent_id)->where('establishment_id', Auth::user()->mess_id)->get();

        $item = Item::with(['stock', 'measure_unit'])->find($bar->item);
        if ($item->stock->shot != 0) {
            $value = $item->measure_unit->abbreviation . ': ' . $item->stock->qty . ' and shot: ' . $item->stock->shot;
        } else {
            $value = $item->measure_unit->abbreviation . ': ' . $item->stock->qty;
        }

        $items = $parencat->items()->get();

        $measureUnits = MeasureUnit::where('establishment_id', Auth::user()->mess_id)->get();

        return view('admin.master-data.Bar.edit', compact('bar', 'officers', 'barCats', 'items', 'measureUnits', 'selectCat', 'value'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bar $bar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Bar $bar)
    {
        $request->validate([
            'order_dt' => 'required',
            'price' => 'required'
        ]);

        $bar->update([
            'order_dt' => $request->order_dt,
            'price' => $request->price,
        ]);

        return to_route('bar.index')->with('status', 'Bar order updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Bar $bar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bar $bar)
    {
        //
    }

    public function getBarMeasures(request $request)
    {
        if ($request->ajax()) {

            if ($request->item_id) {
                $mesid = Item::find($request->item_id)->measure_unit_id;
                return MeasureUnit::where('id', $mesid)->get();
            } elseif ($request->catId != 0) {
                $categry = Category::find($request->catId);
                return $categry->measure_units()->get();
            } else {
                return MeasureUnit::where('establishment_id', Auth::user()->mess_id)->get();
            }
        }
    }

    public function barOrders()
    {
        $officers = User::join('officers_assigns', 'officers_assigns.enum', '=', 'users.email')
            ->where('officers_assigns.status', 1)
            ->where('officers_assigns.mess_id', Auth::user()->mess_id)
            ->get();

        return view('admin.master-data.Bar.orders', compact('officers'));
    }
}
