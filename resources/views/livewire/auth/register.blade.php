<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $user_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <div class="flex flex-col gap-2">
            <label for="user_name" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Name') }}</label>
            <input
                wire:model="user_name"
                id="user_name"
                name="user_name"
                type="text"
                required
                autofocus
                autocomplete="name"
                placeholder="{{ __('Full name') }}"
                class="w-full rounded-md border border-zinc-300 dark:border-zinc-700 px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
            @error('user_name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="flex flex-col gap-2">
            <label for="email" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Email address') }}</label>
            <input
                wire:model="email"
                id="email"
                name="email"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
                class="w-full rounded-md border border-zinc-300 dark:border-zinc-700 px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
            @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="flex flex-col gap-2">
            <label for="password" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Password') }}</label>
            <input
                wire:model="password"
                id="password"
                name="password"
                type="password"
                required
                autocomplete="new-password"
                placeholder="{{ __('Password') }}"
                class="w-full rounded-md border border-zinc-300 dark:border-zinc-700 px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
            @error('password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="flex flex-col gap-2">
            <label for="password_confirmation" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Confirm password') }}</label>
            <input
                wire:model="password_confirmation"
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                autocomplete="new-password"
                placeholder="{{ __('Confirm password') }}"
                class="w-full rounded-md border border-zinc-300 dark:border-zinc-700 px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
            @error('password_confirmation')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end">
            <button
                type="submit"
                class="w-full inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors bg-indigo-600 text-white hover:bg-indigo-700"
            >
                {{ __('Create account') }}
            </button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>{{ __('Already have an account?') }}</span>
        <a href="{{ route('login') }}" wire:navigate class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 underline underline-offset-2">{{ __('Log in') }}</a>
    </div>
</div>
