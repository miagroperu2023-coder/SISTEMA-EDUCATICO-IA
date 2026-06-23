document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('chat-form');
    const chatLog = document.getElementById('chat-log');
    const messageInput = document.getElementById('message');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        let message = messageInput.value;

        // Mostrar mensaje del usuario
        let userMessageDiv = document.createElement('div');
        userMessageDiv.className = 'message user-message';
        userMessageDiv.innerText = message;
        chatLog.appendChild(userMessageDiv);
        chatLog.scrollTop = chatLog.scrollHeight;

        fetch(form.action, {
            method: form.method,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: new URLSearchParams(new FormData(form))
        })
            .then(response => response.json())
            .then(data => {
                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(function (msg) {
                        let botMessageDiv = document.createElement('div');
                        botMessageDiv.className = 'message bot-message';

                        if (msg.type === 'text') {
                            botMessageDiv.innerHTML = msg.content;
                        } else if (msg.type === 'image') {
                            let img = document.createElement('img');
                            img.src = msg.content;
                            img.alt = 'Imagen de respuesta';
                            img.style.maxWidth = '100%';
                            botMessageDiv.appendChild(img);
                        }

                        chatLog.appendChild(botMessageDiv);
                        chatLog.scrollTop = chatLog.scrollHeight;
                    });
                } else {
                    let botMessageDiv = document.createElement('div');
                    botMessageDiv.className = 'message bot-message';
                    botMessageDiv.innerText = 'No se recibió respuesta del bot.';
                    chatLog.appendChild(botMessageDiv);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

        // Limpiar el input
        messageInput.value = '';
    });
});