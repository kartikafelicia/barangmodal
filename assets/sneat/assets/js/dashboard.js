document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('grafikBarang');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Jan','Feb','Mar','Apr','Mei','Jun',
                'Jul','Agu','Sep','Okt','Nov','Des'
            ],
            datasets: [
                {
                    label: 'Penerimaan',
                    data: penerimaanChart,
                    backgroundColor: '#696cff'
                },
                {
                    label: 'Permintaan',
                    data: permintaanChart,
                    backgroundColor: '#ff3e1d'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

});