document.addEventListener('DOMContentLoaded', () => {
    $('#form-suscription-seis-meses').on('submit', function (e) {
        e.preventDefault(); // Previene el envío tradicional del formulario.

        var form = this; // Referencia al formulario.
        var $button = $(form).find('input[type="submit"]'); // Encuentra el botón.

        $.ajax({
            url: $(form).attr('action'),  // Toma la URL del atributo `action`.
            method: $(form).attr('method'),  // Toma el método del atributo `method`.
            data: $(form).serialize(),  // Serializa los datos del formulario.
            dataType: "JSON",  // Espera una respuesta en formato JSON.

            beforeSend: function () {
                $button.prop('disabled', true).val('Procesando...');
            },

            success: function (data) {
                console.log(data);

                if (data.code == 1) {
                    $button.val('Redirigiendo...');

                    // Redirige al enlace después de 1 segundo
                    setTimeout(() => {
                       window.location.href = data.msg.init_point; // Redirige a la URL proporcionada.
                    }, 1000);

                    // Reactiva el botón después de 6 segundos para permitir otro intento
                    setTimeout(() => {
                        $button.prop('disabled', false).val('Suscribirme');
                    }, 6000);
                } else {
                    $button.val('Error, inténtalo de nuevo');
                    alert(data.msg); // Muestra un mensaje de error si hay algún problema.

                    // Reactiva el botón después de 6 segundos
                    setTimeout(() => {
                        $button.prop('disabled', false).val('Suscribirme');
                    }, 6000);
                }
            },

            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                alert('Ocurrió un error al procesar la solicitud.');
                $button.val('Error, inténtalo de nuevo');
            
                // Reactiva el botón después de 6 segundos
                setTimeout(() => {
                    $button.prop('disabled', false).val('Suscribirme');
                }, 6000);
            }
            
        });
    });
});