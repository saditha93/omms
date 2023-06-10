<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\Stock\SupplierDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\SupplierRequest;
use App\Models\Mess;
use App\Models\Stock\GRNDetail;
use App\Models\Stock\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:supplier-list');
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('stock.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $establisments = Mess::all();
        return view('stock.supplier.create', compact('establisments'));
    }

    public function barCreate()
    {
        $establisments = Mess::all();
        return view('stock.supplier.barCreate', compact('establisments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SupplierRequest $request)
    {
        $request->validate(['name' => ['required', 'max:150', Rule::unique('suppliers')->where(function ($query) use ($request) {
            return $query->where('establishment_id', $request->establishment_id);
        })],]);

        Supplier::create(['name' => $request->name, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active,
            'creater_id' => Auth::user()->id, 'ip' => $request->ip(), 'address' => $request->address, 'tele' => $request->tele, 'mobile' => $request->mobile, 'email' => $request->email]);
        return redirect()->route('supplier.index')
            ->with('message', 'Supplier created successfully.');
    }

    public function barStore(SupplierRequest $request)
    {
        $request->validate(['name' => ['required', 'max:150', Rule::unique('suppliers')->where(function ($query) use ($request) {
            return $query->where('establishment_id', $request->establishment_id);
        })],]);

        Supplier::create(['name' => $request->name, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active,
            'creater_id' => Auth::user()->id, 'ip' => $request->ip(), 'address' => $request->address, 'tele' => $request->tele, 'mobile' => $request->mobile, 'email' => $request->email]);
        return redirect()->route('bar.supplier')
            ->with('message', 'Supplier created successfully.');
    }

    /**
     * /**
     * Display the specified resource.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Supplier $supplier)
    {
        $grnAvalables = GRNDetail::with(['header', 'item'])->whereHas("header", function ($q) use ($supplier) {
            $q->where('supplier_id', $supplier->id);
        })->get();
        return view('stock.supplier.show', compact('supplier', 'grnAvalables'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Supplier $supplier)
    {
        $establisments = Mess::all();
        return view('stock.supplier.edit', compact('supplier', 'establisments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(SupplierRequest $request, Supplier $supplier)
    {

        $request->validate(['name' => ['required', 'max:150', Rule::unique('suppliers')->where(function ($query) use ($request) {
            return $query->where('establishment_id', $request->establishment_id)->whereNot('id', $request->id);
        })],]);

        $supplier->update(['name' => $request->name, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active,
            'ip' => $request->ip(), 'address' => $request->address, 'tele' => $request->tele, 'mobile' => $request->mobile, 'email' => $request->email]);
        return redirect()->route('supplier.index')
            ->with('message', 'Supplier update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy(Supplier $supplier)
    {
        $supplier->update(['active' => $supplier->active == 1 ? 0 : 1]);
        return redirect()->route('supplier.index')
            ->with('message', 'Supplier status successfully');
    }
}
