document.addEventListener('DOMContentLoaded', () => {
    // Captura TODOS los formularios de clase "form-suscription"
    $('.form-suscription').on('submit', function (e) {
        e.preventDefault(); // Evita que recargue la página

        var form = this;
        var $button = $(form).find('input[type="submit"]'); // Botón del formulario actual

        $.ajax({
            url: $(form).attr('action'),   // URL con el {plan}
            method: $(form).attr('method'), // POST
            data: $(form).serialize(),     // Token CSRF
            dataType: "JSON",

            beforeSend: function () {
                $button.prop('disabled', true).val('Procesando...');
            },

            success: function (data) {
                console.log(data);

                if (data.code == 1) {
                    $button.val('Redirigiendo...');

                    // Redirige al checkout de MercadoPago
                    setTimeout(() => {
                        window.location.href = data.msg.init_point;
                    }, 1000);

                    // Reactiva el botón después de 6 segundos
                    setTimeout(() => {
                        $button.prop('disabled', false).val('Suscribirme');
                    }, 6000);

                } else {
                    $button.val('Error, inténtalo de nuevo');
                    alert(data.msg);

                    setTimeout(() => {
                        $button.prop('disabled', false).val('Suscribirme');
                    }, 6000);
                }
            },

            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                alert('Ocurrió un error al procesar la solicitud.');
                $button.val('Error, inténtalo de nuevo');

                setTimeout(() => {
                    $button.prop('disabled', false).val('Suscribirme');
                }, 6000);
            }
        });
    });
});