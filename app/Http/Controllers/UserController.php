<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $dataUser = User::latest()->get();
        return view('content.admin.user', [
            'data' => $dataUser,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'sim_number' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $validasi['password'] = Hash::make($validasi['password']);

        User::create($validasi);

        return redirect('/manage/user')->with('success', 'Data pengguna berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function show(User $user)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $user)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validasi = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'sim_number' => 'required',
            'username' => 'required',
            'role' => 'required',
        ]);

        $user->update($validasi);

        return redirect('/manage/user')->with('update', 'Data pengguna berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/manage/user')->with('delete', 'Data pengguna telah dihapus!');
    }
}
