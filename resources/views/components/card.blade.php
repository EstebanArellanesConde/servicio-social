<div
    {{ $attributes->merge(['class' => 'bg-white text-black m-2 px-2 py-4 shadow-md rounded-lg
     dark:bg-gray-800 dark:text-white dark:shadow-none']) }}
>
    {{ $slot }}
</div>
