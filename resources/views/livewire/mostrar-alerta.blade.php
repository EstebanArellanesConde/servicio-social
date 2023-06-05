<ul {{ $attributes->merge(['class' => 'bg-red-500 text-sm text-white dark:text-white-400 space-y-1 text-center rounded-md py-2']) }}>
    @foreach ((array) $messages as $message)
        <li>{{ $message }}</li>
    @endforeach
</ul>
