<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Stock;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Stock::with('category', 'salesdetail', 'purchasedetail')->get();
        
        // dd($data);
        foreach ($data as $key => $value) {
            $value->stock = $value->initial - $value->salesdetail->sum('qty');
            $value->stock = $value->stock + $value->purchasedetail->sum('qty');
            $value->stock = $this->formatRupiah($value->stock);
        }
        
        foreach ($data as $key => $value) {
            $value->price = $this->formatRupiah($value->price);
            $value->cogs = $this->formatRupiah($value->cogs);
            $value->initial = $this->formatRupiah($value->initial);
        }

         
        return view('pages.stock.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.stock.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $request->price = $this->formatFloat($request->price);
            $request->cogs = $this->formatFloat($request->cogs);
            $request->initial = $this->formatFloat($request->initial);

            $request->validate([
                'code' => 'required|unique:stocks|max:10',
                'name' => 'required|unique:stocks|max:255',
            ]);

            $stock = new Stock;
            $stock->code = $request->code;
            $stock->name = $request->name;
            $stock->price = $request->price;
            $stock->cogs = $request->cogs;
            $stock->initial = $request->initial;
            $stock->category_id = $request->category;
            $stock->save();

            DB::commit();
            return redirect()->route('stock.index')->with('success', 'Stock Berhasil di simpan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('stock.create')->with('error', $th->getMessage())->withInput();
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
        $data = Stock::findOrFail($id);
        // Ubah . jadi , untuk price dan cogs
        $data->price = str_replace('.', ',', $data->price);
        $data->cogs = str_replace('.', ',', $data->cogs);
        $data->initial = str_replace('.', ',', $data->initial);
        $category = Category::all();
        return view('pages.stock.edit', compact('data', 'category'));
    }

    public function getstockid($id)
    {
        $stock = Stock::findOrFail($id);
        return response()->json($stock);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->price = $this->formatFloat($request->price);
            $request->cogs = $this->formatFloat($request->cogs);
            $request->initial = $this->formatFloat($request->initial);

            // dd($request);
            $stock = Stock::findOrFail($id);
            $request->validate([
                'code' => 'required|unique:stocks,code,'.$stock->id.'|max:10',
                'name' => 'required|unique:stocks,name,'.$stock->id.'|max:255',
            ]);
            
            $stock->code = $request->code;
            $stock->name = $request->name;
            $stock->price = $request->price;
            $stock->cogs = $request->cogs;
            $stock->initial = $request->initial;
            $stock->category_id = $request->category;
            $stock->save();

            DB::commit();
            return redirect()->route('stock.index')->with('success', 'Stock Berhasil di simpan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('stock.edit', $id)->with('error', $th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            // Check if stock has sales
            $stock = Stock::with('salesdetail', 'purchasedetail')->findOrFail($id);
            if(count($stock->salesdetail) > 0){
                DB::rollback();
                return redirect()->route('stock.index')->with('error', 'Stock Gagal di hapus.')->withInput();
            }
            if(count($stock->purchasedetail) > 0){
                DB::rollback();
                return redirect()->route('stock.index')->with('error', 'Stock Gagal di hapus.')->withInput();
            }

            $stock->delete();
            DB::commit();
            return redirect()->route('stock.index')->with('success', 'Stock Berhasil di hapus.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('stock.index')->with('error', $th->getMessage());
        }
    }

    private function formatFloat($value)
    {
        // Hapus . untuk value dan ubah , jadi .
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return $value;
    }

    private function formatRupiah($value)
    {
        // Jadikan format rupiah dan tambahkan , untuk pecahan
        $value = number_format($value, 2, ',', '.');
        return $value;
    }
}
