<?php

namespace App\Http\Controllers\Sales;

use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesDetail;

class InvoiceController extends Controller
{
    public function invoice(string $id)
    {
        $sales = Sales::with('customer')->where('id', $id)->first();
        $sales->total = $this->formatRupiah($sales->total);
        $created_at = date('Y-m-d H:i:s', strtotime($sales->created_at));
        $sales->created = $this->formatDate($created_at);
        $sales->print = $this->formatDate(now());
        $salesdetail = SalesDetail::where('transno', $sales->transno)->get();

        $data = [
            'sales' => $sales,
            'salesdetail' => $salesdetail
        ];

        $pdf = PDF::loadView('pages.sales.invoice', $data);


        return $pdf->stream('invoice.pdf');
    }

    public function formatRupiah($value)
    { 
        $value = number_format($value, 0, ',', '.');
        return $value;
    }

    public function formatDate($value)
    {

        // dd($value);
        // Januari 01, 2021 
        $value = date('F d, Y', strtotime($value));
        return $value;
    }
}
