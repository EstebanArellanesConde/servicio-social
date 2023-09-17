import './bootstrap';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;

Alpine.start();


$(document).ready(function() {
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

    const tableContainer = document.getElementById('recipients');

    tableContainer.addEventListener('click', (event) => {
        const button = event.target.closest('.showModal');
        if (button) {
            const modalId = button.getAttribute('data-modal-id'); // Obtener el ID del modal desde el atributo 'data-modal-id' del botón
            const modal = document.getElementById(modalId); // Obtener el modal usando el ID y mostrarlo
            modal.classList.add('flex');
            modal.classList.remove('hidden');
        }
    });

    tableContainer.addEventListener('click', (event) => {
        const button = event.target.closest('.closeModal');
        if (button) {
            const modal = button.closest('.modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    });

});
