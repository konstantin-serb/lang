function check() {
    let inputs = document.querySelectorAll('.my-input');
    let form = document.querySelector('#form');
    let token = form.querySelector('input').value;

    for(let i = 0; i < inputs.length; i++) {
        inputs[i].onchange = function () {
            let id = this.getAttribute('data-id');
            let words = this.value;
            let key = this.getAttribute('data-num');

            $.ajax({
                method: 'post',
                url : '/learn/check',
                data: {
                    _token: token,
                    id: id,
                    value: words,
                    key: key,
                },
                success: function(data) {
                    let str = document.querySelector('#selector'+ key + '-' + id);
                    str.innerHTML = data.string;
                    if(data.repeated) {
                        let repeated = document.querySelector('#repeated');
                        repeated.innerHTML = data.repeated;
                    }

                    let timeTop = document.querySelector('#time');
                    timeTop.innerHTML = data.timeTop;

                    if(data.phrase_count) {
                        let countPhrases = document.querySelectorAll('.count' + id);
                        for(let i = 0; i < countPhrases.length; i++) {
                            countPhrases[i].innerHTML = data.phrase_count;
                        }
                    }

                    check();
                }
            });
        }
    }
}

check();
