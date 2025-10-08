<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Connection</title>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-red-600 hover:text-red-800">
                    Logout
                </button>
            </form>
        @endauth

        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        You are logged in. Welcome {{ auth()->user()->user_name }}
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        {{-- Hero / Landing --}}
        <main class="max-w-5xl mx-auto px-6 py-12">
            <h1 class="text-4xl font-bold mb-4">Welcome 👋</h1>
            <p class="mb-8 text-lg">Use the buttons below to explore the app.</p>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('event.index') }}"
                   class="px-4 py-2 rounded-xl border">Browse Events</a>

                @auth
                    <a href="{{ route('event.create') }}"
                       class="px-4 py-2 rounded-xl bg-black text-white">Create Event</a>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 rounded-xl bg-black text-white">Admin login</a>
                @endguest
            </div>

            {{-- Flash area (re-usable) --}}
            @if(session('status'))
                <div class="mt-6 rounded-lg border px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif
        </main>
</html>
