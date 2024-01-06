<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('pages.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|unique:users|max:255',
                'email' => 'required|unique:users|max:255',
                'password' => 'required|max:255',
            ]);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();
            return redirect()->route('user.index')->with('success', 'User Berhasil di simpan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('user.create')->with('error', $th->getMessage())->withInput();
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
        $data = User::findOrFail($id);
        return view('pages.users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                'role' => 'required|max:255',
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            if($request->password != null){
                $user->password = Hash::make($request->password);
            }

            $user->save();

            DB::commit();
            return redirect()->route('user.index')->with('success', 'User Berhasil di simpan.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return redirect()->route('user.edit', $id)->with('error', $th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            // Validasi Admin minimal 1
            $admin = User::where('role', 'admin')->count();
            $user = User::findOrFail($id);
            if($admin == 1 && $user->role == 'admin'){
                return redirect()->route('user.index')->with('error', 'Admin tidak boleh kurang dari 1.');
            }
            $user->delete();

            DB::commit();
            return redirect()->route('user.index')->with('success', 'User Berhasil di hapus.');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return redirect()->route('user.index')->with('error', $th->getMessage())->withInput();
        }
    }
}
