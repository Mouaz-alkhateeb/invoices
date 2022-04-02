<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $SumTotal=number_format(invoices::sum('Total'),2);
        $SumTotal1=number_format(invoices::where('Value_Status',1)->sum('Total'),2);
        $SumTotal2=number_format(invoices::where('Value_Status',2)->sum('Total'),2);
        $SumTotal3=number_format(invoices::where('Value_Status',3)->sum('Total'),2);


        $count_all = invoices::count();
        $count_invoices1 = invoices::where('Value_Status', 1)->count();
        $count_invoices2 = invoices::where('Value_Status', 2)->count();
        $count_invoices3 = invoices::where('Value_Status', 3)->count();

        $nspainvoices1 = round(($count_all != 0) ? ($count_invoices1 / $count_all * 100) : 0);
        $nspainvoices2 = round(($count_all != 0) ? ($count_invoices2 / $count_all * 100) : 0);
        $nspainvoices3 = round(($count_all != 0) ? ($count_invoices3 / $count_all * 100) : 0);
        
        $chartjs = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['النسبة المئوية'])
        ->datasets([
            [
                "label" => "إجمالي الفواتير ",
                'backgroundColor' => ['#4D96FF'],
                'data' => [100]
            ],
            [
                "label" => "الفواتير  المدفوعة",
                'backgroundColor' => ['#FD5D5D'],
                'data' => [$nspainvoices1]
            ],
            [
                "label" => "الفواتير الغير مدفوعة",
                'backgroundColor' => ['#019267'],
                'data' => [$nspainvoices2]
            ],
            [
                "label" => "الفواتير المدفوعة جزئيا",
                'backgroundColor' => ['#EA5C2B'],
                'data' => [$nspainvoices3]
            ]
        ])
        ->options([]);
        
        $chartjs2 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 340, 'height' => 200])
        ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
        ->datasets([
            [
                'backgroundColor' => ['#019267','#FD5D5D','#EA5C2B'],
                'data' => [$nspainvoices2, $nspainvoices1,$nspainvoices3]
            ]
        ])
        ->options([]);


       


        return view('home', compact('chartjs','chartjs2','nspainvoices1','nspainvoices2','nspainvoices3','SumTotal','SumTotal1','SumTotal2','SumTotal3','count_all','count_invoices1','count_invoices2','count_invoices3'));
    }
}
