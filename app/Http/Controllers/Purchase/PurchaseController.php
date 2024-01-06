<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseDetail;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Stock;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Purchase::all();
        // dd($data);
        return view('pages.purchase.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transno = $this->generateTransno('PI');
        $stocks = Stock::all();
        return view('pages.purchase.create', compact('stocks', 'transno'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'transno' => 'required|unique:purchase|max:255',
                'total' => 'required|max:255',
            ]);

            $purchase = new Purchase;
            $purchase->name = $request->name ?? '';
            $purchase->address = $request->address ?? '';
            $purchase->transno = $request->transno;
            $purchase->total = $request->total;
            $purchase->save();

            $stock_id = $request->code;
            $name = $request->name;
            $qty = $this->formatNumber($request->qty);
            $price = $request->price;
            $rate = $request->rate;
            if(count($stock_id) > 0){
                for ($i = 0; $i < count($stock_id); $i++) {
                    $purchaseDetail = new PurchaseDetail;
                    if($stock_id[$i] != '' || $stock_id[$i] != null){
                        $purchaseDetail->transno = $request->transno;
                        $purchaseDetail->stock_id = $stock_id[$i];
                        $purchaseDetail->qty = $qty[$i];
                        $purchaseDetail->price = $price[$i];
                        $purchaseDetail->total = $rate[$i];
                        $purchaseDetail->save();
                    }
                }
            }else{
                DB::rollback();
                return redirect()->route('purchase.create')->with('error', 'Data tidak boleh kosong.')->withInput();
            }

            DB::commit();
            return redirect()->route('purchase.index')->with('success', 'Pembelian Berhasil di simpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return redirect()->route('purchase.create')->with('error', $th->getMessage())->withInput();
        }
    }

    public function invoice(string $id)
    {
        $data = Purchase::findOrFail($id);
        return view('pages.purchase.invoice', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchasedetail = PurchaseDetail::with('stock')->where('transno', $purchase->transno)->get();
        $stocks = Stock::all();
        return view('pages.purchase.edit', compact('purchase', 'purchasedetail', 'stocks'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'transno' => 'required|max:255',
                'total' => 'required|max:255',
            ]);

            $purchasedetail = PurchaseDetail::where('transno', $request->transno)->get();
            foreach ($purchasedetail as $key => $value) {
                $value->delete();
            }
            
            $purchase = Purchase::findOrFail($id);
            $purchase->delete();

            $purchase = new Purchase;
            $purchase->name = $request->name ?? '';
            $purchase->address = $request->address ?? '';
            $purchase->transno = $request->transno;
            $purchase->total = $request->total;
            $purchase->save();

            $stock_id = $request->code;
            $name = $request->name;
            $qty = $this->formatNumber($request->qty);
            $price = $request->price;
            $rate = $request->rate;
            if(count($stock_id) > 0){
                for($i=0; $i<count($stock_id); $i++){
                    $purchaseDetail = new PurchaseDetail;
                    $purchaseDetail->transno = $request->transno;
                    $purchaseDetail->stock_id = $stock_id[$i];
                    $purchaseDetail->qty = $qty[$i];
                    $purchaseDetail->price = $price[$i];
                    $purchaseDetail->total = $rate[$i];
                    $purchaseDetail->save();
                }
            }else{
                DB::rollback();
                return redirect()->route('purchase.edit', $id)->with('error', 'Data tidak boleh kosong.')->withInput();
            }

            DB::commit();
            return redirect()->route('purchase.index')->with('success', 'Pembelian Berhasil di simpan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('purchase.edit', $id)->with('error', $th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $purchasedetail = PurchaseDetail::where('transno', $id)->get();
            foreach ($purchasedetail as $key => $value) {
                $value->delete();
            }
            
            $purchase = Purchase::findOrFail($id);
            $purchase->delete();

            DB::commit();
            return redirect()->route('purchase.index')->with('success', 'Pembelian Berhasil di hapus.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('purchase.index')->with('error', $th->getMessage());
        }
    }

    public function generateTransno($code)
    {
        $lastTransno = Purchase::orderBy('id', 'desc')->first();
        if ($lastTransno) {
            $lastTransno = $lastTransno->transno;
            $lastTransno = explode('-', $lastTransno);
            $lastTransno = $lastTransno[1];
            $lastTransno = intval($lastTransno);
            $lastTransno = $lastTransno + 1;
            $lastTransno = $code . date('ymd') . '-' . str_pad($lastTransno, 4, '0', STR_PAD_LEFT);
        } else {
            $lastTransno = $code . date('ymd') . '-' . str_pad(1, 4, '0', STR_PAD_LEFT);
        }

        return $lastTransno;
    }

    public function formatNumber($value)
    {
        $value = str_replace('.', '', $value);
        return $value;
    }
}
