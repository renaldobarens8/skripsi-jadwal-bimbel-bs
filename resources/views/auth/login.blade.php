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
        {{ __('Login to platform') }}
    </h2>
    
    <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
        @csrf
        
        <div>
            <label for="email" class="text-sm font-medium text-gray-900 block mb-2">{{ __('Email Address') }}</label>
            
            <input id="email" type="email" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                   placeholder="Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="password" class="text-sm font-medium text-gray-900 block mb-2">{{ __('Password') }}</label>
            
            <input id="password" type="password" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 @error('password') is-invalid @enderror" 
                   name="password" required autocomplete="current-password"
                   placeholder="••••••••">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-cyan-200 h-4 w-4 rounded" 
                       type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            </div>
            <div class="text-sm ml-3">
                <label for="remember" class="font-medium text-gray-900">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>

        <div>
            <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-base px-5 py-3 w-full sm:w-auto text-center">
                {{ __('Login to your account') }}
            </button>
        </div>
        
        <div class="text-sm font-medium text-gray-500">
            Not registered? <a href="{{ route('register') }}" class="text-teal-500 hover:underline">{{ __('Create account') }}</a>
        </div>
    </form>
</div>
@endsection