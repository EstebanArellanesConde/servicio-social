import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
$(document).ready(function() {

// Inicializar la tabla con el complemento DataTables
var table = $('#example').DataTable({
responsive: true, // Opción para hacer la tabla responsive
"scrollY": "430px", // Establecer una altura fija y agregar una barra de desplazamiento vertical
"columnDefs": [
{"orderable": false, "targets": -1} // Definir opciones para las columnas
],
"lengthMenu": [8, 25, 50, 100], // Opciones para la paginación
"pageLength": 8, // Cantidad de registros mostrados por página de manera predeterminada
// Traducciones personalizadas para la interfaz de usuario
"language": {
"lengthMenu": "Mostrar _MENU_ registros", // Mensaje de cantidad de registros por página
"zeroRecords": "No se encontraron resultados", // Mensaje cuando no se encuentran registros
"info": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros", // Mensaje de información de paginación
"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros", // Mensaje cuando no hay registros
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

const tableContainer = document.getElementById('recipients'); // Obtener el contenedor de la tabla

// Agregar el evento click usando delegación de eventos para abrir los modales
tableContainer.addEventListener('click', (event) => {
const button = event.target.closest('.showModal'); // Buscar el botón más cercano con la clase 'showModal'
if (button) {
const modalId = button.getAttribute('data-modal-id'); // Obtener el ID del modal desde el atributo 'data-modal-id' del botón
const modal = document.getElementById(modalId); // Obtener el modal usando el ID y mostrarlo
modal.classList.add('flex'); // Mostrar el modal cambiando su clase a 'flex'
modal.classList.remove('hidden'); // Asegurarse de que no tenga la clase 'hidden'
}
});

// Agregar el evento click usando delegación de eventos para cerrar los modales
tableContainer.addEventListener('click', (event) => {
const button = event.target.closest('.closeModal'); // Buscar el botón más cercano con la clase 'closeModal'
if (button) {
const modal = button.closest('.modal'); // Obtener el modal más cercano al botón y ocultarlo
modal.classList.remove('flex'); // Ocultar el modal quitando la clase 'flex'
modal.classList.add('hidden'); // Asegurarse de que tenga la clase 'hidden'
}
});
});

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
