<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div class="flex flex-col gap-2">
            <label for="email" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Email address') }}</label>
            <input
                wire:model="email"
                id="email"
                name="email"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
                class="w-full rounded-md border border-zinc-300 dark:border-zinc-700 px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
            @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="relative">
            <div class="flex flex-col gap-2">
                <label for="password" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Password') }}</label>
                <input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    required
                autocomplete="current-password"
                placeholder="{{ __('Password') }}"
                class="w-full rounded-md border border-zinc-300 dark:border-zinc-700 px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            @if (Route::has('password.request'))
                <a class="absolute end-0 top-0 text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 underline underline-offset-2" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-2">
            <input
                type="checkbox"
                id="remember"
                wire:model="remember"
                class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 text-indigo-600 focus:ring-indigo-500"
            >
            <label for="remember" class="text-sm text-gray-700 dark:text-gray-300">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="flex items-center justify-end">
            <button
                type="submit"
                class="w-full inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors bg-indigo-600 text-white hover:bg-indigo-700"
            >
                {{ __('Log in') }}
            </button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Don\'t have an account?') }}</span>
            <a href="{{ route('register') }}" wire:navigate class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 underline underline-offset-2">{{ __('Sign up') }}</a>
        </div>
    @endif
</div>
