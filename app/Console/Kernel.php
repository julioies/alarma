<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\HorarioCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        //Este ejemplo programa la tarea "your:command" para ejecutarse diariamente, pero omitirá las fechas entre el 20 de junio y el 7 de septiembre y entre el 22 de diciembre y el 7 de enero.
        $schedule->command('Horario:cron')->daily()->skip(function () {
            return in_array(date('n-j'), ['06-20' => '09-07','12-22' => '01-07']);
        });
        //$schedule->command('Horario:cron')->cron('* * * * *');

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


//creamos con el comando Cron ./vendor/bin/sail php artisan make:command HorarioCron
//dentro de horario CRON hacemos la funcionalidad.
