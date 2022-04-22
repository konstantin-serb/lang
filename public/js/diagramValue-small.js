let inputs = document.querySelectorAll('.inputValue');
let scheduleInput = document.querySelector('#scheduleValue');

let name1 = scheduleInput.getAttribute('data-firstName');
let name2 = scheduleInput.getAttribute('data-secondName');
let nameProgress1 = scheduleInput.getAttribute('data-firstProgressName');
let nameProgress2 = scheduleInput.getAttribute('data-secondProgressName');
let color1 = scheduleInput.getAttribute('data-color1');
let color2 = scheduleInput.getAttribute('data-color2');
let bg1 = scheduleInput.getAttribute('data-bg1');
let bg2 = scheduleInput.getAttribute('data-bg2');

let dates = [];
let countAsc1 = [];
let countAsc2 = [];
let progress1 = [];
let progress2 = [];
for(i = 0; i < inputs.length; i++) {
    dates[i] = inputs[i].getAttribute('data-date');
    countAsc1[i] = inputs[i].getAttribute('data-countFirst');
    countAsc2[i] = inputs[i].getAttribute('data-countSecond');
    progress1[i] = inputs[i].getAttribute('data-progressFirst');
    progress2[i] = inputs[i].getAttribute('data-progressSecond');
}

