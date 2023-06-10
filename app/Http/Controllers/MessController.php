<?php

namespace App\Http\Controllers;

use App\DataTables\MessesDataTable;
use App\Http\Requests\StoreMessRequest;
use App\Http\Requests\UpdateMessRequest;
use App\Models\Establishments;
use App\Models\Mess;
use App\Models\Stock\Category;
use App\Models\Stock\MeasureUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MessesDataTable $dataTable)
    {
        $establishments = Establishments::all();

        return $dataTable->render('admin.master-data.mess.index', compact('establishments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessRequest $request)
    {

        $validatedData = $request->validated();

        $abbr = Establishments::where('id', $validatedData['estb'])
            ->first('abbr');

        $searchCode = $abbr->abbr;

        $estbCode = Mess::where('abbr', $searchCode)
            ->latest('id', 'code')->first();

        $code = 0;
        $codeAbbr = '';
        if (isset($estbCode->code)) {
            $codeNumber = explode("-", $estbCode->code);

            //SFHQ
            if (isset($codeNumber[2])) {
                $intVal = intval($codeNumber[2]);
                $codeAbbr = $codeNumber[0] . '-' . $codeNumber[1];
            } else {
                $intVal = intval($codeNumber[1]);
                $codeAbbr = $codeNumber[0];
            }


            $code = (sprintf('%03d', $intVal));
            $code++;
            $code = sprintf('%03d', $code);
        } else {
            $codeAbbr = $abbr->abbr;
            $code = sprintf('%03d', 001);
        }

        DB::beginTransaction();
        try {
            $mess = Mess::create([
                'estb' => $validatedData['estb'],
                'name' => $validatedData['name'],
                'location' => $validatedData['location'],
                'abbr' => $searchCode,
                'code' => $codeAbbr . '-' . $code,
                'created_by' => Auth::user()->id,
                'version' => 1
            ]);

            DB::commit();

            $fresh = Category::create(['name' => 'Fresh Ration', 'code' => 'fresh_ration', 'parent_id' => 0, 'is_bar' => 0, 'establishment_id' => $mess->id, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            Category::create(['name' => 'Vegetable', 'code' => 'vegetable', 'parent_id' => $fresh->id, 'is_bar' => 0, 'establishment_id' => $mess->id, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);

            $dry = Category::create(['name' => 'Dry Ration', 'code' => 'dry_ration', 'parent_id' => 0, 'is_bar' => 0, 'establishment_id' => $mess->id, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            Category::create(['name' => 'Rice', 'code' => 'rice', 'parent_id' => $dry->id, 'establishment_id' => $mess->id, 'is_bar' => 0, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);

            $categories = Category::where('id', '>', 0)->where('establishment_id', $mess->id)->pluck('id')->toArray();

            $Liter = MeasureUnit::create(['name' => 'Litter', 'abbreviation' => 'L', 'establishment_id' => $mess->id, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            $Liter->categories()->attach($categories);

            $Kilo = MeasureUnit::create(['name' => 'Killo Gram', 'abbreviation' => 'KG', 'establishment_id' => $mess->id, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            $Kilo->categories()->attach($categories);

            $baritem = Category::create(['name' => 'Bar Item', 'code' => 'bar_item', 'parent_id' => 0, 'is_bar' => 1, 'establishment_id' => $mess->id, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            $liqour = Category::create(['name' => 'Liquor', 'code' => 'liquor', 'parent_id' => $baritem->id, 'is_bar' => 1, 'establishment_id' => $mess->id, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            $bearCat = Category::create(['name' => 'Beer', 'code' => 'beer', 'parent_id' => $liqour->id, 'is_bar' => 1, 'establishment_id' => $mess->id, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            Category::create(['name' => 'Whisky', 'code' => 'whisky', 'parent_id' => $liqour->id, 'establishment_id' => $mess->id, 'active' => 1, 'is_bar' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            Category::create(['name' => 'Canteen', 'code' => 'canteen', 'parent_id' => $baritem->id, 'establishment_id' => $mess->id, 'active' => 1, 'is_bar' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);

            $barCategories = Category::where('parent_id', '=', $baritem->id)->where('establishment_id', $mess->id)->pluck('id')->toArray();
            $LiqourCategories = Category::where('parent_id', '=', $liqour->id)->where('establishment_id', $mess->id)->pluck('id')->toArray();

            $LiterBottel = MeasureUnit::create(['name' => '1 Litter Bottle', 'abbreviation' => '1L Bottle', 'size' => 1000, 'size_type' => 'ml', 'establishment_id' => $mess->id, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            $LiterBottel->categories()->attach($barCategories);
            $LiterBottel->categories()->attach($LiqourCategories);

            $mlBottel = MeasureUnit::create(['name' => '750 Mili Litter Bottle', 'abbreviation' => '750ML Bottle', 'size' => 750, 'size_type' => 'ml', 'establishment_id' => $mess->id, 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            $mlBottel->categories()->attach($barCategories);
            $mlBottel->categories()->attach($LiqourCategories);

            $Tot = MeasureUnit::create(['name' => 'Tot', 'abbreviation' => 'Tot', 'establishment_id' => $mess->id, 'size' => 25, 'size_type' => 'ml', 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            $Tot->categories()->attach($LiqourCategories);

            $Shot = MeasureUnit::create(['name' => 'Shot', 'abbreviation' => 'Shot', 'establishment_id' => $mess->id, 'active' => 1, 'size' => 50, 'size_type' => 'ml', 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            $Shot->categories()->attach($LiqourCategories);

            $beer = MeasureUnit::create(['name' => '1 Beer Bottle', 'abbreviation' => '1 Beer Bottle', 'establishment_id' => $mess->id, 'size' => 675, 'size_type' => 'ml', 'active' => 1, 'creater_id' => Auth::user()->id, 'ip' => $request->ip()]);
            $beer->categories()->attach($bearCat->id);

            return to_route('mess.index')->with('status', 'Mess Created');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Mess $mess
     * @return \Illuminate\Http\Response
     */
    public function show(Mess $mess)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Mess $mess
     * @return \Illuminate\Http\Response
     */
    public function edit(MessesDataTable $dataTable, Mess $mess)
    {
        $establishments = Establishments::all();
        return $dataTable->render('admin.master-data.mess.index', compact('mess', 'establishments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Mess $mess
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessRequest $request, Mess $mess)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {

            Mess::where('id', $mess->id)
                ->update([
                    'name' => $validatedData['name'],
                    'location' => $validatedData['location'],
                    'updated_by' => Auth::user()->id
                ]);

            Mess::where('id', $mess->id)->increment('version', 1);

            DB::commit();
            return to_route('mess.index')->with('status', 'Mess updated');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Mess $mess
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mess $mess)
    {
        Mess::find($mess->id)->delete();
        return to_route('mess.index')->with('status', 'Mess deleted');
    }

    public function establishmentMesses(Request $request)
    {

        $messes = Mess::where('estb', $request->establishmentId)
            ->get(['id', 'name', 'code']);

        return json_encode($messes);
    }

    public function truncateOmms()
    {
        $qry = DB::raw( 'SET FOREIGN_KEY_CHECKS = 0;
        TRUNCATE mess_menu_items;
        SET FOREIGN_KEY_CHECKS = 1');

        dd($qry);
    }
}
