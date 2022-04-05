function startLearning()
{
    let buttonChoose = document.querySelector('#buttonChoose');
    buttonChoose.onclick = function(event) {
        event.preventDefault();
        let form = document.querySelector('#form');
        let token = form.querySelector('input').value;

        let countCycles = document.querySelector('#countCycles').value;
        let task = document.querySelector('#task').value;
        let limit = document.querySelector('#limit').value;

        let chooseInputs = document.querySelectorAll('.inputBlock');
        let ids = "";
        for(let i = 0; i<chooseInputs.length; i++) {
            if(chooseInputs[i].checked) {
                ids = ids.concat(chooseInputs[i].getAttribute('data-id')) + ',';
            }
        }

        if(chooseInputs.length > 0) {
            document.location.href="/learn/mixTrain/"
                + countCycles +
                ","+ task +
                ","+ limit + "/" +
                ids;
        }

    }
}

startLearning();
