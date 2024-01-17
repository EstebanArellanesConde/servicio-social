<x-card class="flex flex-col gap-2 px-4 justify-between">
    <div class="flex items-center justify-between xl:flex-row flex-col space-y-2">
        <h3 class="font-bold text-xl">
            {{ $title }}
        </h3>
        {{ $status }}
    </div>

    {{ $slot }}

    <div class="">
        {{ $button }}
    </div>
</x-card>
