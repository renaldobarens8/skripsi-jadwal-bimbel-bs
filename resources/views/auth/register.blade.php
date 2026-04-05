@extends('layouts.guest')

@section('content')
<div class="p-6 sm:p-8 lg:p-16 space-y-8">
    <div class="mb-4">
        <a href="{{ route('landing') }}" 
        class="inline-flex items-center text-cyan-700 hover:text-cyan-900 font-medium">
            ← Back
        </a>
    </div>

    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900">
        {{ __('Register Account') }}
    </h2>
    
    <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="text-sm font-medium text-gray-900 block mb-2">{{ __('Name') }}</label>

            <input id="name" type="text" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 @error('name') is-invalid @enderror" 
                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus 
                   placeholder="Name">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="email" class="text-sm font-medium text-gray-900 block mb-2">{{ __('Email Address') }}</label>

            <input id="email" type="email" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required autocomplete="email"
                   placeholder="Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div>
            <label for="role" class="text-sm font-medium text-gray-900 block mb-2">Daftar Sebagai</label>

            <select id="role" name="role" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 @error('role') is-invalid @enderror" required>
                <option value="">-- Pilih Peran --</option>
                <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Guru</option>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Siswa</option>
            </select>

            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="password" class="text-sm font-medium text-gray-900 block mb-2">{{ __('Password') }}</label>

            <input id="password" type="password" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 @error('password') is-invalid @enderror" 
                   name="password" required autocomplete="new-password"
                   placeholder="••••••••">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="password-confirm" class="text-sm font-medium text-gray-900 block mb-2">{{ __('Confirm Password') }}</label>

            <input id="password-confirm" type="password" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" 
                   name="password_confirmation" required autocomplete="new-password"
                   placeholder="••••••••">
        </div>


        <div>
            <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-base px-5 py-3 w-full sm:w-auto text-center">
                {{ __('Create account') }}
            </button>
        </div>
        
        <div class="text-sm font-medium text-gray-500">
            Already have an account? <a href="{{ route('login') }}" class="text-teal-500 hover:underline">{{ __('Login here') }}</a>
        </div>
    </form>
</div>
@endsection