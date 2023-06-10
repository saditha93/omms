<?php

namespace App\Http\Controllers;

use App\DataTables\MessManagersDataTable;
use App\Models\Admin;
use App\Models\Establishments;
use App\Models\Mess;
use App\Models\UserTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;
use function Ramsey\Uuid\Lazy\toString;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hashs;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use function Yajra\DataTables\Html\Editor\Fields\id;
use Yajra\DataTables\Services\DataTable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->user_type == 1)
        {
            $data = Admin::where('mess_id', Auth::user()->mess_id)
//            ->where('user_type','=<',Auth::user()->user_type)
                ->orderBy('id','DESC')->paginate(10);
        }

        if (Auth::user()->user_type == 2)
        {
            $data = Admin::where('mess_id', Auth::user()->mess_id)
            ->where('user_type','!=',Auth::user()->user_type)
                    ->where('id','!=', Auth::user()->id)
                ->orderBy('id','DESC')->paginate(10);
        }

        if (Auth::user()->user_type == 3)
        {
            $data = Admin::where('mess_id', Auth::user()->mess_id)
            ->where('user_type','=',Auth::user()->user_type)
                ->where('id','!=', Auth::user()->id)
                ->orderBy('id','DESC')->paginate(10);
        }

        return view('admin.master-data.users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('mess_id', Auth::user()->mess_id)
            ->pluck('name','id')->all();

//        dd($roles);
        $messes = Mess::get(['id','name','location']);

//        $userTypes = UserTypes::whereNotIn('id',[1,2])
//            ->get();
        return view('admin.master-data.users.create',compact('roles','messes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        if($request->estb)
//        {
//
//            $this->validate($request, [
//                'name' => 'required',
//                'email' => 'required|email|unique:admins,email',
//                'password' => 'required|same:confirm-password',
//                'estb' => 'required',
//                'mess' => 'required'
//            ]);
//
//            $input = $request->all();
//            $input['password'] = Hash::make($input['password']);
//
//            Admin::create([
//                'name' => $input['name'],
//                'user_type' => 2,
//                'estb' => $input['estb'],
//                'mess_id' => $input['mess'],
//                'active' => $input['active'],
//                'email' => $input['email'],
//                'password' => $input['password'],
//            ]);
//
//
//            return redirect()->route('mess-manager')
//                ->with('status','User created successfully');
//        }
//        else
//        {
//            $this->validate($request, [
//                'name' => 'required',
//                'email' => 'required|email|unique:admins,email',
//                'password' => 'required|same:confirm-password',
//                'roles' => 'required',
//            ]);
//
//            $input = $request->all();
//
//            $input['password'] = Hash::make($input['password']);
//            $input['mess_id'] = Auth::user()->mess_id;
//            $input['estb'] = Auth::user()->estb;
//            $input['user_type'] = 3;
//
//            $user = Admin::create($input);
//            $user->assignRole($request->input('roles'));
//
//            return redirect()->route('users.index')
//                ->with('success','User created successfully');
//        }
//
    }


    public function getSystemUserData(Request $request)
    {
        $roles = Role::where('mess_id', Auth::user()->mess_id)
        ->pluck('name','name')->all();

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
//        $dataCollections->person[0]->eno;
//        $dataCollections->person[0]->service_no;
//        $dataCollections->person[0]->rank;
//        $dataCollections->person[0]->full_name;
//        $dataCollections->person[0]->name_according_to_part2;
//        $dataCollections->person[0]->regiment;
//        $dataCollections->person[0]->unit;
//        $dataCollections->person[0]->nic;


        if (!empty($dataCollections->person[0]->eno))
        {
            return view('admin.master-data.users.create',compact('dataCollections','roles'));
        }
        else
        {
            return redirect()->back()->with('waring','User not found');
        }

    }

    public function saveSystemUserData(Request $request)
    {
        $this->validate($request, [
            'service_number' => 'required',
        ]);

       // $dataCollections = json_decode(Http::withOptions(['verify' => false])->post('https://eportal.army.lk/eportal/api/serach_person_by_no?service_no='.$request->service_number, ['verify' => false]));

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
            return redirect()->route('users.create')->with('waring','User Already Registered');
        }

        $managerPassword = Hash::make($dataCollections->person[0]->eno);



        $input['password'] = $managerPassword;
        $input['email'] = $dataCollections->person[0]->eno;
        $input['active'] = $request->active;
        $input['mess_id'] = Auth::user()->mess_id;
        $input['estb'] = Auth::user()->estb;
        $input['user_type'] = 3;
        $input['name'] =  $dataCollections->person[0]->name_according_to_part2;
        $input['roles'] =  $request->roles;

        $user = Admin::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('status','User Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Admin::find($id);

        $roles = Role::where('mess_id',Auth::user()->mess_id)
        ->pluck('name','id')->all();
        $userRole = $user->roles->pluck('id','name')->all();

//        $userTypes = UserTypes::whereNotIn('id',[1,2])
//            ->get();

        $userMess = Admin::join('messes','messes.id','admins.mess_id')
            ->where('admins.id',$id)
            ->get(['messes.id','messes.name','messes.location']);

//      dd($userMess[0]->id);
        $messes = Mess::all();
        return view('admin.master-data.users.edit',compact('user','roles','userRole','userMess','messes'));
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

        if($request->estb)
        {

            $this->validate($request, [
                'name' => 'required',
                'password' => 'same:confirm-password',
                'estb' => 'required',
                'mess' => 'required'
            ]);

            if(!empty($request['password'])){
                $request['password'] = Hash::make($request['password']);

                Admin::where('id', $id)
                    ->update([
                        'password' => $request['password'],
                    ]);
            }
            Admin::where('id', $id)
                ->update([
                    'name' => $request['name'],
                    'user_type' => 2,
                    'estb' => $request['estb'],
                    'mess_id' => $request['mess'],
                    'active' => $request['active'],
                ]);

            return to_route('mess-manager')->with('status','Menu updated');
        }

        $this->validate($request, [
            'name' => 'required',
//            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = Admin::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function staffDeactivate(Request $request)
    {
        $admin = Admin::where('id',$request->staffId)
        ->update([
            'active' =>0,
            'deactivated_at' => Carbon::today()->toDateString()
        ]);

        return $admin;
    }

    public function activateStaffUser(Request $request)
    {
        $admin = Admin::where('id',$request->staffId)
        ->update([
            'active' =>1,
            'deactivated_at' => null
        ]);

        return $admin;
    }

    public function createMessManager(MessManagersDataTable $dataTable)
    {
        $establishments = Establishments::all();

        return $dataTable->render('admin.master-data.users.mess-manager',compact('establishments'));
    }

//    public function editMessManager(MessManagersDataTable $dataTable, $id)
//    {
//        $admin= Admin::find($id);
//
//        $userEstbbMesses = Mess::where('estb',$admin->estb)->get();
//
//        $establishments = Establishments::all();
//        return $dataTable->render('admin.master-data.users.mess-manager',compact('establishments','admin','userEstbbMesses'));
//    }

    public function getAdmins()
    {

        $admins = Admin::leftJoin('establishments','establishments.id','=','admins.estb')
            ->leftJoin('messes','messes.id','=','admins.mess_id')
            ->where('admins.user_type',2)
            ->where('admins.mess_id','!=','')
            ->where('admins.estb','!=','')
            ->get([
                'admins.id',
                'admins.name',
                'admins.email',
                'admins.active',
                'messes.name as mess_name',
                'establishments.establishment',
                'establishments.establishment',
                'admins.created_at',
                (DB::raw('DATE_FORMAT(admins.created_at, "%d-%b-%Y") as formatted_dob')),
                'admins.deactivated_at',
            ]);

        return DataTables::of($admins)
            ->addIndexColumn()
//            ->addColumn('action', function ($row) {
//
//                $btnEdit = '<a class="btn btn-sm btn-warning" href="'.route('ration.edit',$row->id ).'">Edit</a>';
//                $btnDelete ='<form method="POST" action="' . route('ration.destroy', $row->id) . '" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
//                             ' . csrf_field() . '
//                             ' . method_field('DELETE') . '
//                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
//                        </form>';
//                return $btnEdit.' '.$btnDelete;
//            })
//            ->rawColumns(['action'])
            ->setRowId('id')
            ->make(true);
    }

    public function adminPassword()
    {
        $adminInfo = Admin::leftJoin('messes','messes.id','=','admins.mess_id')
            ->where('admins.id',Auth::user()->id)
            ->get(['admins.name','admins.email','messes.name as messName']);

        if (Auth::user()->user_type ==1)
        {
            $admins = Admin::join('messes','messes.id','admins.mess_id')
                ->join('establishments','establishments.id','admins.estb')
                ->where('admins.user_type',2)
                ->get(['admins.id','admins.name','establishments.abbr','messes.name as messName']);
        }
        elseif (Auth::user()->user_type ==2)
        {
            $admins = Admin::join('messes','messes.id','admins.mess_id')
                ->join('establishments','establishments.id','admins.estb')
                ->whereIn('admins.user_type',[2,3])
                ->where('admins.id','!=', Auth::user()->id)
                ->where('mess_id',Auth::user()->mess_id)
                ->get(['admins.id','admins.name','establishments.abbr','messes.name as messName']);
        }
        else
        {
            $admins = null;
        }


        return view('admin.master-data.users.admin_password_change',compact('adminInfo','admins'));
    }

    public function resetAdminPassword(Request $request)
    {

        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'confirm_password' => 'required|same:new_password'
        ]);

        $newHashedPassword = Hash::make($request['new_password']);

        $dbPassword = Admin::where('id',Auth::user()->id)
            ->get('password');


        if (Hash::check($request['current_password'], $dbPassword[0]['password'])) {

            Admin::where('id', Auth::user()->id)
                ->update([
                    'password' => $newHashedPassword,
                ]);
            return to_route('admin-password')->with('status', 'Password Changed. Log with your new password');
        }
        else
        {
            return to_route('admin-password')->with('waring', 'Current password mismatch');
        }

    }

    public function resetSystemAdminsPassword(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
            'reset_new_password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'reset_confirm_password' => 'required|same:reset_new_password'
        ]);

        $newHashedPassword = Hash::make($request['reset_new_password']);

        Admin::where('id', $request->user)
            ->update([
                'password' => $newHashedPassword,
            ]);

        return to_route('admin-password')->with('status', 'Password reset');
    }




}
