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
                       class="px-3 py-1.5 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">Edit</a>

                    <form action="{{ route('event.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Delete this event?');">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1.5 rounded-lg text-sm font-medium text-white bg-rose-600 hover:bg-rose-700">
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

    {{-- Signed-up box / form --}}
    @auth
        @if ($myIntention)
            <div class="mt-6 rounded-2xl border border-indigo-100 bg-white p-5">
                <p class="font-semibold text-gray-900 mb-3">Your intention</p>
                <div class="flex gap-2">
                    {{-- Edit (inline simple) --}}
                    <form method="POST" action="{{ route('intention.update', ['event' => $event->id, 'intention' => $myIntention->id]) }}">
                        @csrf @method('PUT')
                        <input type="text" name="intention_text" class="rounded-lg border px-3 py-1 text-sm"
                               value="{{ old('intention_text', $myIntention->intention_text) }}" required>
                        <input type="text" name="category" class="rounded-lg border px-3 py-1 text-sm"
                               placeholder="Category (optional)" value="{{ old('category', $myIntention->category) }}">
                        <label class="ml-2 text-sm">
                            <input type="checkbox" name="is_permanent" value="1" {{ $myIntention->is_permanent ? 'checked' : '' }}>
                            permanent
                        </label>
                        <button class="ml-2 rounded-lg bg-indigo-600 px-3 py-1.5 text-sm text-white hover:bg-indigo-700">
                            Update
                        </button>
                    </form>

                    {{-- Withdraw --}}
                    <form method="POST" action="{{ route('intention.destroy', ['event' => $event->id, 'intention' => $myIntention->id]) }}">
                        @csrf @method('DELETE')
                        <button class="rounded-lg border px-3 py-1.5 text-sm hover:bg-red-50">
                            Cancel
                        </button>
                    </form>
                </div>
            </div>
        @else
            {{-- Signup form --}}
            <div class="mb-6 rounded-2xl border border-indigo-100 bg-white p-5">
                <p class="font-semibold text-gray-900 mb-3">Join this event</p>

                <form method="POST" action="{{ route('intention.store', $event->id) }}" class="flex flex-wrap items-end gap-2">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Your intention</label>
                        <input type="text" name="intention_text" class="w-64 rounded-lg border px-3 py-2" required
                               value="{{ old('intention_text') }}">
                        @error('intention_text') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Category (optional)</label>
                        <input type="text" name="category" class="w-48 rounded-lg border px-3 py-2"
                               value="{{ old('category') }}">
                        @error('category') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <label class="inline-flex items-center gap-2 text-sm text-gray-700 mb-2">
                        <input type="checkbox" name="is_permanent" value="1"> permanent
                    </label>

                    <button class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                        Sign up
                    </button>
                </form>
            </div>
        @endif
    @endauth

    @guest
        <div class="mb-6 rounded-2xl border border-indigo-100 bg-white p-5 text-gray-700">
            Want to join? <a href="{{ route('login') }}" class="text-indigo-700 font-medium hover:underline">Log in</a> or
            <a href="{{ route('register') }}" class="text-indigo-700 font-medium hover:underline">Register</a>.
        </div>
    @endguest

{{-- Participants & Intentions --}}
<div class="mt-8">
    <h2 class="text-lg font-semibold mb-3">Participants & Intentions</h2>


    @forelse($event->intentions as $intention)
        <div class="mb-3 rounded-xl border border-indigo-100 bg-white p-4 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-2">
                <div class="text-sm">
                    <span class="font-medium">
                    {{ optional($intention->user)->name ?? 'Unknown user' }}

</span>
<span class="text-gray-500">— intends:</span>
</div>

<span class="inline-flex items-center rounded-full bg-sky-50 px-3 py-1 text-xs font-medium text-sky-700">
{{ $intention->category ?? 'Uncategorized' }}
</span>
</div>

<p class="mt-2 text-gray-700">
{{ $intention->intention_text }}
</p>
</div>
@empty
<div class="rounded-xl border border-indigo-100 bg-white p-4 text-gray-600">
No participants yet.
</div>
@endforelse
</div>
</x-site-layout>
