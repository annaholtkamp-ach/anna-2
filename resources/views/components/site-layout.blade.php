<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Connection' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind via Vite (Breeze/Volt default). If you’re not running Vite yet, comment this line. --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Optional: system fonts fallback if your Tailwind config is default --}}
    <style>
        html { font-feature-settings: "cv02","cv03","cv04","cv11"; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-sky-50 to-teal-50 text-gray-900">

{{-- Sticky colorful header --}}
<header class="sticky top-0 z-40 backdrop-blur bg-white/80 border-b border-indigo-100">
    <nav class="mx-auto max-w-7xl px-4 md:px-6 py-3 flex items-center justify-between">
        {{-- Brand --}}
        <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg
                             bg-gradient-to-br from-indigo-500 via-sky-500 to-teal-400
                             text-white font-semibold shadow-sm">C</span>
            <span class="text-lg md:text-xl font-semibold tracking-wide
                             bg-gradient-to-r from-indigo-600 via-sky-600 to-teal-600
                             bg-clip-text text-transparent">
                    Connection
                </span>
        </a>

        {{-- Desktop nav --}}
        <div class="hidden md:flex items-center gap-2">
            <a href="{{ route('event.index') }}"
               class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-indigo-50 text-indigo-700">
                Events
            </a>

            @guest
                <a href="{{ route('login') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-indigo-50">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium text-white
                              bg-gradient-to-r from-indigo-600 to-sky-600 hover:from-indigo-700 hover:to-sky-700 shadow-sm">
                    Register
                </a>
            @endguest

            @auth
                <a href="{{ route('event.create') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium text-white
                              bg-gradient-to-r from-teal-600 to-sky-600 hover:from-teal-700 hover:to-sky-700 shadow-sm">
                    Create Event
                </a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-indigo-50">
                        Logout
                    </button>
                </form>
            @endauth
        </div>

        {{-- Mobile menu button --}}
        <button x-data="{ open:false }" @click="open = !open"
                class="md:hidden inline-flex items-center justify-center rounded-lg p-2
                           hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                aria-label="Toggle navigation"
                x-bind:aria-expanded="open.toString()"
                x-on:click="
                        const m = document.getElementById('mobile-menu');
                        m.classList.toggle('hidden');
                    ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </nav>

    {{-- Mobile nav --}}
    <div id="mobile-menu" class="md:hidden hidden border-t border-indigo-100">
        <div class="mx-auto max-w-7xl px-4 md:px-6 py-2 flex flex-col gap-1">
            <a href="{{ route('event.index') }}" class="px-3 py-2 rounded-lg hover:bg-indigo-50">Events</a>

            @guest
                <a href="{{ route('login') }}" class="px-3 py-2 rounded-lg hover:bg-indigo-50">Login</a>
                <a href="{{ route('register') }}"
                   class="px-3 py-2 rounded-lg text-white
                              bg-gradient-to-r from-indigo-600 to-sky-600 hover:from-indigo-700 hover:to-sky-700 shadow-sm">
                    Register
                </a>
            @endguest

            @auth
                <a href="{{ route('event.create') }}"
                   class="px-3 py-2 rounded-lg text-white
                              bg-gradient-to-r from-teal-600 to-sky-600 hover:from-teal-700 hover:to-sky-700 shadow-sm">
                    Create Event
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-2 rounded-lg hover:bg-indigo-50 w-full text-left">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</header>

{{-- Page heading area (optional). If a view sets $title, it appears big here. --}}
<section class="mx-auto max-w-7xl px-4 md:px-6 pt-6">
    @isset($title)
        <h1 class="text-2xl md:text-3xl font-semibold tracking-tight
                       bg-gradient-to-r from-indigo-700 via-sky-700 to-teal-700
                       bg-clip-text text-transparent">
            {{ $title }}
        </h1>
    @endisset
</section>

{{-- Flash + validation messages --}}
<section class="mx-auto max-w-7xl px-4 md:px-6 pt-4">
    @if (session('status'))
        <div class="mb-3 rounded-lg border border-teal-200 bg-teal-50 px-4 py-3 text-teal-800">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-3 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800">
            <div class="font-semibold mb-1">There were some problems with your input:</div>
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</section>

{{-- Main content --}}
<main class="mx-auto max-w-7xl px-4 md:px-6 py-6">
    <div class="rounded-2xl bg-white/80 shadow-sm ring-1 ring-indigo-100 p-4 md:p-6">
        {{ $slot }}
    </div>
</main>

{{-- Footer --}}
<footer class="mt-10">
    <div class="mx-auto max-w-7xl px-4 md:px-6 py-8 text-sm text-gray-600">
        <div class="flex flex-col md:flex-row items-center justify-between gap-2">
            <p>&copy; {{ date('Y') }} Connection</p>
            <p class="text-gray-500">
                Built with Laravel & Tailwind ·
                <span class="bg-gradient-to-r from-indigo-600 via-sky-600 to-teal-600 bg-clip-text text-transparent font-medium">
                        Make meaningful connections
                    </span>
            </p>
        </div>
    </div>
</footer>

</body>
</html>
