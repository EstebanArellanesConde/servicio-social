@props(['active'])
@php
    $classes = ($active ?? false)
                ? "flex gap-2 items-center block px-4 py-2 mt-2 text-sm font-semibold text-white bg-sky-400 rounded-lg dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-sky-300 focus:bg-sky-400 focus:outline-none focus:shadow-outline transition ease-in"
                : "flex gap-2 items-center block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-sky-300 focus:bg-sky-400 focus:outline-none focus:shadow-outline transition ease-in"
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
