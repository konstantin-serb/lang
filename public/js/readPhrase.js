function read() {
    let inputs = document.querySelectorAll('.readInput');
    let form = document.querySelector('#form');
    let token = form.querySelector('input').value;

    for(let i = 0; i < inputs.length; i++) {
        inputs[i].onchange = function () {
            let id = this.getAttribute('data-id');

            $.ajax({
                method: 'post',
                url : '/learn/read',
                data: {
                    _token: token,
                    id: id,
                },
                success: function(data) {
                    let readAll = document.querySelector('#read');
                    readAll.innerHTML = data.read;
                    let timeTop = document.querySelector('#time');
                    timeTop.innerHTML = data.timeTop;
                    let countPhrases = document.querySelectorAll('.count' + id);
                    for(let i = 0; i < countPhrases.length; i++) {
                        countPhrases[i].innerHTML = data.phrase_read;
                    }
                    read();

                }
            });
        }
    }
}

read();
