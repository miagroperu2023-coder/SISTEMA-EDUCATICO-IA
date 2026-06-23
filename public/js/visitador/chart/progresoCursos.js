$(document).ready(function () {


    fetch('/graficos/data')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.course);
            const advances = data.map(item => item.advance);

            console.log('avance', advances);


            const ctx = document.getElementById('progressChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Avance (%)',
                        data: advances,
                        backgroundColor: 'rgba(240, 118, 19, 0.7)',
                        borderColor: 'rgba(240, 118, 19, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        });


});
