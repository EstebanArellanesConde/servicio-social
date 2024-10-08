<div
    {{ $attributes->merge(['class' => 'card flex items-center justify-between bg-white dark:bg-gray-900 rounded-r-lmmd shadow-md w-1/4 border-l-4 p-4 space-y-2']) }}
>
    <div>
        <p class="text-lg">
            {{ $title }}
        </p>
        <p class="font-bold text-4xl">
            {{ $count }}
        </p>
    </div>
    <div>
            {{ $icon }}
    </div>
</div>
