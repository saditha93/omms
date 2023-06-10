<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS => array('username' => 'ajith', 'password' => '12345678'),
            CURLOPT_POSTFIELDS => array('username' => ' ajith', 'password' => '12345678'),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);


        $curlBar = curl_init();
        curl_setopt_array($curlBar, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/items_cats/sc_center/liquor',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$res->authorisation->token
            ),
        ));
        $responseBar = curl_exec($curlBar);
        curl_close($curlBar);
        $barItems = json_decode($responseBar);



        //canteen
        $canteen = curl_init();
        curl_setopt_array($canteen, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/items_cats/sc_center/canteen',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$res->authorisation->token
            ),
        ));

        $canteen_response = curl_exec($canteen);
        curl_close($curl);
        $canteenItems = json_decode($canteen_response);


        return view('admin.master-data.stock.index',compact('barItems','canteenItems'));
    }


    public function addStock()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('username' => ' ajith', 'password' => '12345678'),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);



        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/cat_tree/sc_center/bar',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$res->authorisation->token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $barCategories = json_decode($response);


        //measure unit
        $curlMeasureUnits = curl_init();
        curl_setopt_array($curlMeasureUnits, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/measure_units/sc_center',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$res->authorisation->token
            ),
        ));

        $responseMeasureUnits = curl_exec($curlMeasureUnits);
        curl_close($curlMeasureUnits);
        $measureUnits = json_decode($responseMeasureUnits);

        return view('admin.master-data.stock.create',compact('barCategories','measureUnits'));
    }

    public function getStockCat(Request $request)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS => array('username' => 'ajith', 'password' => '12345678'),
            CURLOPT_POSTFIELDS => array('username' => ' ajith', 'password' => '12345678'),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/cat_tree/sc_center/'.$request->category,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$res->authorisation->token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $categories = json_decode($response);
        return $categories;
    }

    public function getStockSubCat(Request $request)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS => array('username' => 'ajith', 'password' => '12345678'),
            CURLOPT_POSTFIELDS => array('username' => ' ajith', 'password' => '12345678'),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/cat_tree/sc_center/'.$request->sub_category,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$res->authorisation->token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $subcategories = json_decode($response);
        return $subcategories;
    }

    public function saveStockItem(Request $request)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('username' => ' ajith', 'password' => '12345678'),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);


        $passData ='';
        $randomCode = rand(0000,99999999);

        if($request->category)
        {
            $passData = $request->category;
        }
        if($request->sub_category)
        {
            $passData = $request->sub_category;
        }
        if($request->child_category)
        {
            $passData = $request->child_category;
        }


        //save
        $curlSave = curl_init();

        curl_setopt_array($curlSave, array(
            CURLOPT_URL => 'https://172.16.60.28/stock-management/api/item_create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => ''.$request->item_name.'','establishment_code' => 'sc_center','measure_unit_id' => ''.$request->measure_unit.'','item_code' => ''.$randomCode.'','category_code' => ''.$passData.'','active' => '1'),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$res->authorisation->token
            ),
        ));

        $response = curl_exec($curlSave);
        curl_close($curl);

        return $response;
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
