<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\GRNDetailsRequest;
use App\Models\Stock\Category;
use App\Models\Stock\GRNDetail;
use App\Models\Stock\GRNHeader;
use App\Models\Stock\Item;
use App\Models\Stock\Stock;
use App\Models\Stock\StockBook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GRNDetailController extends Controller
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
        $establishment_id = GRNHeader::find($header_id)->establishment_id;
        $headerItems = GRNDetail::where('header_id', $header_id)->get();

        $items = Item::with(['measure_unit', 'establishment', 'categories'])->whereHas("categories", function ($q) {
            $q->where('is_bar', 0);
        })->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.gRNDetail.create', compact('header_id', 'items', 'headerItems', 'establishment_id'));
    }

    public function barGRNItem(Request $request)
    {
        $header_id = $request->id;
        $establishment_id = GRNHeader::find($header_id)->establishment_id;
        $categories = Category::where('active', 1)->where('establishment_id', Auth::user()->mess_id)->get();
        $headerItems = GRNDetail::where('header_id', $header_id)->get();

        $barCat = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();
        $items = $barCat->items()->with(['stock', 'establishment'])->get();

        return view('stock.gRNDetail.barCreate', compact('header_id', 'items', 'headerItems', 'establishment_id', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GRNDetailsRequest $request)
    {
        GRNDetail::create(['header_id' => $request->header_id, 'item_id' => $request->item_id, 'active' => 1,
            'creater_id' => Auth::user()->id, 'ip' => $request->ip(), 'expire_date' => $request->expire_date, 'manufacture_date' => $request->manufacture_date, 'qty' => $request->qty, 'avl_qty' => $request->qty, 'unit_price' => $request->unit_price]);

        $stock = Stock::where('item_id', $request->item_id);

        $stock->update(['item_id' => $request->item_id, 'qty' => $stock->first()->qty + $request->qty, 'last_txn_type' => 'in']);

        $header = GRNHeader::find($request->header_id);

        $stockBook = StockBook::where('item_id', $request->item_id)->where('date', $header->date)->where('quarter', ceil(date('n') / 3));

        $balanceQty = StockBook::whereBetween('date', ['0000-00-00', $header->date])->where('item_id', $request->item_id)->select('balance_qty', 'item_id')->orderBy('date', 'desc')->get();
        $thatDayQty = $balanceQty->first()->balance_qty ?? 0;
        $finalQty = $thatDayQty + $request->qty;

        if (isset($stockBook->first()->id)) {
            $stockBook->update(['item_id' => $request->item_id, 'date' => $header->date,
                'quarter' => ceil(date('n') / 3), 'receive_qty' => $stockBook->first()->receive_qty + $request->qty, 'issue_qty' => $stockBook->first()->issue_qty, 'balance_qty' => $finalQty]);
        } else {
            StockBook::create(['item_id' => $request->item_id, 'date' => $header->date,
                'quarter' => ceil(date('n') / 3), 'receive_qty' => $request->qty, 'issue_qty' => 0, 'balance_qty' => $finalQty]);
        }

        $otherGrn = StockBook::whereBetween('date', [$header->date, Carbon::today()->toDateString()])->where('item_id', $request->item_id)->orderBy('date', 'desc')->get();

        if ($otherGrn->count() > 0) {
            foreach ($otherGrn as $balance) {
                if ($stockBook->first()->id != $balance->id) {
                    $thatDayQty = $balance->balance_qty;
                    $finalQty = $thatDayQty + $request->qty;

                    $balance->update(['item_id' => $request->item_id, 'date' => $balance->date,
                        'quarter' => ceil(date('n') / 3), 'receive_qty' => $balance->receive_qty, 'issue_qty' => $balance->issue_qty, 'balance_qty' => $finalQty]);
                }
            }
        }

        return redirect()->back()
            ->with('message', 'GRN Details add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\GRNDetail $gRNDetail
     * @return \Illuminate\Http\Response
     */
    public function show(GRNDetail $gRNDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\GRNDetail $gRNDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(GRNDetail $gRNDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GRNDetail $gRNDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GRNDetail $gRNDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\GRNDetail $gRNDetail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(GRNDetail $gRNDetail)
    {
        $stock = Stock::where('item_id', $gRNDetail->item_id);

        if ($stock->first()->qty - $gRNDetail->qty >= 0) {
            $gRNDetail->delete();

            $stock->update(['item_id' => $gRNDetail->item_id, 'qty' => $stock->first()->qty - $gRNDetail->qty, 'last_txn_type' => 'rin']);

            $header = GRNHeader::find($gRNDetail->header_id);

            $stockBook = StockBook::where('item_id', $gRNDetail->item_id)->where('date', $gRNDetail->date)->where('quarter', ceil(date('n') / 3));

            if (isset($stockBook->first()->id)) {
                $stockBook->update(['item_id' => $gRNDetail->item_id, 'date' => $header->date,
                    'quarter' => ceil(date('n') / 3), 'receive_qty' => $stockBook->first()->receive_qty - $gRNDetail->qty, 'issue_qty' => $stockBook->first()->issue_qty, 'balance_qty' => $stock->first()->qty]);
            }

            return redirect()->back()
                ->with('message', 'GRN Item deleted successfully');
        } else {
            return redirect()->back()
                ->with('message', 'GRN Item not enough qty');
        }
    }
}
