<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\SendAdminReport;

class CountEntity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $reportList;

    public function __construct($reportList)
    {
        $this->reportList = $reportList;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $strReport = '';

        foreach($this->reportList as $reportClass)
        {
            $class = '\App\\'.$reportClass; 
            $strReport .= $reportClass.' : '.$class::count(). '<br>';
        }

        $admin = \App\User::findOrFail(1);
        $admin->notify(new SendAdminReport($strReport));
        
        return 'Отчет сгенерирован';
    }
}
