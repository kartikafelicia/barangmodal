

var ctx = document.getElementById('grafikBarang');

new Chart(ctx, {
type: 'bar',

data: {

labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],

datasets: [
{
label: 'Penerimaan',
data: [5,10,7,8,12,6],
backgroundColor: '#696cff'
},
{
label: 'Permintaan',
data: [3,6,4,5,7,3],
backgroundColor: '#ff3e1d'
}
]

}

});
