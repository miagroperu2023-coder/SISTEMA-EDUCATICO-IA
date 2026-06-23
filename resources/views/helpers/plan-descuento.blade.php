<!-- Popup -->
<div class="popup-overlay" id="popupOverlay">
    <span class="close" id="closePopup">&times;</span>

    <!-- Murciélagos -->
    <img src="https://cdn-icons-png.flaticon.com/512/6262/6262233.png" class="bat">
    <img src="https://cdn-icons-png.flaticon.com/512/6334/6334628.png" class="bat">
    <img src="https://cdn-icons-png.flaticon.com/512/9115/9115405.png" class="bat">

    <!-- Bruja volando -->
    <img src="https://cdn-icons-png.flaticon.com/512/9103/9103941.png" alt="witch" class="witch">


    <div class="popup-container">
        <input type="hidden" id="disparador" value="1">
        @foreach ($planes as $plan)
            @php
                if ($plan->promo_code === 'SEMESTRAL20') {
                    $precioOriginal = config('mercadopago.plan_seis_meses');
                } else {
                    $precioOriginal = config('mercadopago.plan_doce_meses');
                }
                $precioDescuento = $precioOriginal - $precioOriginal * ($plan->percentage / 100);
            @endphp

            <form action="{{ route('mercadopago.descuento.suscription.year.index', ['plan' => $plan->id]) }}"
                method="POST" class="form-suscription">
                @csrf
                <div
                    class="popup bg-gradient-to-b from-red-600 to-green-700 p-4 rounded-3xl shadow-lg border-2 border-white">
                    <h2 class="text-white text-center mb-2">
                        🎄 ¡Oferta Navideña! 🎅
                    </h2>
                    <p class="text-white text-center">
                        Celebra con nosotros y disfruta de un
                        <strong>{{ $plan->percentage }}% de descuento</strong>
                        en el plan <b>{{ $plan->name }}</b> 🎁
                    </p>
                    <p class="text-white text-center mt-2">
                        Usa tu cupón especial navideño:
                    </p>

                    <input type="submit"
                        class="btn-solid-sm p-4 mt-3 w-100 text-white bg-red-500 hover:bg-green-600 transition-all rounded-lg shadow"
                        value="🎅 S/ {{ $precioDescuento }} ({{ strtoupper($plan->promo_code) }}) 🎄">
                </div>
            </form>
        @endforeach
    </div>
</div>

<!-- Música -->
<audio id="musica" loop>
    <source src="{{ asset('musica/musica.mp3') }}" type="audio/mpeg">
</audio>

<!-- Disparador oculto -->
<input type="hidden" id="disparador" value="1">

<script>
    const disparador = document.getElementById("disparador");
    const musica = document.getElementById("musica");
    const popupOverlay = document.getElementById("popupOverlay");
    const closePopup = document.getElementById("closePopup");

    // Cuando el modal aparece, arranca la música
    window.addEventListener("load", () => {
        setTimeout(() => {
            // Forzamos a mostrar el modal (ejemplo: con flex)
            popupOverlay.style.display = "flex";

            if (disparador.value === "1") {
                musica.play().catch(() => {
                    console.log(
                        "El navegador bloqueó el autoplay. Esperando clic del usuario...");
                    // En móviles/Chrome: arrancar con el primer clic del usuario
                    document.addEventListener("click", iniciarMusica, {
                        once: true
                    });
                });
            }
        }, 500);
    });

    function iniciarMusica() {
        musica.play();
    }

    // Cuando se cierra el modal, detener música
    closePopup.addEventListener("click", () => {
        popupOverlay.style.display = "none";
        musica.pause();
        musica.currentTime = 0; // reinicia a 0
    });
</script>
