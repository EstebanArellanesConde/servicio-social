<div class="p-5 dark:bg-gray-700 space-y-5">
    <h2 class="text-xl dark:text-white font-bold">
        Reporte {{ $num_reporte }}
    </h2>
    <form
          wire:submit.prevent="store"
          class="space-y-4"
    >
        <div class="rounded-md shadow-md py-2 px-4">
            <div class="flex flex-col gap-2">
                <h2 class="text-lg dark:text-white font-bold">
                    Actividades
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 font-light">
                    Indicarse brevemente las actividades realizadas en el bimestre (en pretérito y en primera persona -singular si las actividades son realizadas solo por el prestador de servicio social, o en plural si las actividades son realizadas en grupo-, cuidando la redacción y ortografía.
                </p>
            </div>

            <x-input-error :messages="$errors->get('actividades')" class="mt-2" />

            @foreach($actividades as $actividad)
                <div class="my-4 text-gray flex justify-between">
                    <div class="w-3/4">
                        <h3 class="text-md dark:text-white gap-4 font-bold">
                            Actividad {{ $loop->index + 1 }}
                        </h3>
                        <p class="dark:text-white font-light text-sm overflow-auto">
                            {{ $actividad['breve_descripcion'] }} ({{ $actividad['horas'] }} {{ $actividad['horas'] == '1' ? ' hr.' : ' hrs.' }})
                        </p>
                    </div>
                    <button
                        type="button"
                        onclick="alumno.eliminarActividad({{ $loop->index }})"
                        class="bg-red-600 text-white flex justify-center items-center rounded-md px-4 py-2 h-12"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            @endforeach

            <div class="mt-4">
                <h3 class="text-md dark:text-white gap-4 font-bold">
                    Nueva Actividad
                </h3>
                <div class="flex flex-col sm:flex-row gap-2 mt-4">
                    <div class="lg:w-2/3 sm:w-full">
                        <label
                            for="breve_descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Breve Descripción
                        </label>
                        <input
                            wire:model.lazy="breve_descripcion"
                            id="breve_descripcion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        />
                    </div>
                    <div>
                        <label
                            for="horas"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Horas
                        </label>
                        <input
                            wire:model.lazy="horas"
                            id="horas"
                            type="number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        />
                    </div>
                </div>
                <x-primary-button
                    type="button"
                    onclick="alumno.agregarActividad()"
                    class="text-center w-full mt-4 gap-2 justify-center"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <p>
                        Agregar Actividad
                    </p>
                </x-primary-button>
            </div>
        </div>
        <div>
            <label
                for="resultado_sociedad"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Resultados obtenidos en beneficio de la sociedad
            </label>
            <textarea
                wire:model.lazy="resultado_sociedad"
                id="resultado_sociedad"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
            ></textarea>
        </div>
        <div>
            <x-input-error :messages="$errors->get('resultado_sociedad')" class="mt-2" />
        </div>
        <div>
            <label
                for="resultado_profesional"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Resultados obtenidos en la propia formación profesional
            </label>
            <textarea
                wire:model.lazy="resultado_profesional"
                id="resultado_profesional"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
            ></textarea>
        </div>
        <div>
            <x-input-error :messages="$errors->get('resultado_profesional')" class="mt-2" />
        </div>
        <x-primary-button class="w-full">
            CREAR
        </x-primary-button>
    </form>
</div>

