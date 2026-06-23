let plyrInstances = [];

function initPlyr() {
    // Destruir instancias anteriores
    plyrInstances.forEach(instance => instance.destroy());
    plyrInstances = [];

    const players = document.querySelectorAll('[id^="player-content-i-a"]');

    players.forEach(el => {
        const player = new Plyr(el, {
            controls: [
                'play-large', 'play', 'progress', 'current-time', 'duration',
                'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'
            ],
            settings: ['captions', 'quality', 'speed', 'loop'],
            speed: {
                selected: 1,
                options: [0.5, 1, 1.5, 2]
            },
            quality: {
                default: 720,
                options: [1080, 720, 480, 360]
            },
            youtube: {
                noCookie: true,
                rel: 0,
                showinfo: 0
            }
        });
        plyrInstances.push(player);
    });

    console.log('✅ Plyr inicializado para', players.length, 'videos');
}

// Re-inicializar Plyr después de cada render Livewire
document.addEventListener('livewire:load', function () {
    setTimeout(initPlyr, 300);
    Livewire.hook('message.processed', (message, component) => {
        setTimeout(initPlyr, 300);
    });
});
