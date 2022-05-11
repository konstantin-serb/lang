

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">

        <form action="{{ route('options.changeLanguageDefault') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        @if($languageDefault)
{{--                            Изменить язык по умолчанию--}}
                            {{ __('messages.home.changeLanguageDefault') }}
                        @else
{{--                            Назначить язык по умолчанию--}}
                            {{ __('messages.home.setLanguageDefault') }}
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="page" value="{{ $page }}">
                    <label class="mb-2">
{{--                        Выберите язык и нажмите применить--}}
                        {{ __('messages.home.change_and_close') }}
                    </label>
                    <select name="language_id" class="form-select">
                        @foreach($languages as $item)
                            <option value="{{ $item->id }}"
                                    @if($languageDefault)
                                    @if($item->id == $languageDefault->id) selected @endif
                                @endif

                            >{{ $item->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.home.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('messages.home.set') }}</button>
                </div>
            </div>
        </form>

    </div>
</div>
