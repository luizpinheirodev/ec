<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendDailyTasks::class,
        Commands\SendExpiringTasks::class,
        Commands\Send5minLate::class,
        Commands\SendNoPrevision::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        //Email com as tarefas diárias a vencer no dia e dos dias anteriores não concluídas
        $schedule->command('email:dailyTask')
                 ->dailyAt('09:00');
                
        //Email com a cobrança uma hora antes de vencer a atividade não concluída
        $schedule->command('email:expiringTasks')
                ->hourly();

        //Email com a cobrança 10 minutos após a atividade vencer - Cópia para gestor
        $schedule->command('email:lateTasks')
                ->everyTenMinutes();

        //Email com a cobrança de hora em hora dos vencido e sem prev
        $schedule->command('email:noPrevision')
                ->hourlyAt(15);
                
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
