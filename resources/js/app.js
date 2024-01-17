import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus'

window.Alpine = Alpine;
Alpine.plugin(focus)
Alpine.start();

$(document).ready(() => {
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
