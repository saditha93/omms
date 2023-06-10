<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UserActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $adminsDeactives = Admin::where('suspend', 1)->get();

        foreach ($adminsDeactives as $adminsDeactive) {


            $then = Carbon::createFromFormat('Y-m-d H:i:s', $adminsDeactive->attempt_time);
            $now = new \DateTime('now');
            $minutes = abs($then->getTimestamp() - $now->getTimestamp()) / 60;

            if ($minutes > 30) {

                Admin::where('email', $adminsDeactive->email)
                    ->update([
                        'suspend' => 0,
                        'suspend_time' => null,
                        'attempt' => 0,
                        'attempt_time' => null
                    ]);
            }

        }
        return Command::SUCCESS;
    }
}
