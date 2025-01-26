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

            $subject = 'Register Akun';
            $body = "Akun anda sudah di registrasi, silahkan buka link <a href='" . url('/verify?token=' . $verify_token) . "'>di sini</a> untuk melakukan verifikasi";

            $this->sendEmail($validated['email'], $validated['username'], $body, $subject);

            return redirect('/login')->with('success', 'Registrasi berhasil! Silakan cek email untuk melakukan verifikasi.');

        } catch (\Exception $e) {   
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function sendEmail($email, $userName, $body, $subject){
        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = env('MAIL_PORT');

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), 'Tirta Bugar');
            $mail->addAddress($email, $userName);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

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

    public function resetPassword(){
        return view('admin.forgot-password');
    }

    public function sendEmailReset(Request $request){
        $validated = $request->validate([
            'email' => 'required|email|exists:admin,email',
        ]);

        $admin = Admin::where('email', $validated['email'])->first();

        if (!$admin) {
            return back()->with('error', 'Email yang anda masukkan tidak ditemukan.');
        }

        $token = bin2hex(random_bytes(16));
        $token_hash = hash('sha256', $token);
        $expire = now()->addMinutes(60);
        $subject = 'Reset Password';
        $body = "silahkan buka link <a href='" . url('/reset-password?token= ' . $token_hash) . "'>di sini</a> untuk mengganti password kamu. Terima kasih";


        $admin->reset_token_hash = $token_hash;
        $admin->reset_token_expires_at = $expire;
        $admin->save();

        $this->sendEmail($validated['email'], $admin->username, $body, $subject);

        return redirect('/login')->with('success', 'Link reset password telah dikirim ke email Anda.');
    }

    public function newPassword(){
        return view('admin.new-password');
    }
    public function resetPasswordSubmit(Request $request){
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);

        $hashedToken = hash('sha256', $request->token);
    
        $admin = Admin::where('reset_token_hash', $request->token)->where('reset_token_expires_at', '>', now())->first();
    
        if (!$admin) {
            return back()->with('error', 'Token tidak valid atau sudah kedaluwarsa.');
        }
    
        // Simpan password baru
        $admin->password = Hash::make($request->password);
        $admin->reset_token_hash = null;
        $admin->reset_token_expires_at = null;
        $admin->save();
    
        return redirect('/login')->with('success', 'Password berhasil diubah. Silakan login.');
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logout berhasil.');
    }
}
