var tableRoles;

document.addEventListener('DOMContentLoaded', function() {
    
    tableRoles = $('#tableRoles').dataTable( {
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url":"https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"Role/getRoles",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_roles"},
            {"data":"name_role"},
            {"data":"description_role"},
            {"data":"role_status"} ,
            {"data":"created_att"},
            {"data":"options"}
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"desc"]]
    });

    //nuevo rol
    var formRole = document.querySelector("#formRole");
    formRole.onsubmit = function(e){
        e.preventDefault(); 
        var id_roles = document.querySelector('#idRole').value;
        var name_role = document.querySelector('#name_role').value;
        var description_role = document.querySelector('#description_role').value;
        var role_status = document.querySelector('#role_status').value;
        if (name_role == '' || description_role == '' || role_status == '') 
        {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'Role/setRole';
        var formData = new FormData(formRole);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        
        request.onreadystatechange = function () {
            
            if (request.readyState == 4 && request.status == 200) {
                
                var objData = JSON.parse(request.responseText);

                if (objData.status) 
                {
                    $('#modalFormRole').modal("hide");
                    formRole.reset();
                    swal("Roles de usuario", objData.msg , "success");
                    tableRoles.api().ajax.reload(function() {
                        ftnEditRol();
                        ftnDelRol();
                        //ftnPermisos();
                    });
                }else{
                    swal("Error", objData.msg , "error")
                }
            }
        }
    }
});

$('#sampleTable').DataTable();

function openModal() {

    document.querySelector('#idRole').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector('#updated_att').innerHTML = "";
    document.querySelector('#formRole').reset();

    $('#modalFormRole').modal('show');
}

window.addEventListener('load',function () {
    ftnEditRol();
    ftnDelRol();
}, false);

function ftnEditRol() {
    var btnEditRole = document.querySelectorAll(".btnEditRole");
    btnEditRole.forEach(function (btnEditRole) {
        btnEditRole.addEventListener('click',function () {

            document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML = "Actualizar";

            var id_roles = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'role/getRole/'+id_roles;
            request.open("GET",ajaxUrl,true);
            request.send();

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) 
                    {
                        document.querySelector('#idRole').value = objData.data.id_roles;
                        document.querySelector('#name_role').value = objData.data.name_role;
                        document.querySelector('#description_role').value = objData.data.description_role;

                        if (objData.data.status == 1) {
                            var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                        } else {
                            var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                        }

                        var htmlSelect = `${optionSelect}
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                        `;
                        
                        document.querySelector('#role_status').innerHTML = htmlSelect;
                        document.querySelector('#updated_att').innerHTML = "Ultima actualización: ".concat(objData.data.updated_att);
                        $('#modalFormRole').modal('show');
                    }else {
                        swal("Error", objData.msg , "error");
                    }
                }
            }

            
        });
    });
}

function ftnDelRol() {
    var btnDelRole = document.querySelectorAll(".btnDelRole");
    btnDelRole.forEach(function (btnDelRole) {
        btnDelRole.addEventListener('click',function () {
            var id_roles = this.getAttribute("rl");

            swal({
                title: "Eliminar Rol",
                text: "¿Realmente quiere eliminar el rol?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No, cancelar!",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {
                
                if (isConfirm) 
                {
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'Role/delRole/';
                    var strData = "idRole="+id_roles;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange = function () {
                        var objData = JSON.parse(request.responseText);
                        if (objData.status) 
                        {
                            swal("Eliminar", objData.msg , "success");
                            tableRoles.api().ajax.reload(function () {
                                ftnEditRol();
                                ftnDelRol();
                            })
                        }else{
                            swal("Atención", objData.msg , "error");
                        }
                    }
                }
            });
        });
    });
}