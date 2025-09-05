<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\TemporaryPasswordMail;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // First try normal login
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            
            // Clear temporary password after successful login
            if ($user->temp_password) {
                $user->temp_password = null;
                $user->temp_password_expires_at = null;
                $user->save();
            }
            
            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('login_success', 'Selamat datang, Admin!');
            } else {
                // Check if profile is completed for regular users
                if (!($user->profile && $user->profile->is_profile_completed)) {
                    return redirect()->route('profile.complete.form')
                        ->with('login_success', 'Selamat datang! Silakan lengkapi profil Anda terlebih dahulu.');
                }
                
                return redirect()->route('pengguna.dashboard')
                    ->with('login_success', 'Selamat datang kembali!');
            }
        }

        // Try with temporary password if normal login fails
        $user = User::where('email', $request->email)->first();
        if ($user && $user->temp_password && Hash::check($request->password, $user->temp_password)) {
            // Check if temporary password has expired
            if ($user->temp_password_expires_at && now()->greaterThan($user->temp_password_expires_at)) {
                return redirect()->back()
                    ->withErrors(['email' => 'Password sementara telah kedaluwarsa.'])
                    ->withInput($request->only('email'));
            }
            
            Auth::login($user, $remember);
            
            // Clear temporary password after successful login
            $user->temp_password = null;
            $user->temp_password_expires_at = null;
            $user->save();
            
            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('login_success', 'Selamat datang, Admin! (Password sementara berhasil digunakan)');
            } else {
                // Check if profile is completed for regular users
                if (!($user->profile && $user->profile->is_profile_completed)) {
                    return redirect()->route('profile.complete.form')
                        ->with('login_success', 'Selamat datang! Silakan lengkapi profil Anda terlebih dahulu. (Password sementara berhasil digunakan)');
                }
                
                return redirect()->route('pengguna.dashboard')
                    ->with('login_success', 'Selamat datang kembali! (Password sementara berhasil digunakan)');
            }
        }

        return redirect()->back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->only('email'));
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendTemporaryPassword(Request $request)
    {
        // Validate email format first
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        // Check if email exists in database
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            // If email doesn't exist, redirect to register with message
            return redirect()->route('register')
                ->with('error', 'Email tidak terdaftar dalam sistem. Silakan daftar terlebih dahulu.')
                ->with('email', $request->email); // Prefill email in register form
        }
        
        // Generate temporary password
        $temporaryPassword = Str::random(10);
        
        // Save temporary password (hashed) and expiration time
        $user->temp_password = Hash::make($temporaryPassword);
        $user->temp_password_expires_at = now()->addHour(); // Valid for 1 hour
        $user->save();
        
        try {
            // Send email with temporary password
            Mail::to($user->email)->send(new TemporaryPasswordMail($user, $temporaryPassword));
            
            return redirect()->back()->with('success', 
                'Password sementara telah dikirim ke email Anda. Password berlaku selama 1 jam dan tidak akan mengganggu password asli Anda.'
            );
        } catch (\Exception $e) {
            // If email fails, remove the temporary password
            $user->temp_password = null;
            $user->temp_password_expires_at = null;
            $user->save();
            
            return redirect()->back()->with('error', 
                'Gagal mengirim email. Silakan coba lagi atau hubungi administrator.'
            );
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);
    }
}
