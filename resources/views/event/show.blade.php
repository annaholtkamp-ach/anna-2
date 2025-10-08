<x-site-layout :title="$event->title . ' – Connection'">
    @php
        $dt = \Carbon\Carbon::parse($event->scheduled_at);
    @endphp

    <div class="flex items-center justify-between mb-4">
        <a href="{{ route('event.index') }}"
           class="text-sm text-indigo-700 hover:underline">&larr; Back to events</a>

        @auth
            @if ($event->canEditOrDelete(auth()->user()))
                <div class="flex items-center gap-2">
                    <a href="{{ route('event.edit', $event->id) }}"
                       class="px-3 py-1.5 rounded-lg text-sm font-medium text-white
                              bg-blue-600 hover:bg-blue-700">Edit</a>

                    <form action="{{ route('event.destroy', $event->id) }}" method="POST"
                          onsubmit="return confirm('Delete this event?');">
                        @csrf
                        @method('DELETE')
                        <button
                            class="px-3 py-1.5 rounded-lg text-sm font-medium text-white
                                   bg-rose-600 hover:bg-rose-700">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        @endauth
    </div>

    <div class="rounded-2xl border border-indigo-100 bg-white p-5 md:p-6 shadow-sm">
        <div class="flex flex-wrap items-center gap-2 mb-4">
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

        <h1 class="text-2xl md:text-3xl font-semibold tracking-tight mb-3">
            {{ $event->title }}
        </h1>

        <p class="text-gray-700 leading-relaxed mb-6">
            {{ $event->description }}
        </p>

        <div class="grid sm:grid-cols-2 gap-4">
            <div class="rounded-xl bg-indigo-50/60 border border-indigo-100 p-4">
                <div class="text-xs uppercase tracking-wide text-indigo-700 font-semibold mb-1">Hosted by</div>
                <div class="text-sm font-medium">
                    {{ optional($event->organiser)->name ?? 'Unknown organiser' }}
                </div>
            </div>

            <div class="rounded-xl bg-sky-50/60 border border-sky-100 p-4">
                <div class="text-xs uppercase tracking-wide text-sky-700 font-semibold mb-1">When</div>
                <div class="text-sm font-medium">
                    {{ $dt->toDayDateTimeString() }}
                </div>
            </div>
        </div>
    </div>
</x-site-layout>
