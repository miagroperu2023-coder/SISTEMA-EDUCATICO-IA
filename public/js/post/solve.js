$(function () {
    console.log('FIRMA CARGADA DESDE AJAX');

    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255,255,255)' // importante: fondo blanco
    });

    function resizeCanvas() {
        let ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear(); // limpiar al redimensionar
    }

    // inicializa el tamaño
    resizeCanvas();

    // cuando cambie el tamaño de pantalla
    window.addEventListener("resize", resizeCanvas);

    // --- Herramientas ---
    let currentColor = "#000000";
    let currentSize = 2;

    $("#tool-pencil").on("click", function () {
        signaturePad.penColor = currentColor;
    });

    $("#tool-eraser").on("click", function () {
        signaturePad.penColor = "#ffffff"; // fondo blanco = borrar
    });

    $("#tool-color").on("change", function () {
        currentColor = $(this).val();
        signaturePad.penColor = currentColor;
    });

    $("#tool-size").on("change", function () {
        currentSize = parseInt($(this).val());
        signaturePad.minWidth = currentSize;
        signaturePad.maxWidth = currentSize + 1; // un poco más para suavidad
    });

    $('#limpiarFirma').on('click', function () {
        limpiarFirma();
    });

    $('#frmAjaxFirma').on('submit', function (e) {
        e.preventDefault();

        let formEl = document.getElementById("frmAjaxFirma");
        let formData = new FormData(formEl);

        guardarFirma(formEl, formData);
    });

    function guardarFirma(formEl, formData) {
        if (signaturePad.isEmpty()) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Por favor, realice la solución del problema para publicarlo.',
                showConfirmButton: true
            });
            return;
        }

        // Agregar la firma en Base64 al FormData
        formData.set("signature", signaturePad.toDataURL("image/png"));

        $.ajax({
            url: $(formEl).attr('action'),
            method: $(formEl).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',

            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(formEl).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    signaturePad.clear();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        // Redirigir a la ruta con el post_id
                        window.location.href = "/post/comunidad/comment/" + data.post_id;
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Hubo un error al guardar la firma.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.reload();
                });
            }
        });
    }

    function verPublicacionComentada() {

    }

    function limpiarFirma() {
        signaturePad.clear();
    }
});
