<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\Stock\CategoryBarDataTable;
use App\Http\Controllers\Controller;
use App\Models\Mess;
use App\Models\Stock\Category;
use Illuminate\Http\Request;
use App\DataTables\Stock\CategoryDataTable;
use App\Http\Requests\Stock\CategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:category-list');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        $establishment = Mess::find(Auth::user()->mess_id);
        $categories = Category::where('parent_id', '=', 0)->where('is_bar', 0)->where('establishment_id', Auth::user()->mess_id)->get();
        return $dataTable->render('stock.category.index', compact('categories', 'establishment'));
    }

    public function barIndex(CategoryBarDataTable $dataTable)
    {
        $establishment = Mess::find(Auth::user()->mess_id);
        $categories = Category::where('parent_id', '=', 0)->where('establishment_id', Auth::user()->mess_id)->where('is_bar', 1)->get();
        return $dataTable->render('stock.category.index', compact('categories', 'establishment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $establisments = Mess::all();
        $categories = Category::where('establishment_id', Auth::user()->mess_id)->get();
        return view('stock.category.create', compact('establisments', 'categories'));
    }

    public function barCreate()
    {
        $establisments = Mess::all();
        $categories = Category::where('establishment_id', Auth::user()->mess_id)->get();
        return view('stock.category.barCreate', compact('establisments', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {

        $request->validate(['name' => ['required', 'max:255', Rule::unique('categories')->where(function ($query) use ($request) {
            return $query->where('establishment_id', $request->establishment_id);
        })],]);

        $parentId = 0;
        if (empty($request->child_id) && empty($request->parent_id)) {
            $parentId = $request->category_id;
        } elseif (empty($request->child_id)) {
            $parentId = $request->parent_id;
        } else {
            $parentId = $request->child_id;
        }

        Category::create(['name' => $request->name, 'code' => $request->code, 'is_bar' => 0, 'parent_id' => $parentId, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
        return redirect()->route('stockCategory.index')
            ->with('message', 'Category created successfully.');
    }

    public function barStore(CategoryRequest $request)
    {

        $request->validate(['name' => ['required', 'max:255', Rule::unique('categories')->where(function ($query) use ($request) {
            return $query->where('establishment_id', $request->establishment_id);
        })],]);

        $parentId = 0;
        if (empty($request->child_id) && empty($request->parent_id)) {
            $parentId = $request->category_id;
        } elseif (empty($request->child_id)) {
            $parentId = $request->parent_id;
        } else {
            $parentId = $request->child_id;
        }

        Category::create(['name' => $request->name, 'code' => $request->code, 'is_bar' => 1, 'parent_id' => $parentId, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
        return redirect()->route('barCategory.index')
            ->with('message', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('stock.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {

        $category = Category::find($id);

        $parentCategories = null;
        $subCategories = null;
        $childCategories = null;
        $parentid = 0;
        if (isset($category->id)) {
            $selectcategory = Category::where('parent_id', $category->parent_id)->where('is_bar', 0)->where('id', $category->id)->with(['parent'])->first();
            if (isset($selectcategory->parent()->first()->id) && $selectcategory->parent()->first()->id != 0) {
                $parentid = Category::find($selectcategory->parent()->first()->id)->parent_id;
                $parentCategories = Category::where('parent_id', '=', 0)->where('is_bar', 0)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();

                if (isset($parentid)) {
                    $subCategories = Category::where('parent_id', '=', $parentid)->where('is_bar', 0)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();
                    $childCategories = Category::where('parent_id', '=', $selectcategory->parent()->first()->id)->where('is_bar', 0)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();
                }
            } else {
                $subCategories = Category::where('parent_id', '=', 0)->where('is_bar', 0)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();
            }
        } else {
            $selectcategory = null;
        }

        $establisments = Mess::all();
        return view('stock.category.edit', compact('category', 'establisments', 'selectcategory', 'parentCategories', 'parentid', 'subCategories', 'childCategories'));
    }

    public function baredit($id)
    {

        $category = Category::find($id);

        $parentCategories = null;
        $subCategories = null;
        $childCategories = null;
        $parentid = 0;
        if (isset($category->id)) {
            $selectcategory = Category::where('parent_id', $category->parent_id)->where('is_bar', 1)->where('id', $category->id)->with(['parent'])->first();
            if (isset($selectcategory->parent()->first()->id) && $selectcategory->parent()->first()->id != 0) {
                $parentid = Category::find($selectcategory->parent()->first()->id)->parent_id;
                $parentCategories = Category::where('parent_id', '=', 0)->where('is_bar', 1)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();

                if (isset($parentid)) {
                    $subCategories = Category::where('parent_id', '=', $parentid)->where('is_bar', 1)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();
                    $childCategories = Category::where('parent_id', '=', $selectcategory->parent()->first()->id)->where('is_bar', 1)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id)->get();
                }
            }
        } else {
            $selectcategory = null;
        }

        $establisments = Mess::all();
        return view('stock.category.baredit', compact('category', 'establisments', 'selectcategory', 'parentCategories', 'parentid', 'subCategories', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Stock\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function update(Request $request, $id)
    {

        $category = Category::find($id);

        $request->validate(['name' => ['required', 'max:255', Rule::unique('categories')->where(function ($query) use ($category, $request) {
            return $query->where('establishment_id', $request->establishment_id)->where('id', '!=', $category->id);
        })],]);

        $parentId = 0;
        if (empty($request->child_id) && empty($request->parent_id)) {
            $parentId = $request->category_id;
        } elseif (empty($request->child_id)) {
            $parentId = $request->parent_id;
        } else {
            $parentId = $request->child_id;
        }

        $category->update(['name' => $request->name, 'code' => $request->code, 'parent_id' => $parentId, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->mess_id : $request->establishment_id, 'active' => empty($request->active) ? 0 : $request->active, 'ip' => $request->ip()]);

        if ($category->is_bar == 1) {
            return redirect()->route('barCategory.index')
                ->with('message', 'Category update successfully.');
        } else {
            return redirect()->route('stockCategory.index')
                ->with('message', 'Category update successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy($id)
    {
        $category = Category::find($id);
        $category->measure_units()->detach();
        $category->items()->detach();
        $category->delete();
        if ($category->is_bar == 1) {
            return redirect()->route('barCategory.index')
                ->with('message', 'Category deleted successfully.');
        } else {
            return redirect()->route('stockCategory.index')
                ->with('message', 'Category deleted successfully.');
        }
    }
}
