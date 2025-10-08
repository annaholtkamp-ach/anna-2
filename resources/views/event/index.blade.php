<x-site-layout :title="'Events – Connection'">
    {{-- Empty state --}}
    @if ($events->isEmpty())
        <div class="rounded-2xl border border-indigo-100 bg-white/80 p-6 text-center text-gray-600">
            No events yet. <a href="{{ route('event.create') }}" class="text-indigo-700 font-medium hover:underline">Create the first one</a>.
        </div>
    @else
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm text-gray-600">
                {{ $events->count() }} upcoming {{ \Illuminate\Support\Str::plural('event', $events->count()) }}
            </p>

            @auth
                <a href="{{ route('event.create') }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg text-white
                          bg-gradient-to-r from-indigo-600 via-sky-600 to-teal-600 hover:from-indigo-700 hover:to-teal-700 shadow-sm">
                    Create Event
                </a>
            @endauth
        </div>

        <div class="space-y-4">
            @foreach ($events as $event)
                @php $dt = \Carbon\Carbon::parse($event->scheduled_at); @endphp

                <a href="{{ route('event.show', $event->id) }}"
                   class="block rounded-2xl border border-indigo-100 bg-white hover:bg-indigo-50/50 transition
                          shadow-sm p-5 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700">
                            {{ $dt->format('D, d M Y') }}
                        </span>
                        <span class="inline-flex items-center rounded-full bg-sky-50 px-3 py-1 text-xs font-medium text-sky-700">
                            {{ $dt->format('H:i') }}
                        </span>
                        <span class="inline-flex items-center rounded-full bg-teal-50 px-3 py-1 text-xs font-medium text-teal-700">
                            {{ $event->location }}
                        </span>
                    </div>

                    <h2 class="text-lg md:text-xl font-semibold tracking-tight text-gray-900">
                        {{ $event->title }}
                    </h2>

                    <p class="mt-1 text-gray-700">
                        {{ \Illuminate\Support\Str::limit($event->description, 160) }}
                    </p>

                    <div class="mt-3 text-sm text-gray-600">
                        Hosted by
                        <span class="font-medium text-gray-800">
                            {{ optional($event->organiser)->name ?? 'Unknown organiser' }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</x-site-layout>
