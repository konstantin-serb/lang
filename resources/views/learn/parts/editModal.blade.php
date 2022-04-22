<!-- Button trigger modal -->
<button type="button" class="myLink no-button" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$key}}-{{ $value->id }}"
        style="border: none; background-color: #f8fafc;" tabindex="-1">
    {{ $key + 1 }}.
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal-{{$key}}-{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title b" id="exampleModalLabel">Редактирование фразы</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="col-lg-12 mb-3">
                        <label class="mb-2 text-primary" style="font-size: 1rem;">Родной базовый язык</label>
                        <input id="base-{{ $key }}-{{ $value->id }}" class="form-control input-translate-{{ $value->id }}" type="text" value="{{ $value->translate }}"
                               style="font-size: 1.125rem">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="mb-2 text-primary" style="font-size: 1rem;">{{ $value->language->title }}</label>
                        <input id="phrase-{{ $key }}-{{ $value->id }}" class="form-control input-phrase-{{ $value->id }}" type="text" value="{{ $value->phrase }}"
                               style="font-size: 1.125rem">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label class="mb-2 text-primary" style="font-size: 1rem;">
                            Транскрипция
                        </label>
                        <input id="trans-{{ $key }}-{{ $value->id }}" class="form-control input-transcription-{{ $value->id }}" type="text" value="{{ $value->transcription }}"
                               style="font-size: 1.125rem">
                    </div>


                    <div class="col-lg-12 mb-3">
                        <label class="mb-2 text-primary" style="font-size: 1rem;">
                            Уровень сложности
                        </label>
                        <select id="comp-{{ $key }}-{{ $value->id }}" class="form-select"
                                name="complexity" autocomplete="off" spellcheck="false" style="font-size: 1.125rem"
                                @if($type == 'learn' && $compl) disabled @endif>
                            <option value="1" @if($value->complexity == 1) selected @endif>Легкий</option>
                            <option value="2" @if($value->complexity == 2) selected @endif>Средний</option>
                            <option value="3" @if($value->complexity == 3) selected @endif>Сложный</option>
                        </select>
                    </div>

                    <div class="col-lg-12 mb-3" >
                        <div class="mt-3">
                            <label class="">Избранное</label> &nbsp;
                            <span class="favorite-{{ $value->id }}">
                            <input class="favorite" type="checkbox" data-id="{{ $value->id }}"
                                   @if($value->type == 1)
                                   checked
                                   @endif
                                   style="align-self: start;"
                            >

                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-5">Повторено раз: </div>
                        <div class="col-2">
                                @if($type == 'learn') <span class="b count{{ $value->id }}">  @endif
                                {{ $value->getCountLearning() }}
                                    @if($type == 'read') </span> @endif
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-5">Прочитано раз: </div>
                        <div class="col-2">
                                @if($type == 'read') <span class="b count{{ $value->id }}"> @endif
                                {{ $value->getCountReading() }}
                                    @if($type == 'read') </span> @endif
                            </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <a  href="#" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</a>
                <a  href="#" class="btn btn-primary yesButton" data-bs-dismiss="modal"
                    data-key="{{ $key }}"
                    data-id="{{ $value->id }}">
                    Сохранить
                </a>
                <a  href="{{ route('phrase.edit', ['phrase' => $value->id]) }}" class="btn btn-success" target="_blank" >Перейти в редактирование</a>
            </div>
        </div>
    </div>
</div>
