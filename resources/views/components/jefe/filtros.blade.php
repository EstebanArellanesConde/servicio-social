@php
    $optionsContainerClasses = 'options w-full grid grid-cols-3 gap-4 ml-2 mt-4'
@endphp
<div
    class="my-6 space-y-2"
>
    <h3
        class="text-lg"
    >
        {{ $title }}
    </h3>
    <div class="{{$optionsContainerClasses}}">
        {{ $slot }}
    </div>
</div>
