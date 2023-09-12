<!-- Modal -->
<div class="p-8 modal w-full h-full fixed left-0 top-0 justify-center items-center bg-black bg-opacity-50 hidden z-50" id="{{ $dataId }}">
    <div
        {{ $attributes->merge([
            'class' => "bg-white p-4 w-4/5 md:w-2/5 h-auto max-h-full rounded-tl-2xl rounded-bl-2xl overflow-auto scrollbar-thin scrollbar-thumb-slate-700 transition"
            ])
        }}
    >
        <div class="grid grid-cols-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="closeModal col-start-11 col-end-11 mb-[-10] h-6 w-6 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none hover:cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
        {{-- FORMULARIO --}}
        {{ $slot }}

        <div class="grid xl:grid-cols-8 mt-8">
            <button type="button" class="xl:col-start-7 xl:col-end-9 closeModal text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-2.5 py-2">Cerrar</button>
        </div>
    </div>
</div>
<!-- Modal -->
