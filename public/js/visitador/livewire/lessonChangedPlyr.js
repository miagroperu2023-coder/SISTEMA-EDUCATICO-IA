document.addEventListener('livewire:load', function () {
    // Inicializa Plyr al cargar la página
    initPlyr();

    // Escucha el evento 'lessonChanged' para reinicializar Plyr
    Livewire.on('lessonChanged', function () {
        initPlyr();
    });
});

function initPlyr() {
    const player = new Plyr('#player', {
        controls: [
            'play-large',
            'play',
            'progress',
            'current-time',
            'duration',
            'mute',
            'volume',
            'captions',
            'settings',
            'pip',
            'airplay',
            'fullscreen'
        ],
        settings: ['captions', 'quality', 'speed', 'loop'],
        speed: {
            selected: 1,
            options: [0.5, 1, 1.5, 2]
        },
        quality: {
            default: 720,
            options: [4320, 2880, 2160, 1440, 1080, 720, 576, 480, 360]
        },
        youtube: {
            noCookie: true,
            rel: 0,
            showinfo: 0
        }
    });
}