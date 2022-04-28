<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function final()
    {
        $title = 'Создание отчета';
        return view('admin.reports.final', compact('title'));
    }

    public function generateReport()
    {
        $reportList = request()->get('reportsList');
        if(count($reportList))
        {
            \App\Jobs\CountEntity::dispatch($reportList);

        }

        return back();
    }
}
