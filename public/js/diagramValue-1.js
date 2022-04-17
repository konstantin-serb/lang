let inputs = document.querySelectorAll('.inputValue');
let scheduleInput = document.querySelector('#scheduleValue');

console.log(scheduleInput);

let name1 = scheduleInput.getAttribute('data-name');
let name2 = scheduleInput.getAttribute('data-progressName');

let dates = [];
let countAsc = [];
let progress = [];
for(i = 0; i < inputs.length; i++) {
    dates[i] = inputs[i].getAttribute('data-date');
    countAsc[i] = inputs[i].getAttribute('data-count');
    progress[i] = inputs[i].getAttribute('data-progress');
}

console.log(progress);
