<div class="flex items-center gap-2">
    <input
        type="checkbox"
        id="{{ $id ?? $attributes->get('wire:model') }}"
        {{ $attributes }}
        class="h-4 w-4 rounded border-zinc-300 dark:border-zinc-700 text-indigo-600 focus:ring-indigo-500"
    >
    <label for="{{ $id ?? $attributes->get('wire:model') }}" class="text-sm text-gray-700 dark:text-gray-300">
        {{ $label }}
    </label>
</div>
