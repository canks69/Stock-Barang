<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Purchase;

class PurchaseReport extends Controller
{
    public function index()
    {
        $stocks = Stock::with('category')->get();
        $purchase = null;

        return view('pages.report.purchasereport', compact('stocks', 'purchase'));
    }

    public function show(Request $request)
    {
        $start = $this->formatDateTimestamp($request->start . ' 00:00:00');
        $end = $this->formatDateTimestamp($request->end . ' 23:59:59');
        $purchase = Purchase::with('purchasedetail')
                    ->whereHas('purchasedetail', function ($query) use ($start, $end) {
                        $query->where('created_at', '>=', $start)
                            ->where('created_at', '<=', $end);
                    })->get();
        foreach ($purchase as $key => $value) {
            $value->date = $this->formatDate($value->created_at);
            $value->time = $this->formatTime($value->created_at);
        }

        $stocks = Stock::all();

        $request->session()->put('start', $request->input('start'));
        $request->session()->put('end', $request->input('end'));
        
        return view('pages.report.purchasereport', compact('purchase', 'stocks'))->withInput($request->all());

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
