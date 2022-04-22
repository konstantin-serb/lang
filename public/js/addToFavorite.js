function addToFavorite()
{
    let favoriteChecks = document.querySelectorAll('.favorite');
    for(let i = 0; i < favoriteChecks.length; i++) {
        favoriteChecks[i].onchange = function () {
            let idPhrase = favoriteChecks[i].getAttribute('data-id');
            let codeFavoriteInput = document.querySelector('#form');
            let tokenFavorite = codeFavoriteInput.querySelector('input').value;

            $.ajax({
                url: '/phrase/change-favorite-ajax',
                method: 'post',
                data: {
                    id: idPhrase,
                    _token: tokenFavorite,
                },
                success: function(data) {
                    let favoriteSelector = '.favorite-' + idPhrase;
                    let spanFavorites = document.querySelectorAll(favoriteSelector);
                    for(let i = 0; i < spanFavorites.length; i++) {
                        spanFavorites[i].innerHTML = data;
                    }
                    addToFavorite();
                }
            });
        }
    }
}

addToFavorite();
