function openModal() {

    document.querySelector('#idUsers').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector('#updated_att').innerHTML = "";
    document.querySelector('#formUsers').reset();

    $('#modalFormUsers').modal('show');
}