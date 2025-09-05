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
                        <form method="POST" action="{{ route('password.send') }}" id="forgotPasswordForm" class="space-y-6">
                            @csrf
                            
                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <input type="email" id="email" name="email" required value="{{ $errors->has('email') ? '' : old('email') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-300 @error('email') border-red-500 @enderror"
                                    placeholder="Masukkan email Anda">
                                <div id="email-validation" class="mt-1 text-sm hidden">
                                    <span id="email-valid" class="text-green-600 hidden">✓ Format email valid</span>
                                    <span id="email-invalid" class="text-red-600 hidden">✗ Format email tidak valid</span>
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                
                            
                            <!-- Submit Button -->
                            <button type="submit" id="submitButton" disabled
                                class="w-full py-3 px-4 rounded-lg font-semibold transition duration-300 shadow-lg cursor-not-allowed"
                                style="background-color: #6b7280 !important; color: #d1d5db !important;">
                                <span id="submitText">Kirim Password Sementara</span>
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

<script>
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
    
    // Form submission
    document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
        const email = emailInput.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!emailRegex.test(email)) {
            e.preventDefault();
            showAlert('Format email tidak valid!', 'error');
            return false;
        }
        
        const submitText = document.getElementById('submitText');
        const loadingIcon = document.getElementById('loadingIcon');
        
        submitButton.disabled = true;
        submitText.textContent = 'Mengirim...';
        loadingIcon.classList.remove('hidden');
    });
    
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
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            alertDiv.classList.add('hidden');
        }, 3000);
    }
    
    // Check for Laravel validation errors
    @if($errors->has('email'))
        showAlert('{{ $errors->first('email') }}', 'error');
    @endif
});
</script>
@endsection