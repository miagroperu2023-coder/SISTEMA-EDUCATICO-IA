window.addEventListener('DOMContentLoaded', () => {
    $('#fromLinkCaido').on('submit', function (e) {
        e.preventDefault(); // Previene el comportamiento predeterminado del formulario.

        var form = this;
        var alertButton = $('#alertButton'); // Selección del botón con jQuery.

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            contentType: false,
            dataType: 'json',

            beforeSend: function () {
                // Cambia el texto del botón y lo desactiva.
                alertButton.prop('disabled', true).text('Procesando...');
            },

            success: function (data) {
                console.log(data);
                if (data.code === 1) {
                    Swal.fire({
                        position: "bottom-end",
                        icon: "success",
                        title: 'Tu alerta se envió: ' + data.msg.name,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        position: "bottom-end",
                        icon: "error",
                        title: 'Alerta no enviada: ' + data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },

            complete: function () {
                // Reactivar el botón y restaurar el texto.
                alertButton.prop('disabled', false).text('Alertar Link caido');
            },

            error: function () {
                Swal.fire({
                    position: "bottom-end",
                    icon: "error",
                    title: 'Ocurrió un error al enviar la alerta',
                    showConfirmButton: false,
                    timer: 1500
                });

                alertButton.prop('disabled', false).text('Alertar Link caido');
            }
        });
    });



    //PARA DESACTIVAR EL BOTON DE DESCARGA
    $('#descargaArchivoCourseStatus').on('click', function (event) {
        var $button = $(this);

        // Cambiar texto para indicar que se está descargando
        $button.text('Descargando archivo...');

        // Añadir clase 'disabled-link' para desactivar el enlace visualmente y funcionalmente
        $button.addClass('disabled-link');

        // Deshabilitar más clics previniendo la acción predeterminada
        event.preventDefault();

        // Iniciar la descarga manualmente después de un breve retraso
        setTimeout(function () {
            window.location.href = $button.attr('href');
        }, 5000); // Inicia la descarga después de 5 segundos

        // Rehabilitar el enlace después de 7 segundos
        setTimeout(function () {
            // Restaurar el texto original y remover la clase 'disabled-link' para volver a habilitar el enlace
            $button.text('Descargar Archivo');
            $button.removeClass('disabled-link');
        }, 7000); // 6 segundos
    });
});
