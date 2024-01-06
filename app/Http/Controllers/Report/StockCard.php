<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesDetail;
use App\Models\PurchaseDetail;

use App\Models\Stock;

class StockCard extends Controller
{
    public function index()
    {
        $stocks = Stock::with('category')->get();
        return view('pages.report.stockcard', compact('stocks'));
    }
    
    public function show(Request $request)
    {
        // dd($request->all());
        $start = $this->formatDateTimestamp($request->start . ' 00:00:00');
        $end = $this->formatDateTimestamp($request->end . ' 23:59:59');
        $stock = Stock::all();
        $sales = SalesDetail::where('created_at', '>=', $start)
            ->where('created_at', '<=', $end)
            ->orderBy('created_at', 'asc')
            ->get();
        $purchase = PurchaseDetail::where('created_at', '>=', $start)
            ->where('created_at', '<=', $end)
            ->orderBy('created_at', 'asc')
            ->get();
        $data = [
            'stock' => $stock,
            'sales' => $sales,
            'purchase' => $purchase
        ];

        return view('pages.report.stockcard', $data);
    }

    public function formatDateTimestamp($value)
    {
        $value = date('Y-m-d H:i:s', strtotime($value));
        return $value;
    }
}
