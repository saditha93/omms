<?php

namespace App\Http\Controllers;

use App\DataTables\EStablishmentsDataTable;
use App\Http\Requests\StoreAhqEstbUserRequest;
use App\Http\Requests\StoreEstablishmentRequest;
use App\Http\Requests\StoreMessRequest;
use App\Models\Admin;
use App\Models\AhqEstablishments;
use App\Models\AhqEstablishmentUsers;
use App\Models\Establishments;
use App\Models\EventOrders;
use App\Models\Mess;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class EstablishmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EStablishmentsDataTable $dataTable)
    {
        return $dataTable->render('admin.master-data.establishment.index');
    }

    public function establishmentUser()
    {
        $establishments = AhqEstablishments::all();

        $establishmentsUsers = AhqEstablishmentUsers::join('admins','admins.id','=','ahq_establishment_users.admin_id')
            ->join('ahq_establishments','ahq_establishments.id','=','ahq_establishment_users.ahq_establishment_id')
            ->get(['ahq_establishments.ahq_establishment','ahq_establishments.abreviation',
                'ahq_establishment_users.name_accdng_to_part_2','ahq_establishment_users.id','ahq_establishment_users.regiment','ahq_establishment_users.rank','ahq_establishment_users.unit',
                'admins.name']);

        return view('admin.master-data.establishment.establishment_users',compact('establishments','establishmentsUsers'));
    }

    public function eventOrder()
    {
        $eventOrders = EventOrders::where('ahq_estb',Auth::user()->ahq_estb)
            ->get();

        return view('admin.master-data.establishment.event_orders',compact('eventOrders'));
    }

    public function viewEventOrder()
    {

        $eventOrders = EventOrders::join('ahq_establishments','ahq_establishments.id','=','event_orders.ahq_estb')
        ->get(['event_orders.id','ahq_establishments.ahq_establishment','event_orders.event_name','event_orders.event_date','event_orders.status']);

        return view('admin.master-data.establishment.view_event_orders',compact('eventOrders'));
    }

    public function ahqEstablishment()
    {

        $ahqEstablishments = AhqEstablishments::all();

        return view('admin.master-data.establishment.ahq_establishment',compact('ahqEstablishments'));
    }

    public function saveAhqEstablishment(Request $request)
    {
        $this->validate($request, [
            'establishment' => 'required|unique:ahq_establishments,ahq_establishment',
            'abbr' => 'required|unique:ahq_establishments,abreviation',
        ]);

       AhqEstablishments::create([
            'ahq_establishment' => $request->establishment,
            'abreviation' => $request->abbr,
            'created_by' => Auth::user()->id,
       ]);

        return redirect()->route('ahq-establishment')
            ->with('status','Establishment saved successfully');
    }

    public function editAhqEstablishment(Request $request, $id)
    {
        $ahqEstb = AhqEstablishments::where('id',$id)
        ->get();

        $ahqEstablishments = AhqEstablishments::all();

        return view('admin.master-data.establishment.ahq_establishment',compact('ahqEstablishments','ahqEstb'));
    }

    public function updateAhqEstablishment(Request $request, $id)
    {

        AhqEstablishments::where('id', $id)
        ->update([
            'ahq_establishment' => $request->establishment,
            'abreviation' => $request->abbr,
            'updated_by' => Auth::user()->id
        ]);

        return redirect()->route('ahq-establishment')
            ->with('status','Establishment updated successfully');
    }

    public function getOfficerToEstablishment(Request $request)
    {


        if(!(Str::contains($request->officer_number, 'o/') || Str::contains($request->officer_number, 'O/'))) {

            $error = "Only officers numbers are allowed";
            return $error;
        }


        $establishments = AhqEstablishments::all();

        try
        {
            //$dataCollections = json_decode(Http::withOptions(['verify' => false])->post('https://eportal.army.lk/eportal/api/serach_person_by_no?service_no='.$request->officer_number, ['verify' => false]));

//API NEW
            // Set the API endpoint URL
            $resource_url = 'https://eportal.army.lk/eportal/api/serach_person_by_no?service_no='.$request->officer_number.'&api_key=44616e6a4030323231';

// Set the bearer token
            //$token = 'qqqeyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2Vwb3J0YWwuYXJteS5say9lcG9ydGFsL2FwaS9sb2dpbiIsImlhdCI6MTY3NzIzNjQxOSwiZXhwIjoxNjc3MjQwMDE5LCJuYmYiOjE2NzcyMzY0MTksImp0aSI6IklCNUt1eHg1alFMd3dDYjIiLCJzdWIiOiIxMTAzNjQiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.CtB_m1IdFLgqUc-GZ0PSz0UUVaqDT7SzZYbZmF3nzG8';

// Initialize the cURL session
            $ch = curl_init();

// Set the cURL options
            curl_setopt($ch, CURLOPT_URL, $resource_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            //        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //            'Authorization: Bearer '.$token
            //        ));

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


            // Execute the cURL request and get the response
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
                // Handle the error
                dd($error_msg);
            }

            // Close the cURL session
            curl_close($ch);

            $dataCollections = json_decode($response);
//END API NEW
        }
        catch (\Exception $e)
        {
            $error = "Network Error";
            return $error;

        }


        if (!empty($dataCollections->person[0]->eno))
        {
            return $dataCollections;
        }
        else
        {
            $error = "Officer number not found";
            return $error;
        }

    }

    public function addOfficerToAhqEstb(Request $request)
    {


        $this->validate($request, [
            'establishment' => 'required',
            'username' => 'required|unique:admins,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'nic' => 'required',
            'e_number' => 'required',
            'full_name' => 'required',
            'service_number' => 'required',
            'rank' => 'required',
            'name_acco_part2' => 'required',
            'regiment' => 'required',
            'unit' => 'required',
        ]);

        $request['password'] = Hash::make($request['password']);

        $admin = Admin::create([
            'name' => $request->username,
            'email' => $request->username,
            'user_type' => 4,
            'ahq_estb' => $request->establishment,
            'active' => 1,
            'password' => $request->password,
        ]);


        AhqEstablishmentUsers::create([
            'admin_id'=> $admin->id,
            'ahq_establishment_id'=> $request->establishment,
            'e_number'=> $request->e_number,
            'full_name'=> $request->full_name,
            'name_accdng_to_part_2'=> $request->name_acco_part2,
            'service_no'=> $request->service_number,
            'rank'=> $request->rank,
            'regiment'=> $request->regiment,
            'unit'=> $request->unit,
            'nic'=> $request->nic,
        ]);

        $establishments = AhqEstablishments::all();
        $establishmentsUsers = AhqEstablishmentUsers::join('admins','admins.id','=','ahq_establishment_users.admin_id')
        ->join('ahq_establishments','ahq_establishments.id','=','ahq_establishment_users.ahq_establishment_id')
        ->get('ahq_establishments.ahq_establishment','ahq_establishments.abreviation',
            'ahq_establishment_users.name_accdng_to_part_2','ahq_establishment_users.id','ahq_establishment_users.regiment','ahq_establishment_users.rank',
            'admins.name');

        return redirect()->route('establishment-user',compact('establishments','establishmentsUsers'))->with('status','AHQ user created');

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
    public function store(StoreEstablishmentRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {

            Establishments::create([

                'establishment' => $validatedData['establishment'],
                'abbr' => $validatedData['abbr'],
                'created_by' => Auth::user()->id,
                'version' => 1
            ]);

            DB::commit();
            return to_route('establishment.index')->with('status', 'Establishment Created');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Establishments  $establishments
     * @return \Illuminate\Http\Response
     */
    public function show(Establishments $establishments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Establishments  $establishments
     * @return \Illuminate\Http\Response
     */
    public function edit(EStablishmentsDataTable $dataTable, Establishments $establishment)
    {
        return $dataTable->render('admin.master-data.establishment.index',compact('establishment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establishments  $establishments
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEstablishmentRequest $request, Establishments $establishment)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try{

            Establishments::where('id', $establishment->id)
                ->update([
                    'establishment' => $validatedData['establishment'],
                    'abbr' => $validatedData['abbr'],
                    'updated_by' => Auth::user()->id
                ]);

            Establishments::where('id',$establishment->id)->increment('version', 1);

            DB::commit();
            return to_route('establishment.index')->with('status','Establishment updated');
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establishments  $establishments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establishments $establishment)
    {
        Establishments::find($establishment->id)->delete();
        return to_route('establishment.index')->with('status','Establishment deleted');
    }

    public function establishmentCode(Request $request)
    {
        $abbr = Establishments::where('id',$request->establishmentId)
            ->first('abbr');

        $searchCode = $abbr->abbr;

        $estbCode = Mess::where('abbr', $searchCode)
            ->latest('id','code')->first();

        $code = 0;
        $codeAbbr ='';
        if(isset($estbCode->code))
        {

            $codeNumber = explode("-",$estbCode->code);

            //SFHQ
            if(isset($codeNumber[2]))
            {
                $intVal = intval( $codeNumber[2]);
                $codeAbbr = $codeNumber[0].'-'.$codeNumber[1];
            }
            else
            {
                $intVal = intval( $codeNumber[1]);
                $codeAbbr = $codeNumber[0];
            }



            $code = (sprintf('%03d', $intVal));
            $code++;
            $code = sprintf('%03d', $code);
        }
        else
        {
            $codeAbbr = $abbr->abbr;
            $code = sprintf('%03d', 001);
        }

        return json_encode($codeAbbr.'-'.$code);
    }
}
