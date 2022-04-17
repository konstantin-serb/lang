let labels = dates;
const data = {
    labels: labels,
    datasets: [{
        label: name1,
        data: progress,
        fill: true,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.15
    }]
};


const data2 = {
    labels: labels,
    datasets: [{
        label: name2,
        data: countAsc,
        fill: true,
        borderColor: 'rgb(255, 99, 132)',
        tension: 0.15
    }]
};

const config = {
    type: 'line',
    data: data,
};

const config2 = {
    type: 'line',
    data: data2,
};



const myChart = new Chart(
    document.getElementById('myChart'),
    config);


const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
);
