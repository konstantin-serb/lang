<label class="mb-2">
{{--    Уровень сложности--}}
    {{ __('messages.sections.diff_level') }}
</label>
<select class="form-select inp-text "
        name="complexity" autocomplete="off" spellcheck="false">
    <option value="1">
{{--        Легкий--}}
        {{ __('messages.sections.easy') }}
    </option>
    <option value="2" selected>
{{--        Средний--}}
        {{ __('messages.sections.medium') }}
    </option>
    <option value="3">
{{--        Сложный--}}
        {{ __('messages.sections.hard') }}
    </option>
</select>
