window.addEventListener('DOMContentLoaded', () => {

    $('#form-cart-venta').on('submit', function (e) {
        e.preventDefault();

        console.log($('#form-cart-venta').serialize());
        $.ajax({
            url: "/mercadopago/payment",
            method: "POST",
            data: $('#form-cart-venta').serialize(),
            dataType: "JSON",

            beforeSend: function () { $('#form-cart-venta').find('#checkout-btn').attr('disabled', true) }, //desabilitamos

            success: function (data) {
                console.log('Datos : ', data);

                /*CREANDO EL BOTON DE PAGO MERCADOPAGO*/
                const mp = new MercadoPago(data.msg.public_key);
                mp.bricks().create("wallet", "wallet_container", {
                    initialization: {
                        preferenceId: data.msg.preference_id,
                        redirectMode: "self",
                        //redirectMode: "modal"
                    },
                    callbacks: {
                        onReady: () => { },
                        onSubmit: () => { },
                        onError: (error) => console.error('error arrojado',error),
                    },
                    customization: {
                        visual: {
                            buttonBackground: 'black',
                            borderRadius: '16px',
                        },
                        texts: {
                            action: 'pay',
                            valueProp: 'security_details',
                        },
                    },
                });
            }
        });
    });

});