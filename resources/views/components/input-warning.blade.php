@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'bg-orange-500 text-sm font-bold text-white dark:text-white-400 space-y-1 text-center rounded-md py-2']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
