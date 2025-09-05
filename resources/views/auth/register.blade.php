@extends('layouts.auth')

@section('title', 'Register - Kost Honest')

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
                            Bergabung dengan <span class="text-red-600">Kost Honest</span>
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Daftarkan akun Anda dan mulai mengelola kost dengan sistem manajemen digital yang efisien dan transparan.
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

                <!-- Right Side - Register Form -->
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
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h1>
                            <p class="text-gray-600">Daftar untuk menggunakan <span class="text-red-600 font-semibold">Kost Honest</span></p>
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

                        <!-- Register Form -->
                        <form action="{{ route('register') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap
                                </label>
                                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-300"
                                    placeholder="Masukkan nama lengkap Anda">
                            </div>
                            
                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <input type="email" id="email" name="email" required value="{{ $errors->has('email') ? '' : (old('email') ?: session('email')) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-300 @error('email') border-red-500 @enderror"
                                    placeholder="Masukkan email Anda">
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
                                        class="w-full px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-300 focus:z-10"
                                        placeholder="Buat password Anda">
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
                                <div id="password-validation" class="mt-2 text-sm space-y-1">
                                    <div class="text-gray-700 mb-1">Password harus memenuhi kriteria:</div>
                                    <div id="length-check" class="flex items-center">
                                        <span class="w-4 h-4 mr-2">✗</span>
                                        <span class="text-red-600">Minimal 8 karakter</span>
                                    </div>
                                    <div id="upper-check" class="flex items-center">
                                        <span class="w-4 h-4 mr-2">✗</span>
                                        <span class="text-red-600">Minimal 1 huruf besar</span>
                                    </div>
                                    <div id="lower-check" class="flex items-center">
                                        <span class="w-4 h-4 mr-2">✗</span>
                                        <span class="text-red-600">Minimal 1 huruf kecil</span>
                                    </div>
                                    <div id="number-check" class="flex items-center">
                                        <span class="w-4 h-4 mr-2">✗</span>
                                        <span class="text-red-600">Minimal 1 angka</span>
                                    </div>
                                    <div id="special-check" class="flex items-center">
                                        <span class="w-4 h-4 mr-2">✗</span>
                                        <span class="text-red-600">Minimal 1 karakter khusus (@, #, $, %, dll)</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Confirm Password Field -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Konfirmasi Password
                                </label>
                                <div class="relative flex">
                                    <input type="password" id="password_confirmation" name="password_confirmation" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-300 focus:z-10"
                                        placeholder="Ulangi password Anda">
                                    <button type="button" id="toggle-confirm-password" class="inline-flex items-center px-3 border border-l-0 border-gray-300 rounded-r-lg bg-gray-50 hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition duration-300">
                                        <svg id="confirm-eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg id="confirm-eye-slash-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                                <div id="confirm-password-validation" class="mt-1 text-sm hidden">
                                    <span id="password-match" class="text-green-600 hidden">✓ Password cocok</span>
                                    <span id="password-no-match" class="text-red-600 hidden">✗ Password tidak cocok</span>
                                </div>
                            </div>
                            
                            <!-- Terms & Conditions -->
                            <div class="flex items-start">
                                <input type="checkbox" name="terms" required
                                    class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mt-1">
                                <span class="ml-2 text-sm text-gray-600">
                                    Saya setuju dengan <a href="{{ route('terms') }}" target="_blank" class="text-red-600 hover:text-red-800 font-medium">Syarat & Ketentuan</a> 
                                    dan <a href="{{ route('privacy') }}" target="_blank" class="text-red-600 hover:text-red-800 font-medium">Kebijakan Privasi</a>
                                </span>
                            </div>
                            
                            <!-- Register Button -->
                            <button type="submit" id="register-button" disabled
                                class="w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg cursor-not-allowed"
                                style="background-color: #6b7280 !important; color: #d1d5db !important;">
                                Daftar Sekarang
                            </button>
                        </form>
                        
                        <!-- Login Link -->
                        <div class="text-center mt-8">
                            <p class="text-gray-600">
                                Sudah punya akun? 
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
    });
    
    // Password validation
    const passwordInput = document.getElementById('password');
    const lengthCheck = document.getElementById('length-check');
    const upperCheck = document.getElementById('upper-check');
    const lowerCheck = document.getElementById('lower-check');
    const numberCheck = document.getElementById('number-check');
    const specialCheck = document.getElementById('special-check');
    
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        
        // Length check
        updateCheck(lengthCheck, password.length >= 8);
        
        // Uppercase check
        updateCheck(upperCheck, /[A-Z]/.test(password));
        
        // Lowercase check
        updateCheck(lowerCheck, /[a-z]/.test(password));
        
        // Number check
        updateCheck(numberCheck, /[0-9]/.test(password));
        
        // Special character check
        updateCheck(specialCheck, /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password));
    });
    
    function updateCheck(element, isValid) {
        const icon = element.querySelector('span:first-child');
        const text = element.querySelector('span:last-child');
        
        if (isValid) {
            icon.textContent = '✓';
            text.classList.remove('text-red-600');
            text.classList.add('text-green-600');
        } else {
            icon.textContent = '✗';
            text.classList.remove('text-green-600');
            text.classList.add('text-red-600');
        }
    }
    
    // Password confirmation validation
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const confirmValidation = document.getElementById('confirm-password-validation');
    const passwordMatch = document.getElementById('password-match');
    const passwordNoMatch = document.getElementById('password-no-match');
    
    function validateConfirmPassword() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword.length > 0) {
            confirmValidation.classList.remove('hidden');
            
            if (password === confirmPassword) {
                passwordMatch.classList.remove('hidden');
                passwordNoMatch.classList.add('hidden');
                confirmPasswordInput.classList.remove('border-red-500');
                confirmPasswordInput.classList.add('border-green-500');
            } else {
                passwordMatch.classList.add('hidden');
                passwordNoMatch.classList.remove('hidden');
                confirmPasswordInput.classList.remove('border-green-500');
                confirmPasswordInput.classList.add('border-red-500');
            }
        } else {
            confirmValidation.classList.add('hidden');
            confirmPasswordInput.classList.remove('border-green-500', 'border-red-500');
        }
    }
    
    confirmPasswordInput.addEventListener('input', validateConfirmPassword);
    passwordInput.addEventListener('input', validateConfirmPassword);
    
    // Form validation for register button
    function validateForm() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const termsChecked = document.querySelector('input[name="terms"]').checked;
        const registerButton = document.getElementById('register-button');
        
        // Check email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const emailValid = emailRegex.test(email);
        
        // Check password strength
        const passwordValid = password.length >= 8 && 
            /[A-Z]/.test(password) && 
            /[a-z]/.test(password) && 
            /[0-9]/.test(password) && 
            /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
        
        // Check if all conditions are met
        const allValid = name.length > 0 && 
            emailValid && 
            passwordValid && 
            password === confirmPassword && 
            termsChecked;
        
        if (allValid) {
            registerButton.disabled = false;
            registerButton.className = 'w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg hover:bg-red-700 focus:ring-4 focus:ring-red-200';
            registerButton.style.backgroundColor = '#dc2626';
            registerButton.style.color = '#ffffff';
        } else {
            registerButton.disabled = true;
            registerButton.className = 'w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg cursor-not-allowed';
            registerButton.style.backgroundColor = '#6b7280';
            registerButton.style.color = '#d1d5db';
        }
    }
    
    // Add event listeners for form validation
    document.getElementById('name').addEventListener('input', validateForm);
    emailInput.addEventListener('input', validateForm);
    passwordInput.addEventListener('input', validateForm);
    confirmPasswordInput.addEventListener('input', validateForm);
    document.querySelector('input[name="terms"]').addEventListener('change', validateForm);
    
    // Show alert notification
    function showAlert(message, type = 'error') {
        const alertDiv = document.getElementById('alert-notification');
        const alertMessage = document.getElementById('alert-message');
        
        alertMessage.textContent = message;
        
        if (type === 'error') {
            alertDiv.className = 'fixed top-4 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg max-w-sm';
        }
        
        alertDiv.classList.remove('hidden');
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            alertDiv.classList.add('hidden');
        }, 3000);
    }
    
    // Check for Laravel validation errors
    @if($errors->has('email') && $errors->first('email') === 'Email sudah terdaftar.')
        showAlert('Email sudah terdaftar. Coba gunakan email lain!', 'error');
    @endif
    
    // Initial form validation
    validateForm();
    
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
    
    // Toggle confirm password visibility
    const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
    const confirmEyeIcon = document.getElementById('confirm-eye-icon');
    const confirmEyeSlashIcon = document.getElementById('confirm-eye-slash-icon');
    
    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        
        confirmEyeIcon.classList.toggle('hidden');
        confirmEyeSlashIcon.classList.toggle('hidden');
    });
});
</script>
@endsection