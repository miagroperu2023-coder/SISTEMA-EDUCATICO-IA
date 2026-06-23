document.addEventListener('livewire:load', function () {
    // Obtener la sección actual desde el atributo del acordeón
    let accordionElement = document.getElementById('accordionFlushExample');
    let currentSectionId = accordionElement ? accordionElement.dataset.sectionId : null;

    // Si existe una sección actual, abrir su acordeón
    if (currentSectionId) {
        acordeonCargarPagina(currentSectionId);
    }

    // Evento cuando cambia la lección
    Livewire.on('lessonChanged', function (sectionId) {
        // Ocultar todos los acordeones abiertos
        document.querySelectorAll('.accordion-collapse.show').forEach(function (item) {
            item.classList.remove('show');
        });

        // Cargar la nueva sección
        acordeonCargarPagina(sectionId);
    });

    function acordeonCargarPagina(sectionId) {
        let targetId = "#flush-collapse" + sectionId;
        let targetItem = document.querySelector(targetId);

        if (targetItem) {
            targetItem.classList.add('show');
            targetItem.classList.add('accordion-collapse'); // Asegurar que usa Bootstrap
            targetItem.classList.add('collapse'); // Asegurar que usa Bootstrap
            targetItem.classList.add('show'); // Asegurar que se abre

            // Ajustar scroll
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    }
});
