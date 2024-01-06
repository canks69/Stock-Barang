<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use PDF;

class PurchaseInvoice extends Controller
{
    public function invoice(string $id){
        $purchase = Purchase::findOrFail($id);
        $created_at = date('Y-m-d H:i:s', strtotime($purchase->created_at));
        $purchase->created = $this->formatDate($created_at);
        $purchase->print = $this->formatDate(now());
        $purchasedetail = PurchaseDetail::where('transno', $purchase->transno)->get();

        $data = [
            'purchase' => $purchase,
            'purchasedetail' => $purchasedetail
        ];

        $pdf = PDF::loadView('pages.purchase.invoice', $data);

        return $pdf->stream('invoice.pdf');
    }

    public function formatRupiah($value)
    { 
        $value = number_format($value, 0, ',', '.');
        return $value;
    }

    public function formatDate($value)
    {
        $value = date('F d, Y', strtotime($value));
        return $value;
    }
}
