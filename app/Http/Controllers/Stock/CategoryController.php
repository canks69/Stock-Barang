<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        return view('pages.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Sql Transaction
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|unique:categories|max:255',
            ]);

            $category = new Category;
            $category->name = $request->name;
            $category->save();

            DB::commit();
            return redirect()->route('category.index')->with('success', 'Kategori Berhasil di simpan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('category.create')->with('error', $th->getMessage())->withInput();
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
        $data = Category::findOrFail($id);
        return view('pages.category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);
            $request->validate([
                'name' => 'required|unique:categories,name,'.$category->id.'|max:255',
            ]);
            
            $category->name = $request->name;
            $category->save();

            DB::commit();
            return redirect()->route('category.index')->with('success', 'Kategori Berhasil di simpan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('category.edit', $id)->with('error', $th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);
            // Cek apakah category masih digunakan di tabel stock
            $stock = $category->stock()->count();
            if ($stock > 0) {
                throw new \Exception('Kategori masih digunakan di tabel stock.');
            }

            $category->delete();
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Kategori Berhasil di hapus.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('category.index')->with('error', $th->getMessage());
        }
    }
}
