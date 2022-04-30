$('#btn-save-profile').on('click', function() {
    $('#form-save-profile').validate({
        rules: {
            nombre: {
                required: true,
                maxlength: 100
            },
            apellido: {
                required: true,
                maxlength: 100
            }
        },
        messages: {
            nombre: {
                required: 'Este dato es requerido',
                maxlength: 'El dato excede los 100 caracteres'
            },
            apellido: {
                required: 'Este dato es requerido',
                maxlength: 'El dato excede los 100 caracteres'
            }
        },
        submitHandler: function(form) {
            let nombre = $('#nombre').val();
            let apellido = $('#apellido').val();

            if (nombre != '' && apellido != '') {
                $.ajax({
					url: window.location.origin + '/admin/perfil/basico/guardar', 
					type: 'POST',     
					data: {
                        'usuario-nombre': nombre,
						'usuario-apellido': apellido
					},
					success: function(response) {
                        if (response == 1) {
                            swal({
                                title: "¡Excelente!",
                                text: "Los datos han sido actualizados correctamente.",								
                                buttons: {
                                    confirm: true,
                                }
                            }).then(function() {
                                window.location.href = window.location.origin + '/admin/perfil';
                            });
                        }
                        else {
                            swal({
                                title: "¡Algo salió mal!",
                                text: "No se pudo actualizar el perfil. Inténtelo más tarde.",
                                buttons: {
                                    confirm: true,
                                }
                            }).then(function() {
                                window.location.href = window.location.origin + '/admin/perfil';
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
        }
    });
});

$('#btn-save-profile-security').on('click', function() {
    $('#form-save-profile-security').validate({
        rules: {
            usuarioPassword: {
                required: true,
                minlength: 8,
                maxlength: 25
            },
            usuarioNewPassword: {
                required: true,
                minlength: 8,
                maxlength: 25
            }
        },
        messages: {
            usuarioPassword: {
                required: 'Este dato es requerido',
                minlength: 'El dato debe tener más de 8 caracteres',
                maxlength: 'El dato excede los 25 caracteres'
            },
            usuarioNewPassword: {
                required: 'Este dato es requerido',
                minlength: 'El dato debe tener más de 8 caracteres',
                maxlength: 'El dato excede los 25 caracteres'
            }
        },
        submitHandler: function(form) {
            let password = $('#usuario-password').val();
            let newPassword = $('#usuario-new-password').val();
            let failAlert = $('#fail-change-password');
            if (password != '' && newPassword != '') {
                $.ajax({
					url: window.location.origin + '/admin/perfil/seguridad/guardar', 
					type: 'POST',     
					data: {
                        'usuario-password': password,
						'usuario-new-password': newPassword
					},
					success: function(response) {
                        if (response == 1) {
                            swal({
                                title: "¡Excelente!",
                                text: "La contraseña ha sido actualizada correctamente.",								
                                buttons: {
                                    confirm: true,
                                }
                            }).then(function() {
                                window.location.href = window.location.origin + '/admin/perfil';
                            });
                        } else if (response == 0) {
                            swal({
                                title: "¡Algo salió mal!",
                                text: "No se pudo actualizar la contraseña. Inténtelo más tarde.",
                                buttons: {
                                    confirm: true,
                                }
                            }).then(function() {
                                window.location.href = window.location.origin + '/admin/perfil';
                            });
                        } else {
                            failAlert.html(JSON.parse(response));
                            failAlert.css({ 'display':'block' });
                            $('#usuario-new-password').val('');
                        }
					},
					error: function(xhr, textStatus, error){
						console.log(xhr.statusText);
						console.log(textStatus);
						console.log(error);
					}
				});
            }
        }
    });
});