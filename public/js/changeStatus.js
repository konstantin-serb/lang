function changeStatus()
{
    let inputsStatus = document.querySelectorAll('.check-status');
    let form11 = document.querySelector('#form');
    for (let i = 0; i<inputsStatus.length; i++) {
        inputsStatus[i].onchange = function () {
            let id1 = this.getAttribute('data-id');
            let token1 = form11.querySelector('input').value;

            $.ajax({
                method: 'post',
                url: '/phrase/changeStatus',
                data: {
                    id: id1,
                    _token: token1,
                },
                success: function (data) {
                    return true;
                }
            });
        }
    }
}

changeStatus();
