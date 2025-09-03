<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        
        // Build unique rule for NIK
        $nikRule = 'required|string|size:16|unique:user_profiles,nik';
        if ($user->profile) {
            $nikRule .= ',' . $user->profile->id;
        }
        
        $request->validate([
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

        // Handle file upload
        $ktpPath = null;
        if ($request->hasFile('ktp_file')) {
            $ktpPath = $request->file('ktp_file')->store('ktp_files', 'public');
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
}
