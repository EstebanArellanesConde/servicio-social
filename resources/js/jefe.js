import Swal from 'sweetalert2';

function finalizar(id, nombre){
    Swal.fire({
        title: `¿Seguro que deseas finalizar el servicio del alumno ${nombre}?`,
        text: "Se colocará en la sección de Finalizados",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, seguro',
        cancelButtonText: 'Cancelar',
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/jefe/finalizar/${id}`;
        }
    })
}

export function aceptar(id, nombre){
    Swal.fire({
        title: `¿Seguro que deseas aceptar al alumno ${nombre}?`,
        text: "Se colocará en la sección de inscritos",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, seguro',
        cancelButtonText: 'Cancelar',
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/jefe/aceptar/${id}`;
        }
    })
}

export function baja(id, nombre){
    Swal.fire({
        title: `¿Seguro que deseas dar de baja al alumno ${nombre}?`,
        text: "Se colocará en la sección de rechazados",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, seguro',
        cancelButtonText: 'Cancelar',
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/jefe/rechazar/${id}`;
        }
    })
}

$(document).ready(function()  {
    // Inicializar la tabla con el complemento DataTables
    var table = $('#example').DataTable({
        responsive: true,
        "scrollY": "430px",
        "columnDefs": [
            {
                "orderable": false,
                "targets": -1
            } // Definir opciones para las columnas
        ],
        "lengthMenu": [
            8,
            25,
            50,
            100
        ],
        "pageLength": 8,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros", // Mensaje de cantidad de registros por página
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(Filtrado de un total de _MAX_ registros)", // Mensaje de filtrado
            "sSearch": "Buscar:", // Etiqueta del campo de búsqueda
            "oPaginate": { // Etiquetas para la paginación
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando..." // Mensaje mientras se procesa la tabla
        },
        dom: '<"top"lf>rt<"bottom"ip>' // Definir la ubicacion de de los elementos de la tabla
    }).columns.adjust().responsive.recalc(); // Ajustar las columnas y recalcular la responsividad de la tabla

});

window.jefe = {
    baja,
    aceptar,
    finalizar
}

