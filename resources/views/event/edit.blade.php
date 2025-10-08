<x-site-layout :title="'Edit Event – Connection'">
    <div class="max-w-2xl mx-auto bg-white/80 backdrop-blur-sm border border-indigo-100 shadow-sm rounded-2xl p-6">
        <form method="POST" action="{{ route('event.update', $event->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}"
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-gray-900 shadow-sm"
                       placeholder="Enter your event title" required>
                @error('title')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-gray-900 shadow-sm"
                          placeholder="Update the event description" required>{{ old('description', $event->description) }}</textarea>
                @error('description')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Scheduled At --}}
            <div>
                <label for="scheduled_at" class="block text-sm font-medium text-gray-700 mb-1">Scheduled at</label>
                <input type="datetime-local" name="scheduled_at" id="scheduled_at"
                       value="{{ old('scheduled_at', \Carbon\Carbon::parse($event->scheduled_at)->format('Y-m-d\TH:i')) }}"
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-gray-900 shadow-sm" required>
                @error('scheduled_at')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Location --}}
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}"
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-gray-900 shadow-sm"
                       placeholder="Update the event location" required>
                @error('location')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="pt-2 flex justify-between items-center">
                <a href="{{ route('event.show', $event->id) }}"
                   class="text-sm text-indigo-600 hover:underline">← Back to event</a>

                <button type="submit"
                        class="inline-flex justify-center items-center px-5 py-2.5
                               bg-gradient-to-r from-indigo-600 via-sky-600 to-teal-600
                               text-white font-medium rounded-lg shadow-sm hover:from-indigo-700 hover:to-teal-700
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Update Event
                </button>
            </div>
        </form>
    </div>
</x-site-layout>
