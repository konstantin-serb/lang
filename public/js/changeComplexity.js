function changeComplexity()
{
    let inputs = document.querySelectorAll('.form-check-input');
    let form = document.querySelector('#form');
    for (let i = 0; i<inputs.length; i++) {
        inputs[i].onchange = function () {
            let id = this.getAttribute('data-id');
            let type = this.getAttribute('data-type');
            let token = form.querySelector('input').value;

            $.ajax({
                method: 'post',
                url: '/learn/changeComplexity',
                data: {
                    id: id,
                    type: type,
                    _token: token,
                },
                success: function (data) {
                    changeComplexity();
                    return true;
                }
            });
        }
    }
}

changeComplexity();
