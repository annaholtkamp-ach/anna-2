<div {!! $attributes->merge(['class' => 'flex flex-col gap-2']) !!}>
    <label for="{{ $id }}" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $label }}</label>
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type ?? 'text' }}"
        {{ $attributes->whereDoesntStartWith('class') }}
        class="w-full rounded-md border border-zinc-300 dark:border-zinc-700 px-3 py-2 text-gray-900 dark:text-white bg-white dark:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 {{ $attributes->get('class') }}"
    >
    @error($name)
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>
