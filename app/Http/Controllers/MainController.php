<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{   
    public function home()
    {
        $dataCar = Car::latest()->get();
        return view('content.client.home', [
            'cars' => $dataCar,
        ]);
    }

    public function pageRegister()
    {
        return view('content.register');
    }

    public function register(Request $request)
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

        return redirect('/')->with('success', 'Anda berhasil mendaftar, silahkan login!');
    }

    public function pageLogin()
    {
        return view('content.login');
    }

    public function login(Request $request)
    {
        $validasi = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($validasi)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('delete', 'Username atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
