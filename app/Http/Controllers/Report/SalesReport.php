<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Sales;

class SalesReport extends Controller
{
    public function index()
    {
        $stocks = Stock::with('category')->get();
        $sales = null;
        return view('pages.report.salesreport', compact('stocks', 'sales'));
    }

    public function show(Request $request)
    {
        $start = $this->formatDateTimestamp($request->start . ' 00:00:00');
        $end = $this->formatDateTimestamp($request->end . ' 23:59:59');
        $sales = Sales::with('salesdetail')
                    ->whereHas('salesdetail', function ($query) use ($start, $end) {
                        $query->where('created_at', '>=', $start)
                            ->where('created_at', '<=', $end);
                    })->get();
        foreach ($sales as $key => $value) {
            $value->date = $this->formatDate($value->created_at);
            $value->time = $this->formatTime($value->created_at);
        }
        $stocks = Stock::all();

        $request->session()->put('start', $request->input('start'));
        $request->session()->put('end', $request->input('end'));
        
        return view('pages.report.salesreport', compact('sales', 'stocks'))->withInput($request->all());


    }

    public function formatDateTimestamp($value)
    {
        $value = date('Y-m-d H:i:s', strtotime($value));
        return $value;
    }

    public function formatDate($value)
    {
        $value = date('F, d Y', strtotime($value));
        // dd($value);
        return $value;
    }

    public function formatTime($value)
    {
        $value = date('H:i:s', strtotime($value));
        return $value;
    }


}
