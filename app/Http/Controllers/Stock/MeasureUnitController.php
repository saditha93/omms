<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\Stock\MeasureUnitBarDataTable;
use App\DataTables\Stock\MeasureUnitDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\MeasureUnitRequest;
use App\Models\Mess;
use App\Models\Stock\Category;
use App\Models\Stock\MeasureUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MeasureUnitController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:measureUnit-list');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MeasureUnitDataTable $dataTable)
    {
        return $dataTable->render('stock.measureUnit.index');
    }

    public function barIndex(MeasureUnitBarDataTable $dataTable)
    {
        return $dataTable->render('stock.measureUnit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 0)->get();
        $establisments = Mess::all();
        return view('stock.measureUnit.create', compact('establisments', 'categories'));
    }

    public function barCreate()
    {
        $categories = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 1)->get();
        $establisments = Mess::all();
        return view('stock.measureUnit.barCreate', compact('establisments', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MeasureUnitRequest $request)
    {

        $request->validate(['name' => ['required', 'max:255', Rule::unique('measure_units')->where(function ($query) use ($request) {
            return $query->where('establishment_id', $request->establishment_id);
        })],]);

        $item = MeasureUnit::create(['name' => $request->name, 'abbreviation' => $request->abbreviation, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);

        $item->categories()->attach($request->category_ids);

        return redirect()->route('measureUnit.index')
            ->with('message', 'Measure Unit created successfully.');

    }

    public function barStore(MeasureUnitRequest $request)
    {

        $request->validate(['name' => ['required', 'max:255', Rule::unique('measure_units')->where(function ($query) use ($request) {
            return $query->where('establishment_id', $request->establishment_id);
        })], 'size' => 'numeric']);

        $item = MeasureUnit::create(['name' => $request->name, 'abbreviation' => $request->abbreviation, 'size_type' => $request->size_type, 'size' => empty($request->size) ? 0 : $request->size, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);

        $item->categories()->attach($request->category_ids);

        return redirect()->route('barmeasureUnit.index')
            ->with('message', 'Measure Unit created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\MeasureUnit $measureUnit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(MeasureUnit $measureUnit)
    {
        return view('stock.measureUnit.show', compact('measureUnit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MeasureUnit $measureUnit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(MeasureUnit $measureUnit)
    {
        $categories = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 0)->get();
        $establisments = Mess::all();
        return view('stock.measureUnit.edit', compact('measureUnit', 'establisments', 'categories'));
    }

    public function baredit($id)
    {
        $measureUnit = MeasureUnit::find($id);
        $categories = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 1)->get();
        $establisments = Mess::all();
        return view('stock.measureUnit.baredit', compact('measureUnit', 'establisments', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MeasureUnit $measureUnit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, MeasureUnit $measureUnit)
    {
        if ($request->size_type) {
            $request->validate(['name' => ['required', 'max:255', Rule::unique('measure_units')->where(function ($query) use ($measureUnit, $request) {
                return $query->where('establishment_id', $request->establishment_id)->where('id', '!=', $measureUnit->id);
            })], 'size' => 'numeric']);

            $measureUnit->update(['name' => $request->name, 'abbreviation' => $request->abbreviation, 'size_type' => $request->size_type, 'size' => empty($request->size) ? 0 : $request->size, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active, 'ip' => $request->ip()]);

            $measureUnit->categories()->sync($request->category_ids);

            return redirect()->route('barmeasureUnit.index')
                ->with('message', 'Measure Unit update successfully.');
        } else {
            $request->validate(['name' => ['required', 'max:255', Rule::unique('measure_units')->where(function ($query) use ($measureUnit, $request) {
                return $query->where('establishment_id', $request->establishment_id)->where('id', '!=', $measureUnit->id);
            })],]);

            $measureUnit->update(['name' => $request->name, 'abbreviation' => $request->abbreviation, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active, 'ip' => $request->ip()]);

            $measureUnit->categories()->sync($request->category_ids);

            return redirect()->route('measureUnit.index')
                ->with('message', 'Measure Unit update successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MeasureUnit $measureUnit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MeasureUnit $measureUnit)
    {
        $measureUnit->categories()->detach();
        $measureUnit->delete();
        if ($measureUnit->size_type) {
            return redirect()->route('barmeasureUnit.index')
                ->with('message', 'Measure Unit deleted successfully');
        } else {
            return redirect()->route('measureUnit.index')
                ->with('message', 'Measure Unit deleted successfully');
        }

    }
}
