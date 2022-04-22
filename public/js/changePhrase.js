function changePhrase() {
    let form12 = document.querySelector('#form');
    let token12 = form12.querySelector('input').value;
    let changePhraseButtons = document.querySelectorAll('.yesButton');
    for(let i = 0; i < changePhraseButtons.length; i++) {
        changePhraseButtons[i].onclick = function (event) {
            event.preventDefault();
            let id = changePhraseButtons[i].getAttribute('data-id');
            let key = changePhraseButtons[i].getAttribute('data-key');
            let phraseSelector = '#phrase-' + key + '-' + id;
            let baseSelector = '#base-' + key + '-' + id;
            let transSelector = '#trans-' + key + '-' + id;
            let compSelector = '#comp-' + key + '-' + id;

            let phrase = document.querySelector(phraseSelector).value;
            let base = document.querySelector(baseSelector).value;
            let trans = document.querySelector(transSelector).value;
            let complex = document.querySelector(compSelector).value;

            $.ajax({
                url: '/phrase/change-ajax',
                method: 'post',
                data: {
                    _token: token12,
                    phrase: phrase,
                    translate: base,
                    transcription: trans,
                    complexity: complex,
                    id: id
                },
                success: function(data)
                {
                    if(data) {
                        let translateClassSelector = '.translate-' + id;
                        let phraseClassSelector = '.phrase-' + id;

                        let translateClassInputs = '.input-translate-' + id;
                        let phraseClassInputs = '.input-phrase-' + id;
                        let transcriptionClassInputs = '.input-transcription-' + id;


                        let allTranslate = document.querySelectorAll(translateClassSelector);
                        let allPhrase = document.querySelectorAll(phraseClassSelector);
                        let allTranslateInputs = document.querySelectorAll(translateClassInputs);
                        let allPhraseInputs = document.querySelectorAll(phraseClassInputs);
                        let allTranscriptionInputs = document.querySelectorAll(transcriptionClassInputs);


                        for(let i = 0; i<allTranslate.length; i++) {
                            allTranslate[i].innerHTML = base;
                            allTranslate[i].title = trans;
                            allPhrase[i].innerHTML = phrase;
                            allPhrase[i].title = trans;

                            allTranslateInputs[i].value = base;
                            allPhraseInputs[i].value = phrase;
                            allTranscriptionInputs[i].value = trans;


                        }
                    }
                }
            });

        }
    }

}

changePhrase();
