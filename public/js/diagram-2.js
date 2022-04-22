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
        backgroundColor: [
            // 'rgba(255, 99, 132, 0.2)',
            // 'rgba(255, 159, 64, 0.2)',
            // 'rgba(255, 205, 86, 0.2)',
            // 'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            // 'rgba(153, 102, 255, 0.2)',
            // 'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
            // 'rgb(255, 99, 132)',
            // 'rgb(255, 159, 64)',
            // 'rgb(255, 205, 86)',
            // 'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            // 'rgb(153, 102, 255)',
            // 'rgb(201, 203, 207)'
        ],
        borderWidth: 1
    } ,
        {
            label: name2,
            data: progress,
            backgroundColor: [
                // 'rgba(255, 99, 132, 0.2)',
                // 'rgba(255, 159, 64, 0.2)',
                // 'rgba(255, 205, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                // 'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                // 'rgb(255, 99, 132)',
                // 'rgb(255, 159, 64)',
                // 'rgb(255, 205, 86)',
                // 'rgb(75, 192, 192)',
                // 'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                // 'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }
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
