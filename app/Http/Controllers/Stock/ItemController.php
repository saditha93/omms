<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\Stock\ItemsBarDataTable;
use App\DataTables\Stock\ItemsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\ItemRequest;
use App\Models\Mess;
use App\Models\Stock\Category;
use App\Models\Stock\Item;
use App\Models\Stock\MeasureUnit;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:item-list');
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categories = Category::where('active', '=', 1)->where('parent_id', 0)->where('establishment_id', Auth::user()->mess_id)->get();

        if ($request->ajax()) {

            if (isset($request->category)) {
                $Cat = Category::find($request->category);
                if ($Cat->items()->count() > 0) {
                    $items = $Cat->items()->with(['categories', 'measure_unit',])->get()->toQuery()->with(['measure_unit']);
                }else {
                    $items = Item::with(['measure_unit', 'categories'])->whereHas("categories", function ($q) {
                        $q->where('is_bar', 0);
                    })->where('establishment_id', Auth::user()->mess_id);
                }
            } else {
                $items = Item::with(['measure_unit', 'categories'])->whereHas("categories", function ($q) {
                    $q->where('is_bar', 0);
                })->where('establishment_id', Auth::user()->mess_id);
            }

            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('index', function ($row) {
                    static $i = 1;
                    return $i++;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search')) && isset($request->get('search')['value'])) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search')['value'];
                            $w->orWhere('name', 'LIKE', "%$search%")
                                ->orWhere('code', 'LIKE', "%$search%");
                        });
                    }
                })
                ->editColumn('categories', function ($item) {
                    $categoryName = [];
                    foreach ($item->categories()->get() as $category) {
                        $categoryName[] = $category->name;
                    }
                    return implode(", ", $categoryName);
                })->editColumn('active', function ($item) {
                    if ($item->active == 1) {
                        return '<mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">active</mark>';
                    } else {
                        return '<mark class="px-2 text-white bg-danger rounded dark:bg-danger">deactivate</mark>';
                    }
                })
                ->addColumn('action', function ($item) {
                    return '<div class="w-80"></div><a href="' . route('stockItem.show', $item->id) . '" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="bottom" title="Item Details"><i class="fa fa-eye"></i></a>
                <a href="' . route('stockItem.edit', $item->id) . '" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="bottom" title="Item Edit"><i class="fa fa-pen"></i></a>
                <form  action="' . route('stockItem.destroy', $item->id) . '" method="POST" class="d-inline" >
               ' . csrf_field() . '
                   ' . method_field("DELETE") . '
               <button type="submit"  class="btn bg-danger btn-xs  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700" onclick="return confirm(\'Do you need to delete this\');" data-toggle="tooltip" data-placement="bottom" title="Item Delete">
               <i class="fa fa-trash-alt"></i></button>
               </form> </div>';
                })->rawColumns(['active', 'action'])
                ->make(true);

        }
        return view('stock.item.index', compact('categories'));
    }

    public function allBarItem(ItemsBarDataTable $dataTable)
    {
        return $dataTable->render('stock.item.indexDefault');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $establisments = Mess::all();
        $categories = Category::where('active', 1)->get();
        $measureUnits = MeasureUnit::where('active', 1)->whereNull('size_type')->get();
        return view('stock.item.create', compact('categories', 'measureUnits', 'establisments'));
    }

    public function barItemCreate()
    {
        $establisments = Mess::all();
        $categories = Category::where('active', 1)->where('establishment_id', Auth::user()->mess_id)->get();
        $measureUnits = MeasureUnit::where('active', 1)->where('establishment_id', Auth::user()->mess_id)->whereNotNull('size_type')->get();
        return view('stock.item.bar_create', compact('categories', 'measureUnits', 'establisments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ItemRequest $request)
    {
        $request->validate(['name' => ['required', 'max:255', Rule::unique('items')->where(function ($query) use ($request) {
            return $query->where('establishment_id', $request->establishment_id);
        })],]);

        $item = Item::create(['name' => $request->name, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'code' => $request->code,
            'measure_unit_id' => $request->measure_unit_id, 'latest_user_tbl_id' => Auth::user()->id, 'latest_ip' => $request->ip(), 'active' => empty($request->active) ? 0 : $request->active]);

        $categories = [];
        if (isset($request->category_id)) {
            $categories[] = $request->category_id;
        }
        if (isset($request->parent_id)) {
            $categories[] = $request->parent_id;
        }
        if (isset($request->child_id)) {
            $categories[] = $request->child_id;
        }
        if (isset($request->sub_child_id)) {
            $categories[] = $request->sub_child_id;
        }
        $item->categories()->attach($categories);

        Stock::create(['item_id' => $item->id, 'qty' => 0, 'last_txn_type' => 'in']);
        return redirect()->route('stockItem.index')
            ->with('message', 'Item created successfully.');
    }

    public function barstore(ItemRequest $request)
    {
        $request->validate(['name' => ['required', 'max:255', Rule::unique('items')->where(function ($query) use ($request) {
            return $query->where('establishment_id', $request->establishment_id);
        })],]);

        $item = Item::create(['name' => $request->name, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'code' => $request->code,
            'measure_unit_id' => $request->measure_unit_id, 'latest_user_tbl_id' => Auth::user()->id, 'latest_ip' => $request->ip(), 'active' => empty($request->active) ? 0 : $request->active]);

        $categories = [];
        if (isset($request->category_id)) {
            $categories[] = $request->category_id;
        }
        if (isset($request->parent_id)) {
            $categories[] = $request->parent_id;
        }
        if (isset($request->child_id)) {
            $categories[] = $request->child_id;
        }
        if (isset($request->sub_child_id)) {
            $categories[] = $request->sub_child_id;
        }
        $item->categories()->attach($categories);

        Stock::create(['item_id' => $item->id, 'qty' => 0, 'last_txn_type' => 'in']);
        return redirect()->route('bar.allBarItem')
            ->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {

        $item = Item::find($id);

        $categories = [];
        foreach ($item->categories()->get() as $category) {
            $categories[] = $category->name;
        }
        $categoryName = implode(", ", $categories);

        return view('stock.item.show', compact('item', 'categoryName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {

        $item = Item::find($id);

        $establisments = Mess::all();
        $categories = Category::where('active', 1)->get();

        $parentCategories = null;
        $subCategories = null;
        $childCategories = null;
        $subchildCategories = null;

        $parentid = 0;
        $subCategory = null;
        $childCategory = null;
        $subchildCategory = null;

        $hasCategory = $item->categories()->get();
        $parentCategories = Category::where('parent_id', '=', 0)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();

        if ($hasCategory->count() > 0) {
            $parentid = $parentCategories->intersect($hasCategory)->first()->id;

            if ($parentid !== 0) {
                $subCategories = Category::where('parent_id', '=', $parentid)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();
                $subCategory = $subCategories->intersect($hasCategory)->first();
                if (isset($subCategory)) {
                    $childCategories = Category::where('parent_id', '=', $subCategory->id)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();
                    $childCategory = $childCategories->intersect($hasCategory)->first();
                    if (isset($childCategory)) {
                        $subchildCategories = Category::where('parent_id', '=', $childCategory->id)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();
                        $subchildCategory = $subchildCategories->intersect($hasCategory)->first();
                    }
                }
            }

        }

        $measureUnits = MeasureUnit::where('active', 1)->where('establishment_id', $item->establishment_id)->get();
        return view('stock.item.edit', compact('item', 'categories', 'measureUnits', 'subchildCategories', 'subchildCategory', 'establisments', 'parentCategories', 'subCategories', 'childCategory', 'childCategories', 'parentid', 'subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ItemRequest $request, $id)
    {

        $item = Item::find($id);

//        $request->validate(['name' => 'required|unique:items,name,establishment_id']);

        $request->validate(['name' => ['required', 'max:255', Rule::unique('items')->where(function ($query) use ($item, $request) {
            return $query->where('establishment_id', $request->establishment_id)->where('id', '!=', $item->id);
        })],]);

        $item->update(['name' => $request->name, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'code' => $request->code,
            'measure_unit_id' => $request->measure_unit_id, 'latest_user_tbl_id' => Auth::user()->id, 'latest_ip' => $request->ip(), 'active' => empty($request->active) ? 0 : $request->active]);


        $categories = [];
        if (isset($request->category_id)) {
            $categories[] = $request->category_id;
        }
        if (isset($request->parent_id)) {
            $categories[] = $request->parent_id;
        }
        if (isset($request->child_id)) {
            $categories[] = $request->child_id;
        }
        if (isset($request->sub_child_id)) {
            $categories[] = $request->sub_child_id;
        }


        $item->categories()->sync($categories);

        if (isset($request->category_id)) {
            $barCat = Category::find($request->category_id);
            if ($barCat->code == 'bar_item') {
                return redirect()->route('bar.allBarItem')
                    ->with('message', 'Bar Item update successfully.');
            }
        }
        return redirect()->route('stockItem.index')
            ->with('message', 'Item update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $barCat = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first()->items()->get();
        if ($barCat->contains('id', $id)) {
            $item = Item::find($id);
            $item->categories()->detach();
            $item->delete();
            return redirect()->route('bar.allBarItem')
                ->with('message', 'Item deleted successfully');
        } else {
            $item = Item::find($id);
            $item->categories()->detach();
            $item->delete();
            return redirect()->route('stockItem.index')
                ->with('message', 'Item deleted successfully');
        }
    }
}
