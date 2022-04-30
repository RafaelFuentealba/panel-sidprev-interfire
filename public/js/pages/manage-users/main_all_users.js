function activateUser(id) {
    idUser = id.getAttribute('value');
    $.ajax({
        url: window.location.origin + '/admin/gestion/usuario/activar', 
        type: 'POST',             
        data: { 'usuario-id': idUser },
        success: function(response) {
            if (response == 1) {
                swal({
                    title: "¡Excelente!",
                    text: "El usuario fue activado correctamente.",								
                    buttons: {
                        confirm: true,
                    }
                }).then(function() {
                    window.location.href = window.location.origin + '/admin/gestion/usuarios';
                });		
            }
            else {
                swal({
                    title: "¡Algo salió mal!",
                    text: "El usuario no fue activado. Inténtelo más tarde.",
                    buttons: {
                        confirm: true,
                    }
                }).then(function() {
                    window.location.href = window.location.origin + '/admin/gestion/usuarios';
                });	
            }
        },
        error: function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function blockUser(id) {
    idUser = id.getAttribute('value');
    $.ajax({
        url: window.location.origin + '/admin/gestion/usuario/bloquear', 
        type: 'POST',             
        data: { 'usuario-id': idUser },
        success: function(response) {
            if (response == 1) {
                swal({
                    title: "¡Excelente!",
                    text: "El usuario fue bloqueado correctamente.",								
                    buttons: {
                        confirm: true,
                    }
                }).then(function() {
                    window.location.href = window.location.origin + '/admin/gestion/usuarios';
                });		
            }
            else {
                swal({
                    title: "¡Algo salió mal!",
                    text: "El usuario no fue bloqueado. Inténtelo más tarde.",
                    buttons: {
                        confirm: true,
                    }
                }).then(function() {
                    window.location.href = window.location.origin + '/admin/gestion/usuarios';
                });	
            }
        },
        error: function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function activateBetaUser(id) {
    idUser = id.getAttribute('value');
    $.ajax({
        url: window.location.origin + '/admin/beta/usuario/activar', 
        type: 'POST',             
        data: { 'usuario-id': idUser },
        success: function(response) {
            if (response == 1) {
                swal({
                    title: "¡Excelente!",
                    text: "El usuario fue activado correctamente.",								
                    buttons: {
                        confirm: true,
                    }
                }).then(function() {
                    window.location.href = window.location.origin + '/admin/beta/usuarios';
                });		
            }
            else {
                swal({
                    title: "¡Algo salió mal!",
                    text: "El usuario no fue activado. Inténtelo más tarde.",
                    buttons: {
                        confirm: true,
                    }
                }).then(function() {
                    window.location.href = window.location.origin + '/admin/beta/usuarios';
                });	
            }
        },
        error: function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function blockBetaUser(id) {
    idUser = id.getAttribute('value');
    $.ajax({
        url: window.location.origin + '/admin/beta/usuario/bloquear', 
        type: 'POST',             
        data: { 'usuario-id': idUser },
        success: function(response) {
            if (response == 1) {
                swal({
                    title: "¡Excelente!",
                    text: "El usuario fue bloqueado correctamente.",								
                    buttons: {
                        confirm: true,
                    }
                }).then(function() {
                    window.location.href = window.location.origin + '/admin/beta/usuarios';
                });		
            }
            else {
                swal({
                    title: "¡Algo salió mal!",
                    text: "El usuario no fue bloqueado. Inténtelo más tarde.",
                    buttons: {
                        confirm: true,
                    }
                }).then(function() {
                    window.location.href = window.location.origin + '/admin/beta/usuarios';
                });	
            }
        },
        error: function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });
}