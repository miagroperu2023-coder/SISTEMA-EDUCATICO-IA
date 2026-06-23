document.addEventListener("DOMContentLoaded", function () {
    // Manejar el envío del formulario
    document.getElementById("paymentForm").addEventListener("submit", function (event) {
        // Desactivar el botón después de hacer clic
        document.getElementById("btn-pago-yape").disabled = true;
    });

    // Validar el campo payment_id
    document.getElementById("payment_id").addEventListener("input", function () {
        var paymentIdInput = this;
        var value = paymentIdInput.value;

        // Validar que sea un número de 8 dígitos
        if (/^\d{8}$/.test(value)) {
            // El número es válido, quitar cualquier clase de error y habilitar el botón
            paymentIdInput.classList.remove("is-invalid");
            document.getElementById("btn-pago-yape").disabled = false;
        } else {
            // El número no es válido, agregar una clase de error y deshabilitar el botón
            paymentIdInput.classList.add("is-invalid");
            document.getElementById("btn-pago-yape").disabled = true;
        }
    });
});
