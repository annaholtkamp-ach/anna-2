<{{ $level ?? 'h1' }} {{ $attributes->merge(['class' => 'font-semibold text-gray-900 dark:text-white ' .
    ($size === 'xl' ? 'text-2xl' :
     $size === 'lg' ? 'text-xl' :
     $size === 'md' ? 'text-lg' :
     $size === 'sm' ? 'text-base' : 'text-base')
]) }}>
    {{ $slot }}
</{{ $level ?? 'h1' }}>
