@extends('layouts.jefe', ['title' => 'Reportes'])

@section('options')
@endsection

@section('main')
    <div class="top"></div>
    <!--Contenedor de la tabla-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="stripe hover w-full">
            <thead>
            <tr>
                <th data-priority="1">Número de Cuenta</th>
                <th data-priority="2">Nombre</th>
                <th data-priority="3">Número Reporte</th>
                <th data-priority="6">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reportes as $reporte)
                @php
                    $reportes_modal_id = "modal_reporte_" . $reporte->id;
                    $alumno = $reporte->servicio->alumno;
                @endphp
                <tr>
                    @if($alumno->numero_cuenta == null)
                        <td>S/N</td>
                    @else
                        <td>{{ $alumno->numero_cuenta }}</td>
                    @endif
                    <td>{{ $alumno->user->apellido_paterno . ' ' . $alumno->user->apellido_materno . ' ' . $alumno->user->nombre }}</td>
                    <td>{{ \App\app::NUMERO_ORDINAL[strval($reporte->num_reporte)] }}</td>
                    <td>
                        <div class="grid grid-flow-col gap-2 w-full">
                            <button
                                type="button"
                                class="text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-4 py-1.5 showModal"
                                data-modal-id="modal_reporte_{{ $reporte->id }}"
                                onclick="showReporte({{ $reporte->id }})"
                            >
                                Mostrar
                            </button>
                        </div>
                    </td>
                    <x-modal
                        :dataId="$reportes_modal_id"
                        class="w-3/4 px-4"
                    >
                        <div class="flex md:flex-row flex-col gap-8">
                            <div id="{{ 'reporte_' . $reporte->id }}"
                                 class="md:w-2/3 w-full"
                            ></div>
                            <div class="md:w-1/3 w-full space-y-10">
                                <form action="{{ route('jefe.reportes.correccion', ['id' => $reporte->id]) }}" class="space-y-4" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div>
                                        <label
                                            for="observaciones"
                                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">
                                            Obvervaciones
                                        </label>
                                        <textarea
                                            rows="8"
                                            name="observaciones"
                                            id="observaciones"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        ></textarea>
                                    </div>
                                    <x-primary-button class="text-xl">
                                        Solicitar Corrección
                                    </x-primary-button>
                                </form>
                                <form action="{{ route('jefe.reportes.aceptar', ['id' => $reporte->id]) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <canvas style="border: solid 1px black;" class="bg-white rounded" onmouseout="saveSign()"></canvas>
                                    <input type="hidden" name="sign" id="sign">
                                    <x-primary-button
                                        class="text-xl">
                                        ACEPTAR Y FIRMAR
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>
                    </x-modal>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div class="bottom"></div>
    <!--Contenedor de la tabla-->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script rel="preload" src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.12/pdfobject.min.js" as="script"></script>


    <script>
        var options = {
            height: "50rem",
            pdfOpenParams: {
                view: 'FitH',
                page: '2',
            }
        };

        function showReporte(reporteId){
            let url = "{{route('jefe.reportes.show', '')}}"+"/"+reporteId;
            PDFObject.embed(url, `#reporte_${reporteId}`, options);
        }


        const canvas = document.querySelector("canvas");
        const signaturePad = new SignaturePad(canvas);


        // Clears the canvas
        signaturePad.clear();
        // Returns true if canvas is empty, otherwise returns false
        signaturePad.isEmpty();
        // Rebinds all event handlers
        signaturePad.on();

        function saveSign(){
            let input = document.querySelector('#sign')
            input.value = signaturePad.toDataURL()
        }

    </script>
@endpush
