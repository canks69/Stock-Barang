<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::all();
        return view('pages.customer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.customer.create');
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
                'code' => 'required|unique:customer|max:255',
                'name' => 'required|unique:customer|max:255',
                'email' => 'required|max:255',
                'phone' => 'required|max:255',
                'address' => 'required|max:255',
            ]);

            $customer = new Customer;
            $customer->code = $request->code;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();

            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Pelanggan Berhasil di simpan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('customer.create')->with('error', $th->getMessage())->withInput();
        }
    }

    public function getall(){
        $customer = Customer::all();
        $data = [];
        foreach ($customer as $key => $value) {
            $data[] = $value->code.' - '.$value->name;
        }
        
        return response()->json($data);
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
        $data = Customer::findOrFail($id);
        return view('pages.customer.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($id);
            $request->validate([
                'code' => 'required|unique:customer,code,'.$customer->id.'|max:255',
                'name' => 'required|unique:customer,name,'.$customer->id.'|max:255',
                'email' => 'required|max:255',
                'phone' => 'required|max:255',
                'address' => 'required|max:255',
            ]);
            
            $customer->code = $request->code;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();

            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Pelanggan Berhasil di simpan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('customer.edit', $id)->with('error', $th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
