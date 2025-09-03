@extends('layouts.auth')

@section('title', 'Login - Kost Honest')

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
                            Selamat Datang di <span class="text-red-600">Kost Honest</span>
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Sistem manajemen kost yang memudahkan pengelolaan hunian, pembayaran, dan komunikasi antara pemilik dan penghuni kost.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                            <div class="flex items-center space-x-3">
                                <div class="bg-red-100 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20a3 3 0 01-3-3v-2a3 3 0 01.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Manajemen Penghuni</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-red-100 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H11V21H5V19H7V17H5V15H9V13H7V11H5V9H7V7H5V5H13V9H21ZM13 13V21C13 22.11 13.89 23 15 23H21C22.11 23 23 22.11 23 21V13C23 11.89 22.11 11 21 11H15C13.89 11 13 11.89 13 13ZM21 21H15V13H21V21Z"/>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Kelola Pembayaran</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-red-100 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M3 9V7a4 4 0 018 0v2h2V7a6 6 0 00-12 0v2H3z"/>
                                        <path d="M3 9h18v10H3V9zm0 0V7a4 4 0 014-4h10a4 4 0 014 4v2"/>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Laporan & Analisis</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-red-100 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Sistem Aman</span>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-red-50 to-red-100 p-6 rounded-xl border border-red-200">
                            <div class="flex items-center space-x-4">
                                <div class="bg-red-600 text-white p-3 rounded-full">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Kost Honest Management</h3>
                                    <p class="text-gray-600 text-sm">Solusi digital untuk pengelolaan kost yang efisien dan transparan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="w-full max-w-md mx-auto lg:mx-0">
        <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">
            <!-- Logo Header -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="bg-red-600 text-white rounded-xl p-3 shadow-lg">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang Kembali</h1>
                <p class="text-gray-600">Masuk ke akun <span class="text-red-600 font-semibold">Kost Honest</span> Anda</p>
            </div>
            
            <!-- Alert Notifications -->
            <div id="success-notification" class="hidden fixed top-4 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg max-w-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    <span id="success-message"></span>
                </div>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-red-800 mb-2">Login Gagal</h3>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="text-sm text-red-700">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-300 @error('email') border-red-500 @enderror"
                        placeholder="Masukkan email Anda"
                        value="{{ old('email') }}">
                    <div id="email-validation" class="mt-1 text-sm hidden">
                        <span id="email-valid" class="text-green-600 hidden">✓ Format email valid</span>
                        <span id="email-invalid" class="text-red-600 hidden">✗ Format email tidak valid</span>
                    </div>
                </div>
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative flex">
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-300 focus:z-10 @error('password') border-red-500 @enderror"
                            placeholder="Masukkan password Anda">
                        <button type="button" id="toggle-password" class="inline-flex items-center px-3 border border-l-0 border-gray-300 rounded-r-lg bg-gray-50 hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition duration-300">
                            <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-slash-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">

                    <a href="{{ route('password.request') }}" class="text-sm text-red-600 hover:text-red-800 font-medium">
                        Lupa password?
                    </a>
                </div>
                
                <!-- Login Button -->
                <button type="submit" id="login-button" disabled
                    class="w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg cursor-not-allowed"
                    style="background-color: #6b7280 !important; color: #d1d5db !important;">
                    Masuk
                </button>
            </form>
            
            <!-- Divider -->
            <div class="my-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500"></span>
                    </div>
                </div>
            </div>
            
     
            
            <!-- Register Link -->
            <div class="text-center mt-8">
                <p class="text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-red-600 hover:text-red-800 font-medium">
                        Daftar sekarang
                    </a>
                </p>
            </div>
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
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Email validation
    const emailInput = document.getElementById('email');
    const emailValidation = document.getElementById('email-validation');
    const emailValid = document.getElementById('email-valid');
    const emailInvalid = document.getElementById('email-invalid');
    
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
            } else {
                emailValid.classList.add('hidden');
                emailInvalid.classList.remove('hidden');
                this.classList.remove('border-green-500');
                this.classList.add('border-red-500');
            }
        } else {
            emailValidation.classList.add('hidden');
            this.classList.remove('border-green-500', 'border-red-500');
        }
        
        validateLoginForm();
    });
    
    // Password field validation
    const passwordInput = document.getElementById('password');
    passwordInput.addEventListener('input', validateLoginForm);
    
    // Form validation for login button
    function validateLoginForm() {
        const email = emailInput.value;
        const password = passwordInput.value;
        const loginButton = document.getElementById('login-button');
        
        // Check email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const emailValid = emailRegex.test(email);
        
        // Check if all conditions are met
        const allValid = emailValid && password.length > 0;
        
        if (allValid) {
            loginButton.disabled = false;
            loginButton.className = 'w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg hover:bg-red-700 focus:ring-4 focus:ring-red-200';
            loginButton.style.backgroundColor = '#dc2626';
            loginButton.style.color = '#ffffff';
        } else {
            loginButton.disabled = true;
            loginButton.className = 'w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg cursor-not-allowed';
            loginButton.style.backgroundColor = '#6b7280';
            loginButton.style.color = '#d1d5db';
        }
    }
    
    // Toggle password visibility
    const togglePassword = document.getElementById('toggle-password');
    const eyeIcon = document.getElementById('eye-icon');
    const eyeSlashIcon = document.getElementById('eye-slash-icon');
    
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        eyeIcon.classList.toggle('hidden');
        eyeSlashIcon.classList.toggle('hidden');
    });
    
    // Initial form validation
    validateLoginForm();
    
    // Show success notification if register was successful
    @if(session('register_success'))
        showSuccessAlert('{{ session('register_success') }}');
    @endif
    
    // Show success alert function
    function showSuccessAlert(message) {
        const alertDiv = document.getElementById('success-notification');
        const alertMessage = document.getElementById('success-message');
        
        alertMessage.textContent = message;
        alertDiv.classList.remove('hidden');
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            alertDiv.classList.add('hidden');
        }, 3000);
    }
});
</script>
@endsection