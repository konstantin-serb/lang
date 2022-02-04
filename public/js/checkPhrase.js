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
                    check();
                }
            });
        }
    }
    // check();
}

check();
