<p {{ $attributes->merge(['class' => 'text-gray-500 dark:text-gray-400 ' .
    ($size === 'lg' ? 'text-lg' :
     $size === 'md' ? 'text-base' :
     $size === 'sm' ? 'text-sm' : 'text-sm')
]) }}>
    {{ $slot }}
</p>
