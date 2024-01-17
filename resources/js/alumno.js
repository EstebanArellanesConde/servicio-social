
function agregarActividad(){
    Livewire.emit('agregarActividad')
}

function eliminarActividad(index){
    console.log(index)
    Livewire.emit('eliminarActividad', index)
}

window.alumno = {
    agregarActividad,
    eliminarActividad
}
