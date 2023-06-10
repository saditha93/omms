<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\IssueDetailsRequest;
use App\Models\Stock\Category;
use App\Models\Stock\GRNDetail;
use App\Models\Stock\GRNHeader;
use App\Models\Stock\IssueDetail;
use App\Models\Stock\IssueHeader;
use App\Models\Stock\Item;
use App\Models\Stock\Stock;
use App\Models\Stock\StockBook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IssueDetailController extends Controller
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
    public function create(Request $request)
    {
        $header_id = $request->id;
        $header = IssueHeader::find($header_id);
        $establishment_id = IssueHeader::find($header_id)->establishment_id;
        $headerItems = IssueDetail::where('header_id', $header_id)->get();

        $items = Item::with(['measure_unit', 'categories', 'stock'])->whereHas("categories", function ($q) {
            $q->where('is_bar', 0);
        })->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.issueDetail.create', compact('header_id', 'items', 'headerItems', 'establishment_id','header'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IssueDetailsRequest $request)
    {
        $selectGrn = GRNDetail::find($request->select_grn);
        $updateQty = $selectGrn->avl_qty - $request->qty;

        $request->validate(['qty' => ['required', 'numeric', 'lte:' . $selectGrn->avl_qty],]);

        IssueDetail::create(['header_id' => $request->header_id, 'item_id' => $request->item_id, 'active' => empty($request->active) ? 0 : $request->active,
            'creater_id' => Auth::user()->id, 'ip' => $request->ip(), 'qty' => $request->qty, 'unit_price' => $selectGrn->unit_price]);

        $selectGrn->update(['avl_qty' => $updateQty]);

        $stock = Stock::where('item_id', $request->item_id);

        $stock->update(['item_id' => $request->item_id, 'qty' => $stock->first()->qty - $request->qty, 'last_txn_type' => 'out']);

        $header = IssueHeader::find($request->header_id);
        $total = $header->total + $selectGrn->unit_price * $request->qty;
        $header->update(['total' => $total]);

        $balanceQty = StockBook::whereBetween('date', ['0000-00-00', $header->date])->where('item_id', $request->item_id)->select('balance_qty', 'item_id')->orderBy('date', 'desc')->get();
        $thatDayQty = $balanceQty->first()->balance_qty ?? 0;
        $finalQty = $thatDayQty - $request->qty;


        $stockBook = StockBook::where('item_id', $request->item_id)->where('date', $header->date)->where('quarter', ceil(date('n') / 3));

        if (isset($stockBook->first()->id)) {
            $stockBook->update(['item_id' => $request->item_id, 'date' => $header->date,
                'quarter' => ceil(date('n') / 3), 'receive_qty' => $stockBook->first()->receive_qty, 'issue_qty' => $stockBook->first()->issue_qty + $request->qty, 'balance_qty' => $finalQty]);
        } else {
            StockBook::create(['item_id' => $request->item_id, 'date' => $header->date,
                'quarter' => ceil(date('n') / 3), 'receive_qty' => 0, 'issue_qty' => +$request->qty, 'balance_qty' => $finalQty]);
        }

        $otherGrn = StockBook::whereBetween('date', [$header->date, Carbon::today()->toDateString()])->where('item_id', $request->item_id)->orderBy('date', 'desc')->get();

        if ($otherGrn->count() > 0) {
            foreach ($otherGrn as $balance) {
                if ($stockBook->first()->id != $balance->id) {
                    $thatDayQty = $balance->balance_qty;
                    $finalQty = $thatDayQty - $request->qty;

                    $balance->update(['item_id' => $request->item_id, 'date' => $balance->date,
                        'quarter' => ceil(date('n') / 3), 'receive_qty' => $balance->receive_qty, 'issue_qty' => $balance->issue_qty, 'balance_qty' => $finalQty]);
                }
            }
        }

        return redirect()->back()
            ->with('message', 'Issue Note Details add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\IssueDetail $issueDetail
     * @return \Illuminate\Http\Response
     */
    public function show(IssueDetail $issueDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\IssueDetail $issueDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(IssueDetail $issueDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\IssueDetail $issueDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueDetail $issueDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\IssueDetail $issueDetail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(IssueDetail $issueDetail)
    {
        $issueDetail->delete();

        $grnDetails = GRNDetail::where('item_id', $issueDetail->item_id)->whereColumn('qty', '>', 'avl_qty')->orderBy('expire_date', 'desc')->first();
        $avlQty = $this->GrnAvailQtyDelete($grnDetails, $issueDetail->qty);
        while ($avlQty > 0) {
            $grnDetails = GRNDetail::where('item_id', $issueDetail->item_id)->whereColumn('qty', '>', 'avl_qty')->orderBy('expire_date', 'desc')->orderBy('expire_date', 'desc')->first();
            $avlQty = $this->GrnAvailQtyDelete($grnDetails, $avlQty);
        }

        $stock = Stock::where('item_id', $issueDetail->item_id);

        $stock->update(['item_id' => $issueDetail->item_id, 'qty' => $stock->first()->qty + $issueDetail->qty, 'last_txn_type' => 'rot']);

        $header = IssueHeader::find($issueDetail->header_id);

        $stockBook = StockBook::where('item_id', $issueDetail->item_id)->where('date', $header->date)->where('quarter', ceil(date('n') / 3));

        if (isset($stockBook->first()->id)) {
            $stockBook->update(['item_id' => $issueDetail->item_id, 'date' => $header->date,
                'quarter' => ceil(date('n') / 3), 'receive_qty' => $stockBook->first()->receive_qty, 'issue_qty' => $stockBook->first()->issue_qty - $issueDetail->qty, 'balance_qty' => $stock->first()->qty]);
        }

        return redirect()->back()
            ->with('message', 'Issue Item deleted successfully');

    }

    public function GrnAvailQty(GRNDetail $grnDeatil, $issuQty)
    {
        if ($grnDeatil->avl_qty > 0) {
            $updateQty = $grnDeatil->avl_qty - $issuQty;
            if ($updateQty >= 0) {
                $grnDeatil->update(['avl_qty' => $updateQty]);
                return 0;
            } else {
                $grnDeatil->update(['avl_qty' => 0]);
                return ($issuQty + $updateQty);
            }
        }
        return $issuQty;
    }

    public function GrnAvailQtyDelete(GRNDetail $grnDeatil, $issuQty)
    {
        $canQty = $grnDeatil->qty - $grnDeatil->avl_qty;

        if ($canQty > $issuQty) {
            $grnDeatil->update(['avl_qty' => $issuQty]);
            return 0;
        } else {
            $grnDeatil->update(['avl_qty' => $grnDeatil->qty]);
            return ($issuQty - $canQty);
        }
    }

}
