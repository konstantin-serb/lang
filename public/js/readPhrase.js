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
                    // let str = document.querySelector('#selector'+ key + '-' + id);
                    // str.innerHTML = data.string;
                    read();
                }
            });
        }
    }
}

read();
