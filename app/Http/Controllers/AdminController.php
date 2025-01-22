<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct() {
        
    }

    public function login(){
        return view('admin.login');
    }

    public function loginSubmit(Request $request){
        // Log proses login
        Log::info('Proses login dijalankan.');

        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        dd($request->all());

        // if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
        //     $request->session()->regenerate(); // Regenerasi session untuk keamanan
        //     Log::info('Login berhasil untuk email: ' . $request->email); // Logging sukses
        //     return redirect('/admin')->with('success', 'Login berhasil.');
        // }

        // // Jika login gagal
        // Log::warning('Login gagal untuk email: ' . $request->email); // Logging kegagalan
        // return back()->withErrors([
        //     'email' => 'Email atau password salah.',
        // ])->withInput();
    }

    public function register(){
        return view('admin.register');
    }

    public function registerSubmit(Request $request){
        // inisiasi data
        $validated = $request->validate([
            'username' => 'required|max:50',
            'email' => 'required|max:100',
            'password' => 'required|min:8'
            // 'password' => 'required|min:8|confirmed'
        ]);

        // enkripsi password
        $password = Hash::make($validated['password']);
        $verify_token = md5(rand());

        try {
            // insert data
            DB::statement('CALL register_admin(?,?,?,?)', [
                $validated['username'],
                $validated['email'],
                $password,
                $verify_token,
            ]);

            return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');

        } catch (\Exception $e) {   
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logout berhasil.');
    }
}
