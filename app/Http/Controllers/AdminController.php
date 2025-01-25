<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate(); // Regenerasi session untuk keamanan
            Log::info('Login berhasil untuk email: ' . $request->email); // Logging sukses
            return redirect('/admin')->with('success', 'Login berhasil.');
        }

        // Jika login gagal
        Log::warning('Login gagal untuk email: ' . $request->email); // Logging kegagalan
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function showProfile($id){
        $valueAdmin = Admin::where('id_admin', $id)->first();
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('valueAdmin', 'admin'));
    }

    public function updateProfile(Request $request){
        $validated = $request->validate([
            'id' => 'required|integer|exists:admin,id_admin',
            'username' => 'required|max:150',
            'email' => 'required',
        ]);

        Admin::where('id_admin', $validated['id'])->update([
            'username' => $validated['username'],
            'email' => $validated['email']
        ]);

        return redirect('/admin/setting/' . $validated['id'])->with('success', 'Data berhasil diupdate');
    }

    public function register(){
        return view('admin.register');
    }

    public function registerSubmit(Request $request){
        // inisiasi data
        $validated = $request->validate([
            'username' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admin,email',
            'password' => 'required|min:8'
        ], [
            'email.unique' => 'Email ini sudah terdaftar, gunakan email lain.',
            'email.required' => 'Email wajib diisi.',
            'password.min' => 'Password harus minimal 8 karakter.',
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

            $this->sendEmail($validated['email'], $validated['username'], $verify_token);

            return redirect('/login')->with('success', 'Registrasi berhasil! Silakan cek email untuk melakukan verifikasi.');

        } catch (\Exception $e) {   
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function sendEmail($email, $userName, $token){
        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'l3782960@gmail.com';
            $mail->Password = 'favxmitncpqpqyfc';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('tirtabugar@example.com', 'Tirta Bugar');
            $mail->addAddress($email, $userName);

            $mail->isHTML(true);
            $mail->Subject = 'Registrasi Akun';
            $mail->Body = "Akun anda sudah di registrasi, silahkan buka link <a href='" . url('/verify?token=' . $token) . "'>di sini</a> untuk melakukan verifikasi";

            $mail->send();
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function verifyEmail(Request $request){
        $token = $request->query('token');
        $admin = Admin::where('token_verify', $token)->first();

        if (!$admin) {
            return redirect('/login')->with('error', 'Token tidak valid');
        }

        $admin->where('id_admin', $admin->id_admin)->update([
            'token_verify' => null,
            'status_verify' => 1
        ]);

        return redirect('/login')->with('success', 'Verifikasi email berhasil.');
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logout berhasil.');
    }
}
