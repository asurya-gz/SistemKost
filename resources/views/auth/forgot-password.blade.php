@extends('layouts.auth')

@section('title', 'Lupa Password - Kost Honest')

@section('content')
<section class="min-h-screen py-12 relative">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23dc2626" fill-opacity="0.1"><circle cx="30" cy="30" r="1.5"/></g></g></svg>');"></div>
    </div>
    
    <div class="container mx-auto px-4 min-h-screen flex items-center relative z-10">
        <div class="w-full max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Side - Hero Content -->
                <div class="hidden lg:block">
                    <div class="text-center lg:text-left">
                        <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                            Lupa Password? <span class="text-red-600">Tidak Masalah</span>
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Dapatkan password sementara dalam hitungan menit. Kami akan mengirimkan password sementara yang aman ke email Anda.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                            <div class="flex items-center space-x-3">
                                <div class="bg-red-100 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Keamanan Terjamin</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-red-100 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Email Terverifikasi</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-red-100 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Proses Cepat</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-red-100 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Password Temporary</span>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-red-50 to-red-100 p-6 rounded-xl border border-red-200">
                            <div class="flex items-center space-x-4">
                                <div class="bg-red-600 text-white p-3 rounded-full">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Password Aman & Temporary</h3>
                                    <p class="text-gray-600 text-sm">Password sementara akan dikirim ke email Anda dan berlaku selama 1 jam untuk keamanan maksimal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Side - Forgot Password Form -->
                <div class="w-full max-w-md mx-auto lg:mx-0">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">
                        <!-- Logo Header -->
                        <div class="text-center mb-8">
                            <div class="flex justify-center mb-4">
                                <div class="bg-red-600 text-white rounded-xl p-3 shadow-lg">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">Lupa Password?</h1>
                            <p class="text-gray-600">Masukkan email untuk mendapatkan <span class="text-red-600 font-semibold">password sementara</span></p>
                        </div>
                        
                        <!-- Alert Notification -->
                        <div id="alert-notification" class="hidden fixed top-4 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg max-w-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <span id="alert-message"></span>
                            </div>
                        </div>
            
                        @if(session('success'))
                        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-xl shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="font-semibold text-green-800">Berhasil!</p>
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-xl shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="font-semibold text-red-800">Error!</p>
                                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
            
                        <!-- Forgot Password Form -->
                        <form id="forgotPasswordForm" class="space-y-6">
                            @csrf
                            
                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-300"
                                    placeholder="Masukkan email Anda">
                                <div id="email-validation" class="mt-1 text-sm hidden">
                                    <span id="email-valid" class="text-green-600 hidden">✓ Format email valid</span>
                                    <span id="email-invalid" class="text-red-600 hidden">✗ Format email tidak valid</span>
                                </div>
                            </div>
                
                            <!-- Submit Button -->
                            <button type="submit" id="submitButton" disabled
                                class="w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg cursor-not-allowed"
                                style="background-color: #6b7280 !important; color: #d1d5db !important;">
                                <span id="submitText">Verifikasi Email</span>
                                <svg id="loadingIcon" class="animate-spin ml-2 h-5 w-5 text-white hidden inline" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                        </form>
                        
                        <!-- Login Link -->
                        <div class="text-center mt-8">
                            <p class="text-gray-600">
                                Sudah ingat password? 
                                <a href="{{ route('login') }}" class="text-red-600 hover:text-red-800 font-medium">
                                    Masuk sekarang
                                </a>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Back to Home -->
                    <div class="text-center mt-6">
                        <a href="{{ route('home') }}" class="text-red-600 hover:text-red-800 font-medium flex items-center justify-center transition duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NIK Verification Modal -->
<div id="nikModal" class="fixed inset-0 z-50 hidden overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px);">
    <div class="min-h-screen px-4 py-8 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto transform transition-all duration-300" id="nikModalContent">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Verifikasi Identitas</h3>
                            <p class="text-blue-100 text-sm">Masukkan NIK untuk konfirmasi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-gray-600 text-sm mb-4">Email ditemukan! Untuk keamanan, silakan masukkan NIK yang terdaftar.</p>
                </div>
                
                <form id="nikForm">
                    <div class="mb-6">
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">
                            NIK (Nomor Induk Kependudukan)
                        </label>
                        <input type="text" id="nik" name="nik" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="Masukkan 16 digit NIK">
                        <div id="nikError" class="mt-2 text-sm text-red-600 hidden"></div>
                    </div>

                    <div class="flex gap-4">
                        <button type="button" onclick="closeNikModal()" 
                                class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition duration-300">
                            Batal
                        </button>
                        <button type="submit" id="verifyNikBtn"
                                class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                            Verifikasi NIK
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Password Reset Modal -->
<div id="passwordModal" class="fixed inset-0 z-50 hidden overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px);">
    <div class="min-h-screen px-4 py-8 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto transform transition-all duration-300" id="passwordModalContent">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Reset Password</h3>
                            <p class="text-green-100 text-sm">Buat password baru</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
                <form id="resetPasswordForm">
                    <div class="mb-4">
                        <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru
                        </label>
                        <div class="relative">
                            <input type="password" id="newPassword" name="new_password" required
                                   class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                                   placeholder="Masukkan password baru">
                            <button type="button" class="absolute inset-y-0 right-0 flex items-center justify-center w-12 h-full text-gray-500 hover:text-gray-700 transition-colors duration-200" onclick="togglePasswordVisibility('newPassword', this)">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <input type="password" id="confirmPassword" name="confirm_password" required
                                   class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                                   placeholder="Konfirmasi password baru">
                            <button type="button" class="absolute inset-y-0 right-0 flex items-center justify-center w-12 h-full text-gray-500 hover:text-gray-700 transition-colors duration-200" onclick="togglePasswordVisibility('confirmPassword', this)">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        <div id="passwordError" class="mt-2 text-sm text-red-600 hidden"></div>
                    </div>

                    <div class="flex gap-4">
                        <button type="button" onclick="closePasswordModal()" 
                                class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition duration-300">
                            Batal
                        </button>
                        <button type="submit" id="resetPasswordBtn"
                                class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let currentUserEmail = '';

document.addEventListener('DOMContentLoaded', function() {
    // Email validation
    const emailInput = document.getElementById('email');
    const emailValidation = document.getElementById('email-validation');
    const emailValid = document.getElementById('email-valid');
    const emailInvalid = document.getElementById('email-invalid');
    const submitButton = document.getElementById('submitButton');
    
    emailInput.addEventListener('input', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email.length > 0) {
            emailValidation.classList.remove('hidden');
            
            if (emailRegex.test(email)) {
                emailValid.classList.remove('hidden');
                emailInvalid.classList.add('hidden');
                this.classList.remove('border-red-500');
                this.classList.add('border-green-500');
                
                // Enable submit button
                submitButton.disabled = false;
                submitButton.className = 'w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg hover:bg-red-700 focus:ring-4 focus:ring-red-200';
                submitButton.style.backgroundColor = '#dc2626';
                submitButton.style.color = '#ffffff';
            } else {
                emailValid.classList.add('hidden');
                emailInvalid.classList.remove('hidden');
                this.classList.remove('border-green-500');
                this.classList.add('border-red-500');
                
                // Disable submit button
                submitButton.disabled = true;
                submitButton.className = 'w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg cursor-not-allowed';
                submitButton.style.backgroundColor = '#6b7280';
                submitButton.style.color = '#d1d5db';
            }
        } else {
            emailValidation.classList.add('hidden');
            this.classList.remove('border-green-500', 'border-red-500');
            
            // Disable submit button
            submitButton.disabled = true;
            submitButton.className = 'w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg cursor-not-allowed';
            submitButton.style.backgroundColor = '#6b7280';
            submitButton.style.color = '#d1d5db';
        }
    });
    
    // Form submission - Email verification
    document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = emailInput.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!emailRegex.test(email)) {
            showAlert('Format email tidak valid!', 'error');
            return false;
        }
        
        const submitText = document.getElementById('submitText');
        const loadingIcon = document.getElementById('loadingIcon');
        
        submitButton.disabled = true;
        submitText.textContent = 'Memverifikasi...';
        loadingIcon.classList.remove('hidden');
        
        // Check if email exists
        fetch('/check-email-forgot-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                currentUserEmail = email;
                openNikModal();
                showAlert('Email ditemukan! Silakan verifikasi NIK.', 'success');
            } else {
                showAlert(data.message || 'Email tidak ditemukan di sistem.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
        })
        .finally(() => {
            submitButton.disabled = false;
            submitText.textContent = 'Verifikasi Email';
            loadingIcon.classList.add('hidden');
        });
    });
    
    // NIK Form submission
    document.getElementById('nikForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nik = document.getElementById('nik').value;
        const nikError = document.getElementById('nikError');
        
        if (nik.length !== 16) {
            nikError.textContent = 'NIK harus 16 digit';
            nikError.classList.remove('hidden');
            return;
        }
        
        nikError.classList.add('hidden');
        
        const verifyBtn = document.getElementById('verifyNikBtn');
        verifyBtn.disabled = true;
        verifyBtn.textContent = 'Memverifikasi...';
        
        // Verify NIK
        fetch('/verify-nik-forgot-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                email: currentUserEmail,
                nik: nik 
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeNikModal();
                openPasswordModal();
                showAlert('NIK terverifikasi! Silakan buat password baru.', 'success');
            } else {
                nikError.textContent = data.message || 'NIK tidak cocok dengan data yang terdaftar';
                nikError.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            nikError.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
            nikError.classList.remove('hidden');
        })
        .finally(() => {
            verifyBtn.disabled = false;
            verifyBtn.textContent = 'Verifikasi NIK';
        });
    });
    
    // Password Reset Form submission
    document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const passwordError = document.getElementById('passwordError');
        
        if (newPassword.length < 6) {
            passwordError.textContent = 'Password minimal 6 karakter';
            passwordError.classList.remove('hidden');
            return;
        }
        
        if (newPassword !== confirmPassword) {
            passwordError.textContent = 'Konfirmasi password tidak cocok';
            passwordError.classList.remove('hidden');
            return;
        }
        
        passwordError.classList.add('hidden');
        
        const resetBtn = document.getElementById('resetPasswordBtn');
        resetBtn.disabled = true;
        resetBtn.textContent = 'Menyimpan...';
        
        // Reset password
        fetch('/reset-password-forgot-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                email: currentUserEmail,
                new_password: newPassword,
                confirm_password: confirmPassword
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closePasswordModal();
                showAlert('Password berhasil diubah! Silakan login dengan password baru.', 'success');
                setTimeout(() => {
                    window.location.href = '/login';
                }, 2000);
            } else {
                passwordError.textContent = data.message || 'Terjadi kesalahan saat mengubah password';
                passwordError.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            passwordError.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
            passwordError.classList.remove('hidden');
        })
        .finally(() => {
            resetBtn.disabled = false;
            resetBtn.textContent = 'Reset Password';
        });
    });
});

// Modal functions
function openNikModal() {
    document.getElementById('nikModal').classList.remove('hidden');
    document.getElementById('nik').focus();
}

function closeNikModal() {
    document.getElementById('nikModal').classList.add('hidden');
    document.getElementById('nikForm').reset();
    document.getElementById('nikError').classList.add('hidden');
}

function openPasswordModal() {
    document.getElementById('passwordModal').classList.remove('hidden');
    document.getElementById('newPassword').focus();
}

function closePasswordModal() {
    document.getElementById('passwordModal').classList.add('hidden');
    document.getElementById('resetPasswordForm').reset();
    document.getElementById('passwordError').classList.add('hidden');
}

// Password visibility toggle
function togglePasswordVisibility(inputId, button) {
    const input = document.getElementById(inputId);
    const isPassword = input.type === 'password';
    
    input.type = isPassword ? 'text' : 'password';
    
    const svg = button.querySelector('svg');
    if (isPassword) {
        // Show eye-slash icon
        svg.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
        `;
    } else {
        // Show eye icon
        svg.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        `;
    }
}

// Show alert notification
function showAlert(message, type = 'error') {
    const alertDiv = document.getElementById('alert-notification');
    const alertMessage = document.getElementById('alert-message');
    
    alertMessage.textContent = message;
    
    if (type === 'error') {
        alertDiv.className = 'fixed top-4 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg max-w-sm';
    } else if (type === 'success') {
        alertDiv.className = 'fixed top-4 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg max-w-sm';
    }
    
    alertDiv.classList.remove('hidden');
    
    // Auto hide after 4 seconds
    setTimeout(() => {
        alertDiv.classList.add('hidden');
    }, 4000);
}
</script>
@endsection