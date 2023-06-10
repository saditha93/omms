<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\Stock\GRNBarDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\GRNHeaderRequest;
use App\DataTables\Stock\GRNDataTable;
use App\Models\Mess;
use App\Models\Stock\GRNDetail;
use App\Models\Stock\GRNHeader;
use App\Models\Stock\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GRNHeaderController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:grn-list');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GRNDataTable $dataTable)
    {
        return $dataTable->render('stock.gRNHeader.index');
    }

    public function barGrnIndex(GRNBarDataTable $dataTable)
    {
        return $dataTable->render('stock.gRNHeader.barIndex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $suppliers = Supplier::where('active', 1)->get();
        $establisments = Mess::all();
        return view('stock.gRNHeader.create', compact('suppliers', 'establisments'));
    }

    public function barGrn()
    {
        $suppliers = Supplier::where('active', 1)->get();
        $establisments = Mess::all();
        return view('stock.gRNHeader.barCreate', compact('suppliers', 'establisments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GRNHeaderRequest $request)
    {

        $grn = GRNHeader::create(['no' => $request->no, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active,
            'creater_id' => Auth::user()->id, 'ip' => $request->ip(), 'date' => $request->date, 'order_no' => 0, 'is_bar' => 0, 'supplier_id' => $request->supplier_id, 'remarks' => $request->remarks]);

        $oderNo = str_pad($grn->id, 10, "0", STR_PAD_LEFT);

        $grn->update(['order_no' => $oderNo]);

        return redirect()->route('gRNHeader.index')
            ->with('message', 'GRN Header created successfully.');
    }

    public function barStore(GRNHeaderRequest $request)
    {

        $grn = GRNHeader::create(['no' => $request->no, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active,
            'creater_id' => Auth::user()->id, 'ip' => $request->ip(), 'date' => $request->date, 'order_no' => 0, 'is_bar' => 1, 'supplier_id' => $request->supplier_id, 'remarks' => $request->remarks]);

        $oderNo = str_pad($grn->id, 10, "0", STR_PAD_LEFT);

        $grn->update(['order_no' => $oderNo]);

        return redirect()->route('gRNHeader.bar.index')
            ->with('message', 'GRN Header created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\GRNHeader $gRNHeader
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(GRNHeader $gRNHeader)
    {
        $headerItems = GRNDetail::where('header_id', $gRNHeader->id)->get();
        return view('stock.gRNHeader.show', compact('gRNHeader', 'headerItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\GRNHeader $gRNHeader
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(GRNHeader $gRNHeader)
    {
        $suppliers = Supplier::where('active', 1)->get();
        $establisments = Mess::all();
        return view('stock.gRNHeader.edit', compact('gRNHeader', 'suppliers', 'establisments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GRNHeader $gRNHeader
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GRNHeaderRequest $request, GRNHeader $gRNHeader)
    {
        $gRNHeader->update(['no' => $request->no, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active,
            'ip' => $request->ip(), 'date' => $request->date, 'order_no' => $gRNHeader->order_no, 'supplier_id' => $request->supplier_id, 'remarks' => $request->remarks]);

        if($gRNHeader->is_bar == 1){
            return redirect()->route('gRNHeader.bar.index')
                ->with('message', 'GRN Header updated successfully.');
        }else{
            return redirect()->route('gRNHeader.index')
                ->with('message', 'GRN Header updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\GRNHeader $gRNHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(GRNHeader $gRNHeader)
    {
        //
    }
}
