<?php

namespace App\Http\Controllers;

use App\DataTables\MessManagersDataTable;
use App\Models\Admin;
use App\Models\Establishments;
use App\Models\OfficersAssigns;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class OfficerAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $officers = User::join('officers_assigns','officers_assigns.enum','=','users.email')
//            ->where('officers_assigns.status',1)
            ->where('officers_assigns.mess_id',Auth::user()->mess_id)
            ->get(['users.name_according_to_part2','users.rank','users.email','users.regiment','users.unit','users.service_no',
                'officers_assigns.assigned_date','officers_assigns.deactivated_date','officers_assigns.status','officers_assigns.id']);

       return view('admin.master-data.users.officer-accounts', compact('officers'));
    }

    public function getOfficerData(Request $request)
    {


        $this->validate($request, [
            'officer_number' => 'required',
        ]);

        if(!(Str::contains($request->officer_number, 'o/') || Str::contains($request->officer_number, 'O/'))) {
            return redirect()->route('officer.index')->with('waring','Only Officer numbers are allowed');
        }

//        $dataCollections = json_decode(Http::withOptions(['verify' => false])->post('https://eportal.army.lk/eportal/api/serach_person_by_no?service_no='.$request->officer_number, ['verify' => false]));
//        $dataCollections = json_decode(Http::withOptions(['verify' => false])->post('https://172.16.60.28/eportal/api/serach_person_by_no?service_no='.$request->officer_number));
//        $dataCollections = json_decode(Http::post('http://172.16.66.14/eportal/api/serach_person_by_no?service_no='.$request->officer_number));




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

//        $dataCollections->person[0]->eno;
//        $dataCollections->person[0]->service_no;
//        $dataCollections->person[0]->rank;
//        $dataCollections->person[0]->full_name;
//        $dataCollections->person[0]->name_according_to_part2;
//        $dataCollections->person[0]->regiment;
//        $dataCollections->person[0]->unit;
//        $dataCollections->person[0]->nic;

        if(isset($dataCollections->person[0]->eno))
        {
            $userRegMess = User::join('officers_assigns','officers_assigns.enum','=','users.email')
                ->join('messes','messes.id','=','officers_assigns.mess_id')
                ->join('establishments','establishments.id','=','messes.estb')
                ->where('users.email',$dataCollections->person[0]->eno)
                ->groupBy('messes.name','establishments.establishment')
                ->get(['messes.name','establishments.establishment']);
        }


        if (!empty($dataCollections->person[0]->eno))
        {
            return view('admin.master-data.users.officer-accounts',compact('dataCollections','userRegMess'));
        }
        else
        {
            return redirect()->route('officer.index')->with('waring','User not found');
        }

    }


    public function saveOfficerData(Request $request)
    {


        $this->validate($request, [
            'service_number' => 'required',
        ]);

//        $dataCollections = json_decode(Http::withOptions(['verify' => false])->post('https://eportal.army.lk/eportal/api/serach_person_by_no?service_no='.$request->service_number, ['verify' => false]));


        //API NEW
        // Set the API endpoint URL
        $resource_url = 'https://eportal.army.lk/eportal/api/serach_person_by_no?service_no='.$request->service_number.'&api_key=44616e6a4030323231';

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


        $dataCollections->person[0]->eno;
        $dataCollections->person[0]->service_no;
        $dataCollections->person[0]->rank;
        $dataCollections->person[0]->full_name;
        $dataCollections->person[0]->name_according_to_part2;
        $dataCollections->person[0]->regiment;
        $dataCollections->person[0]->unit;
        $dataCollections->person[0]->nic;



        $userExist= User::where('users.email',$dataCollections->person[0]->eno)
            ->get();

        if ((isset($userExist[0]['service_no'])))
        {


            $userExistInMess = User::join('officers_assigns','officers_assigns.enum','=','users.email')
                ->where('users.email',$dataCollections->person[0]->eno)
                ->where('officers_assigns.mess_id',Auth::user()->mess_id)
                ->get();

            if((isset($userExistInMess[0]['service_no'])) && (isset($userExistInMess[0]['mess_id'])) )
            {
                return redirect()->route('officer.index')->with('waring','User already assigned to the mess');
            }
            else
            {
                User::where('email', $dataCollections->person[0]->eno)
                    ->update([
                    'rank' => $dataCollections->person[0]->rank,
                    'regiment' => $dataCollections->person[0]->regiment,
                    'unit' => $dataCollections->person[0]->unit,
                ]);

                OfficersAssigns::create([
                    'enum' => $dataCollections->person[0]->eno,
                    'mess_id' => Auth::user()->mess_id,
                    'status' => 1,
                    'assigned_date' => Carbon::today()->toDateString(),
                    'assigned_by' => Auth::user()->id,
                ]);

                return redirect()->route('officer.index')->with('status','User assigned to the mess');
            }

        }
        else
        {
                $tempPassword = Hash::make($dataCollections->person[0]->service_no);

                User::create([
                    'name' => $dataCollections->person[0]->name_according_to_part2,
                    'email' => $dataCollections->person[0]->eno,
                    'service_no' => $dataCollections->person[0]->service_no,
                    'rank' => $dataCollections->person[0]->rank,
                    'full_name' => $dataCollections->person[0]->full_name,
                    'name_according_to_part2' => $dataCollections->person[0]->name_according_to_part2,
                    'regiment' => $dataCollections->person[0]->regiment,
                    'unit' => $dataCollections->person[0]->unit,
                    'nic' => $dataCollections->person[0]->nic,
                    'password' => $tempPassword,
                ]);

                OfficersAssigns::create([
                    'enum' => $dataCollections->person[0]->eno,
                    'mess_id' => Auth::user()->mess_id,
                    'status' => 1,
                    'assigned_date' => Carbon::today()->toDateString(),
                    'assigned_by' => Auth::user()->id,
                ]);

            return redirect()->route('officer.index')->with('status','User assigned to the mess');

        }




    }




    public function getMessMangerData(Request $request)
    {
        $this->validate($request, [
            'officer_number' => 'required',
        ]);

        if(!(Str::contains($request->officer_number, 'o/') || Str::contains($request->officer_number, 'O/'))) {
            return redirect()->route('mess-manager')->with('waring','Only Officer numbers are allowed');
        }

        try{
//            $dataCollections = json_decode(Http::post('http://172.16.60.28/eportal/api/serach_person_by_no?service_no='.$request->officer_number));
            //$dataCollections = json_decode(Http::withOptions(['verify' => false])->post('https://172.16.60.28/eportal/api/serach_person_by_no?service_no='.$request->officer_number, ['verify' => false]));
//          $dataCollections = json_decode(Http::post('https://eportal.army.lk/eportal/api/serach_person_by_no?service_no='.$request->officer_number));

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



            $establishments = Establishments::all();


            if (!empty($dataCollections->person[0]->eno))
            {
                return view('admin.master-data.users.mess-manager',compact('establishments','dataCollections'));
            }
            else
            {
                return redirect()->route('mess-manager')->with('waring','User not found');
            }

        }
        catch (\Error $exception)
        {
            return redirect()->route('mess-manager')->with('waring','Network Error');
        }

//
    }


    public function saveMessManagerData(Request $request)
    {
        $this->validate($request, [
            'service_number' => 'required',
            'mess' => 'required',
            'estb' => 'required',
        ]);



//        $dataCollections = json_decode(Http::withOptions(['verify' => false])->post('https://172.16.60.28/eportal/api/serach_person_by_no?service_no='.$request->service_number, ['verify' => false]));
        //$dataCollections = json_decode(Http::withOptions(['verify' => false])->post('https://eportal.army.lk/eportal/api/serach_person_by_no?service_no='.$request->service_number, ['verify' => false]));

        //API NEW
        // Set the API endpoint URL
        $resource_url = 'https://eportal.army.lk/eportal/api/serach_person_by_no?service_no='.$request->service_number.'&api_key=44616e6a4030323231';

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


        $dataCollections->person[0]->eno;
        $dataCollections->person[0]->service_no;
        $dataCollections->person[0]->rank;
        $dataCollections->person[0]->full_name;
        $dataCollections->person[0]->name_according_to_part2;
        $dataCollections->person[0]->regiment;
        $dataCollections->person[0]->unit;
        $dataCollections->person[0]->nic;


        $available = Admin::where('email',$dataCollections->person[0]->eno)
            ->count();

        if ($available == 1)
        {
            return redirect()->route('mess-manager')->with('waring','User Already Registered');
        }


            $managerPassword = Hash::make($dataCollections->person[0]->eno);

        Admin::create([
            'name' => $dataCollections->person[0]->name_according_to_part2,
            'user_type' => 2,
            'estb' => $request->estb,
            'mess_id' => $request->mess,
            'active' => $request->active,
            'email' => $dataCollections->person[0]->eno,
            'password' => $managerPassword,
        ]);

        return redirect()->route('mess-manager')->with('status','Mess Manager Created');
    }


    public function userInactive(Request $request)
    {
        $query = OfficersAssigns::where('id',$request->userId)
            ->where('mess_id',Auth::user()->mess_id)
            ->update([
                'status' => 0,
                'deactivated_date' => Carbon::today()->toDateString(),
                'deactivated_by' => Auth::user()->id
            ]);

        return $query;
    }

    public function userActive(Request $request)
    {
        $query = OfficersAssigns::where('id',$request->userId)
            ->where('mess_id',Auth::user()->mess_id)
            ->update([
                'status' => 1,
                'deactivated_date' => '',
                'deactivated_by' => ''
            ]);

        return $query;
    }


    public function deactivateMessManager(Request $request)
    {

        Admin::where('id',$request->messManagerId)
            ->update([
                'active' => 0,
                'deactivated_at' => Carbon::today()->toDateString()
            ]);
        return to_route('mess-manager')->with('status', 'User de-activated');
    }

    public function reActivateMessManager(Request $request)
    {
        Admin::where('id',$request->messManagerId)
            ->update([
                'active' => 1,
                'deactivated_at' => null
            ]);
        return to_route('mess-manager')->with('status', 'User activated');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function saveOfficerDataBulk(Request $request)
    {

        $numbes= [];




        foreach ($numbes as $number)
        {





        $resource_url = 'https://eportal.army.lk/eportal/api/serach_person_by_no?service_no='.$number.'&api_key=44616e6a4030323231';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $resource_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            // Handle the error
            echo $error_msg;
        }

        curl_close($ch);

        $dataCollections = json_decode($response);

        if (isset($dataCollections->person[0]->eno))
        {


        $dataCollections->person[0]->eno;
        $dataCollections->person[0]->service_no;
        $dataCollections->person[0]->rank;
        $dataCollections->person[0]->full_name;
        $dataCollections->person[0]->name_according_to_part2;
        $dataCollections->person[0]->regiment;
        $dataCollections->person[0]->unit;
        $dataCollections->person[0]->nic;




            $userExist= User::where('users.email',$dataCollections->person[0]->eno)
                ->get();

            if ((isset($userExist[0]['service_no']))) {

                continue;

            }
            else
            {
                $tempPassword = Hash::make($dataCollections->person[0]->service_no);
                User::create([
                    'name' => $dataCollections->person[0]->name_according_to_part2,
                    'email' => $dataCollections->person[0]->eno,
                    'service_no' => $dataCollections->person[0]->service_no,
                    'rank' => $dataCollections->person[0]->rank,
                    'full_name' => $dataCollections->person[0]->full_name,
                    'name_according_to_part2' => $dataCollections->person[0]->name_according_to_part2,
                    'regiment' => $dataCollections->person[0]->regiment,
                    'unit' => $dataCollections->person[0]->unit,
                    'nic' => $dataCollections->person[0]->nic,
                    'password' => $tempPassword,
                ]);
                OfficersAssigns::create([
                    'enum' => $dataCollections->person[0]->eno,
                    'mess_id' => Auth::user()->mess_id,
                    'status' => 1,
                    'assigned_date' => Carbon::today()->toDateString(),
                    'assigned_by' => Auth::user()->id,
                ]);
            }

        }
        else
        {
            continue;
        }
        }

    }


    public function updateOfficerDataBulk(Request $request)
    {

        $ids = User::where('regiment','!=','SLSC')
            ->get('email');

        foreach ($ids as $id)
        {

                OfficersAssigns::where('email', $id)
                    ->update([
                        'mess_id' => 2,
                    ]);
        }
    }
}
