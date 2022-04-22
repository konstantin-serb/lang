let labels = dates;
const data = {
    labels: labels,
    datasets: [{
        label: name1,
        data: progress1,
        fill: true,
        borderColor: color1,
        tension: 0.15
    },

    ]
};

const data2 = {
    labels: labels,
    datasets: [{
        label: nameProgress1,
        data: countAsc1,
        backgroundColor: bg1,
        borderColor: color1,
        borderWidth: 1
    } ,
    ]
};

const config = {
    type: 'line',
    data: data,
};

const config2 = {
    type: 'bar',
    data: data2,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    },
};



const myChart = new Chart(
    document.getElementById('myChart'),
    config);


const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
);
