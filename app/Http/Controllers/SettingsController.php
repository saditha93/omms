<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\LogoImage;
use App\Models\MealOrderTime;
use App\Models\MessDailyRations;
use Carbon\Carbon;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.master-data.settings.index');
    }

    public function storeLogo(Request $request)
    {
        $this->validate($request, [
            'logo_img' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);


        $establishment = Admin::join('establishments', 'establishments.id', 'admins.estb')
            ->where('admins.id', Auth::user()->id)
            ->get(['establishments.abbr', 'admins.mess_id']);


        $file = $request->File('logo_img');

        $fileName = $establishment[0]->abbr . '_' . $establishment[0]->mess_id . '.' . $file->getClientOriginalExtension();

        $filePath = $establishment[0]->abbr . '/' . $establishment[0]->mess_id . '/' . $fileName;


        $path = $establishment[0]->abbr . '/' . $establishment[0]->mess_id . '/' . $establishment[0]->abbr . '_' . $establishment[0]->mess_id;

        $extensions = array('jpg', 'png', 'jpeg', 'gif', 'svg');
        $exist = '';
        foreach ($extensions as $ext) {

            if (Storage::disk('establishmentlogo')->exists('/' . $path . '.' . $ext)) {
                $exist = 1;
                Storage::disk('establishmentlogo')->delete('/' . $path . '.' . $ext);

                LogoImage::where('mess_id', $establishment[0]->mess_id)
                    ->delete();

                LogoImage::where('mess_id', Auth::user()->mess_id)
                    ->update([
                        'path' => $filePath,
                        'mess_id' => Auth::user()->mess_id,
                    ]);
            } else {
                $exist = 0;
            }

        }

        Storage::disk('establishmentlogo')->put($filePath, file_get_contents($request->logo_img));
        //$path = Storage::disk('establishmentlogo')->url($path);

        if ($exist == 0) {
            $data = LogoImage::create([
                'path' => $filePath,
                'mess_id' => Auth::user()->mess_id,
            ]);
        }


        return to_route('settings')->with('status', 'Mess Logo Added');
    }


    public function mealTime(Request $request)
    {
        $orderTimes = MealOrderTime::where('mess_id',Auth::user()->mess_id)->get();
        $exitTime = MealOrderTime::where('mess_id',Auth::user()->mess_id)->first();

        return view('admin.master-data.settings.meal-time', compact('orderTimes','exitTime'));
    }

    public function saveMealOrderTime(Request $request)
    {
        MealOrderTime::create([
            'mess_id' => Auth::user()->mess_id,
            'for_breakfast' => $request->time_breakfast,
            'for_lunch' => $request->time_lunch,
            'for_dinner' => $request->time_dinner,
            'created_by' => Auth::user()->id,
            'version' => 1
        ]);

        return to_route('meal-time')->with('status', 'Meal Order Time Added');
    }

    public function updateMealOrderTime(Request $request, $id)
    {


        $updateOrderTime = MealOrderTime::where('id', $id)
            ->where('mess_id', Auth::user()->mess_id)
            ->get();


        $orderTimes = MealOrderTime::where('mess_id',Auth::user()->mess_id)->get();

        return view('admin.master-data.settings.meal-time', compact('orderTimes', 'updateOrderTime'));
    }

    public function updateOrderTimes(Request $request, $id)
    {
        MealOrderTime::where('id', $id)
            ->where('mess_id', Auth::user()->mess_id)
            ->update([
                'for_breakfast' => $request->time_breakfast,
                'for_lunch' => $request->time_lunch,
                'for_dinner' => $request->time_dinner,
                'updated_by' => Auth::user()->id,
            ]);

        return to_route('meal-time')->with('status', 'Meal Order Time Updated');
    }

    public function getValidOrderTime(Request $request)
    {
        $times = MealOrderTime::where('mess_id', Auth::user()->mess_id)
            ->get();

        $orderType = MessDailyRations::join('mess_menu_details', 'mess_menu_details.id', '=', 'mess_daily_rations.mess_menu_id')
            ->where('mess_daily_rations.id', $request->order_id)
            ->where('mess_daily_rations.mess_id', Auth::user()->mess_id)
            ->get(['mess_daily_rations.meal_time', 'mess_daily_rations.ration_date']);



        $today = strtotime(date('Y-m-d', strtotime(Carbon::today()->toDateString()) ) );
        $mealDate = strtotime($orderType[0]['ration_date']);

        if($mealDate > $today) {

            return 1;
        }
        elseif ($mealDate < $today) {

            return json_encode($orderType[0]['meal_time'].' order time has exceeded. Do you want to continue anyway?');
        }
        else
        {
            $time = date('H');

            if($orderType[0]['meal_time'] == 'breakfast')
            {
                if ( $times[0]['for_breakfast'] >= $time )
                {
                    return 1;
                }
                else
                {
                    return json_encode('Breakfast order time has exceeded. Do you want to continue anyway?');
                }

            }


            if($orderType[0]['meal_time'] == 'lunch')
            {

                if ( $times[0]['for_lunch'] >= $time )
                {
                    return 1;
                }
                else
                {
                    return json_encode('Lunch order time has exceeded. Do you want to continue anyway?');
                }

            }
            if($orderType[0]['meal_time'] == 'dinner')
            {

                if ( $times[0]['for_dinner'] >= $time )
                {
                    return 1;
                }
                else
                {
                    return json_encode('Dinner order time has exceeded. Do you want to continue anyway?');
                }
            }

        }

    }
}
