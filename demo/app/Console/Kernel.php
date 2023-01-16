<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Offers;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            // * Clean Offers
                if ( Offers::where('soft_delete', '!=' , 'true')->get()->toArray() != []) {
                    $offer_explode = [];
                    $expired_offer_ids = [];

                    foreach ( Offers::where('soft_delete', '!=' , 'true')->get()->toArray() as $offer ) {
                        $offer_explode[] = [
                            'id' => $offer['id'],
                            'dates' => explode('-', $offer['valid']),
                        ];
                    }

                    foreach ( $offer_explode as $value ) {
                        if ( mktime(0,0,0,$value['dates'][1],$value['dates'][0],$value['dates'][2]) < time() ) {
                            $expired_offer_ids[] = ['id' => $value['id']];
                        }
                    }

                    foreach ( $expired_offer_ids as $value ) {
                        $model = Offers::where('id', $value['id'])->update(['soft_delete' => 'true']);
                    }
                }
            // * Clean Offers
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
