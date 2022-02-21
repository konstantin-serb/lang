let meta = document.querySelectorAll('meta');
for(let i = 0; i < meta.length; i++) {
    let attribute = meta[i].getAttribute('name');
    if(attribute == 'csrf-token') {
        let token = meta[i].getAttribute('content');

        let allChecks = document.querySelectorAll('.checkBox');
        for (let i = 0; i<allChecks.length; i++){
            allChecks[i].onchange = function () {
                let id = this.getAttribute('data-id');

                $.ajax({
                    url: '/dictionary/check',
                    method: 'post',
                    data: {
                        id: id,
                        _token : token
                    },

                    success: function (data) {

            }
                });
            }
        }

    }
}



