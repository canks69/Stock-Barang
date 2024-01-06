<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesDetail;
use App\Models\Customer;
use App\Models\Stock;


class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sales::with('customer')->get();
        // Tambahkan Format Rupiah pada total
        foreach ($data as $key => $value) {
            $value->total = $this->formatRupiah($value->total);
        }

        return view('pages.sales.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Genarate Document Number (Transno)
        $transno = $this->generateTransno('IV');
        $customers = Customer::all();
        $stocks = Stock::all();

        return view('pages.sales.create', compact('customers', 'stocks', 'transno'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {
            $request->validate([
                'transno' => 'required|unique:sales|max:255',
                'customer_id' => 'required|max:255',
                'total' => 'required|max:255',
            ]);

            $customer = Customer::findOrFail($request->customer_id);
            $sales = new Sales;
            $sales->transno = $request->transno;
            $sales->customer_id = $request->customer_id;
            $sales->name = $customer->name;
            $sales->address = $customer->address;
            // Hapus titik pada total
            $sales->total = $this->formatFloat($request->total);
            $sales->save();

            // Insert to salesdetail
            $stock_id = $request->code;
            $name = $request->name;
            $qty = $this->formatNumber($request->qty);
            $price = $request->price;
            $rate = $request->rate;
            if(count($stock_id) > 0){
                for ($i = 0; $i < count($stock_id); $i++) {
                    $salesdetail = new SalesDetail;
                    if($stock_id[$i] != '' || $stock_id[$i] != null){
                        $salesdetail->transno = $request->transno;
                        $salesdetail->stock_id = $stock_id[$i];
                        $salesdetail->qty = $qty[$i];
                        $salesdetail->price = $price[$i];
                        $salesdetail->total = $rate[$i];
                        $salesdetail->save();
                    }
                }
            } else {
                DB::rollback();
                return redirect()->route('sales.create')->with('error', 'Penjualan Gagal di simpan.')->withInput();
            }

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Penjualan Berhasil di simpan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('sales.create')->with('error', $th->getMessage())->withInput();
        }
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
        $sales = Sales::with('customer')->findOrFail($id);
        $salesdetail = SalesDetail::with('stock')->where('transno', $sales->transno)->get();
        $customers = Customer::all();
        $stocks = Stock::all();
        return view('pages.sales.edit', compact('sales', 'salesdetail', 'customers', 'stocks'));
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
                'customer_id' => 'required|max:255',
                'total' => 'required|max:255',
            ]);

            // Delete salesdetail
            $salesdetail = SalesDetail::where('transno', $request->transno)->get();
            foreach ($salesdetail as $key => $value) {
                $value->delete();
            }
            // Delete sales
            $sales = Sales::findOrFail($id);
            $sales->delete();

            // Insert to sales
            $customer = Customer::findOrFail($request->customer_id);
            $sales = new Sales;
            $sales->transno = $request->transno;
            $sales->customer_id = $request->customer_id;
            $sales->name = $customer->name;
            $sales->address = $customer->address;
            // Hapus titik pada total
            $sales->total = $this->formatFloat($request->total);
            $sales->save();

            // Save Sales Detail
            $stock_id = $request->code;
            $name = $request->name;
            $qty = $this->formatNumber($request->qty);
            $price = $request->price;
            $rate = $request->rate;

            if(count($stock_id) > 0){
                for($i=0; $i<count($stock_id); $i++){
                    $salesdetail = new SalesDetail;
                    $salesdetail->transno = $request->transno;
                    $salesdetail->stock_id = $stock_id[$i];
                    $salesdetail->qty = $qty[$i];
                    $salesdetail->price = $price[$i];
                    $salesdetail->total = $rate[$i];
                    $salesdetail->save();
                }
            }else{
                DB::rollback();
                return redirect()->route('sales.edit', $id)->with('error', 'Penjualan Gagal di simpan.')->withInput();
            }

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Penjualan Berhasil di simpan.');
            
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('sales.edit', $id)->with('error', $th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $sales = Sales::findOrFail($id);
            // Delete salesdetail
            $salesdetail = SalesDetail::where('transno', $sales->transno)->get();
            foreach ($salesdetail as $key => $value) {
                $value->delete();
            }
            $sales->delete();

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Penjualan Berhasil di hapus.');
            
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('sales.index')->with('error', $th->getMessage());
        }
    }

    public function stockid(Request $request)
    {
        $stock = Stock::findOrFail($request->id);
        return response()->json($stock);

    }

    public function generateTransno($code)
    {
        $lastTransno = Sales::orderBy('id', 'desc')->first();
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

    public function formatFloat($value)
    {
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return $value;
    }

    public function formatRupiah($value)
    { 
        $value = number_format($value, 0, ',', '.');
        return $value;
    }

    public function formatNumber($value)
    {
        $value = str_replace('.', '', $value);
        return $value;
    }
}
