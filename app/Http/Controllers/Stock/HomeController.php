<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Bar;
use App\Models\Mess;
use App\Models\Stock\Category;
use App\Models\Stock\GRNHeader;
use App\Models\Stock\IssueHeader;
use App\Models\Stock\Item;
use App\Models\Stock\MeasureUnit;
use App\Models\Stock\Stock;
use App\Models\Stock\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $estCount = 0;

        $filtered = Item::with(['measure_unit', 'categories', 'stock'])->whereHas("categories", function ($q) {
            $q->where('is_bar', 0);
        })->where('establishment_id', Auth::user()->mess_id);

        $itemArray = $filtered->get();

        $grnCount = GRNHeader::where('establishment_id', Auth::user()->mess_id)->whereYear('date', date('Y'))->where('is_bar', 0)->get()->count();
        $issueCount = IssueHeader::where('establishment_id', Auth::user()->mess_id)->get()->count();

        $itemsCount = $filtered->count();

        $stockCount = $itemsCount;

        $categoryCount = Category::where('establishment_id', Auth::user()->mess_id)->where('is_bar', 0)->get()->count();
        $muCount = MeasureUnit::where('establishment_id', Auth::user()->mess_id)->whereNull('size_type')->get()->count();
        $supCount = Supplier::where('establishment_id', Auth::user()->mess_id)->get()->count();
        $userCount = Admin::where('mess_id', Auth::user()->mess_id)->get()->count();

        $categories = Category::where('parent_id', '=', 0)->where('is_bar', 0)->where('establishment_id', Auth::user()->mess_id)->get();

        return view('stock.home', compact('estCount', 'itemArray', 'userCount', 'supCount', 'categoryCount', 'muCount', 'grnCount', 'issueCount', 'itemsCount', 'stockCount', 'categories'));
    }

    public function changePassword()
    {
        return view('profile');
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

}
