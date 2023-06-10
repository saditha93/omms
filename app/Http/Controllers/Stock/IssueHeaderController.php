<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\Stock\IssueDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\IssueHeaderRequest;
use App\Models\Mess;
use App\Models\Stock\GRNHeader;
use App\Models\Stock\IssueDetail;
use App\Models\Stock\IssueHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueHeaderController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:issue-list');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IssueDataTable $dataTable)
    {
        return $dataTable->render('stock.issueHeader.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $establisments = Mess::all();
        return view('stock.issueHeader.create', compact('establisments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IssueHeaderRequest $request)
    {
        $issue = IssueHeader::create(['no' => $request->no, 'establishment_id' => Auth::user()->mess_id, 'order_no' => 0, 'service_no' => $request->service_no, 'active' => empty($request->active) ? 0 : $request->active,
            'creater_id' => Auth::user()->id, 'ip' => $request->ip(), 'date' => $request->date, 'remarks' => $request->remarks]);

        $oderNo = str_pad($issue->id, 10, "0", STR_PAD_LEFT);

        $issue->update(['order_no' => $oderNo]);

        return redirect()->route('issueHeader.index')
            ->with('message', 'Issue Note created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\IssueHeader $issueHeader
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(IssueHeader $issueHeader)
    {
        $headerItems = IssueDetail::where('header_id', $issueHeader->id)->get();
        return view('stock.issueHeader.show', compact('issueHeader', 'headerItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\IssueHeader $issueHeader
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(IssueHeader $issueHeader)
    {
        $establisments = Mess::all();
        return view('stock.issueHeader.edit', compact('issueHeader', 'establisments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\IssueHeader $issueHeader
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(IssueHeaderRequest $request, IssueHeader $issueHeader)
    {


        $issueHeader->update(['no' => $request->no, 'establishment_id' => Auth::user()->mess_id, 'service_no' => $request->service_no, 'active' => empty($request->active) ? 0 : $request->active,
            'ip' => $request->ip(), 'date' => $request->date, 'remarks' => $request->remarks]);
        return redirect()->route('issueHeader.index')
            ->with('message', 'Issue Note update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\IssueHeader $issueHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueHeader $issueHeader)
    {
        //
    }
}
