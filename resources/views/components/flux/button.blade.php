<button
    type="{{ $type ?? 'button' }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors ' .
        ($variant === 'primary' ? 'bg-indigo-600 text-white hover:bg-indigo-700' : 'bg-white text-gray-900 border border-zinc-300 hover:bg-zinc-50')
    ]) }}
>
    {{ $slot }}
</button>
