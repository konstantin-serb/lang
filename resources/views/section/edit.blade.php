@extends('layouts.app')
@section('title', $title = __('messages.sections.section_editing'))
@section('content')


    <?php

    function getDaughtersCategory($allSections, $section, $check = null)
        {
            if (!$check) {
                foreach($allSections as $item) {

                    echo '<option value="'.$item->id.'"';
                    if ($item->id == $section->parent_id) {
                        echo 'selected';
                    }

                    if ($item->id == $section->id) {
                        echo 'disabled';
                    }
                    echo '>';
                    echo $item->title;
                    echo '</option>';


                    if ($item->id == $section->id) {
                        $check = 'disable';
                    }
                    if(!$item->sections->isEmpty()) {
                        getDaughtersCategory($item->sections, $section, $check);
                    }
                }
            }
        }

    ?>
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">{{ __('messages.main.languages') }}</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('language.show', ['language' => $section->language->id]) }}">{{ $section->language->title }}</a>
                </li>
                <?= $section->getBreadcrumb($section->id)?>
                <li class="breadcrumb-item"><a href="{{ route('section.show', ['section' => $section->id]) }}">{{ $section->title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="">{{ $title . ': ' }} <span class="b">{{ $section->title }}</span></h2>

        <div class="row">
            <div class="col-lg-12">
                <div class="form">
                    <form action="{{ route('section.update', ['section' => $section->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <label class="mb-2">
{{--                                        Название раздела--}}
                                        {{ __('messages.sections.sect_name') }}
                                    </label>
                                    <input class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ old('title', $section->title) }}">
                                    @error('title')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <label class="mb-2">
{{--                                        Родительская категория--}}
                                        {{ __('messages.sections.parent_category') }}
                                    </label>
                                    <select class="form-select" name="parent_id">
                                        <?php getDaughtersCategory($allSections, $section)?>
                                    </select>
                                    @error('description')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <label class="mb-2">
{{--                                        Комментарий, описание--}}
                                        {{ __('messages.sections.comment') }}
                                    </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              name="description">
                                {{ old('description', $section->description) }}
                            </textarea>
                                    @error('description')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="btn-group mt-4">
                            <button type="submit" class="btn btn-outline-primary">
{{--                                    Изменить--}}
                                {{ __('messages.main.change') }}
                            </button>
                            <a class="btn btn-outline-danger" href="
{{--{{ route('section.delete', ['section' => $section->id]) }}--}}
                                ">
{{--                                Удалить--}}
                                {{ __('messages.main.delete') }}
                            </a>
                            <a class="btn btn-outline-secondary"
                               href="{{ route('section.show', ['section' => $section->id]) }}">
{{--                                Отмена--}}
                                {{ __('messages.main.cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
