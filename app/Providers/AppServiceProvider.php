<?php

namespace App\Providers;

use App\Models\LogoImage;
use App\Models\LogRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

            view()->composer('*',function($view) {

                if (Auth::user()) {


//                    LogRecord::create([
//                        'admin_id' => Auth::user()->id,
//                    ]);


                    LogRecord::updateOrCreate([
                        'admin_id' => Auth::user()->id,
                        'created_at' => Carbon::now()
                    ],
                        [
                            'admin_id' => Auth::user()->id,
                    ]);


                    $messLogo = LogoImage::where('mess_id', Auth::user()->mess_id)
                        ->get('path');

                    $view->with('messLogo', isset($messLogo[0]->path) ? $messLogo[0]->path : null);

                }
            });



    }
}
