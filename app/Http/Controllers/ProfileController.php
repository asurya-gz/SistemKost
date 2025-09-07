<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showCompleteForm()
    {
        $user = Auth::user();
        
        // Redirect to dashboard if profile already completed
        if ($user->profile && $user->profile->is_profile_completed) {
            return redirect()->route('pengguna.dashboard');
        }
        
        return view('profile.complete');
    }
    public function completeProfile(Request $request)
    {
        $user = Auth::user();
        
        // Debug: Log all request data
        \Log::info('Profile Complete Request', [
            'user_id' => $user->id,
            'has_file' => $request->hasFile('ktp_file'),
            'files' => $request->files->all(),
            'all_data' => $request->all()
        ]);
        
        // Build unique rule for NIK
        $nikRule = 'required|string|size:16|unique:user_profiles,nik';
        if ($user->profile) {
            $nikRule .= ',' . $user->profile->id;
        }
        
        // Custom validation with better debugging
        $validator = Validator::make($request->all(), [
            'nik' => $nikRule,
            'address' => 'required|string',
            'gender' => 'required|in:L,P',
            'ktp_file' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'address.required' => 'Alamat wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'ktp_file.required' => 'File KTP wajib diupload.',
            'ktp_file.image' => 'File harus berupa gambar.',
            'ktp_file.mimes' => 'Format file harus JPG, JPEG, atau PNG.',
            'ktp_file.max' => 'Ukuran file maksimal 2MB.',
        ]);
        
        // Log validation errors for debugging
        if ($validator->fails()) {
            \Log::error('Profile Complete Validation Failed', [
                'errors' => $validator->errors()->toArray(),
                'has_file' => $request->hasFile('ktp_file'),
                'file_info' => $request->hasFile('ktp_file') ? [
                    'size' => $request->file('ktp_file')->getSize(),
                    'type' => $request->file('ktp_file')->getMimeType(),
                    'name' => $request->file('ktp_file')->getClientOriginalName(),
                ] : null,
                'all_request' => $request->all()
            ]);
            
            // Add custom error message for file upload issues
            if (!$request->hasFile('ktp_file') && $validator->errors()->has('ktp_file')) {
                $validator->errors()->add('ktp_file', 'File KTP belum dipilih atau gagal diupload. Silakan pilih file KTP Anda.');
            }
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle file upload
        $ktpPath = null;
        if ($request->hasFile('ktp_file') && $request->file('ktp_file')->isValid()) {
            $file = $request->file('ktp_file');
            $ktpPath = $file->store('ktp_files', 'public');
            
            // Log for debugging
            \Log::info('KTP File uploaded successfully', [
                'original_name' => $file->getClientOriginalName(),
                'path' => $ktpPath,
                'size' => $file->getSize()
            ]);
        } else {
            \Log::error('KTP File upload failed', [
                'hasFile' => $request->hasFile('ktp_file'),
                'isValid' => $request->file('ktp_file') ? $request->file('ktp_file')->isValid() : false,
                'error' => $request->file('ktp_file') ? $request->file('ktp_file')->getError() : 'No file'
            ]);
        }

        // Ensure file was uploaded successfully
        if (!$ktpPath) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['ktp_file' => 'Gagal mengupload file KTP. Silakan coba lagi.']);
        }

        // Create or update user profile
        if ($user->profile) {
            $user->profile->update([
                'nik' => $request->nik,
                'address' => $request->address,
                'gender' => $request->gender,
                'ktp_file' => $ktpPath,
                'is_profile_completed' => true,
            ]);
        } else {
            UserProfile::create([
                'user_id' => $user->id,
                'nik' => $request->nik,
                'address' => $request->address,
                'gender' => $request->gender,
                'ktp_file' => $ktpPath,
                'is_profile_completed' => true,
            ]);
        }

        return redirect()->route('pengguna.dashboard')
            ->with('success', 'Profil berhasil dilengkapi! Selamat datang di dashboard Anda.');
    }

    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;
        
        return view('pengguna.profile', compact('user', 'profile'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;
        
        return view('pengguna.profile-edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Build unique rule for NIK
        $nikRule = 'required|string|size:16|unique:user_profiles,nik';
        if ($user->profile) {
            $nikRule .= ',' . $user->profile->id;
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nik' => $nikRule,
            'address' => 'required|string',
            'gender' => 'required|in:L,P',
            'ktp_file' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'address.required' => 'Alamat wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'ktp_file.image' => 'File harus berupa gambar.',
            'ktp_file.mimes' => 'Format file harus JPG, JPEG, atau PNG.',
            'ktp_file.max' => 'Ukuran file maksimal 2MB.',
        ]);

        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Handle file upload
        $ktpPath = $user->profile->ktp_file ?? null;
        if ($request->hasFile('ktp_file')) {
            // Delete old file if exists
            if ($ktpPath && Storage::disk('public')->exists($ktpPath)) {
                Storage::disk('public')->delete($ktpPath);
            }
            $ktpPath = $request->file('ktp_file')->store('ktp_files', 'public');
        }

        // Update or create profile
        if ($user->profile) {
            $user->profile->update([
                'nik' => $request->nik,
                'address' => $request->address,
                'gender' => $request->gender,
                'ktp_file' => $ktpPath,
            ]);
        } else {
            UserProfile::create([
                'user_id' => $user->id,
                'nik' => $request->nik,
                'address' => $request->address,
                'gender' => $request->gender,
                'ktp_file' => $ktpPath,
                'is_profile_completed' => true,
            ]);
        }

        return redirect()->route('pengguna.profile')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function changePasswordForm()
    {
        $user = Auth::user();
        return view('pengguna.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Password saat ini tidak benar.'])
                ->withInput();
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('pengguna.profile')
            ->with('success', 'Password berhasil diubah!');
    }
}
