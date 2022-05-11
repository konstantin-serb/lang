@extends('layouts.app')
@section('title', $title = __('messages.sections.add_sect'))
@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">{{ __('messages.main.languages') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('language.show', ['language' => $language->id]) }}">{{ $language->title }}</a></li>
                @if(isset($currentSection))
                <?= $currentSection->getBreadcrumb($currentSection->id)?>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('section.show', ['section' => $currentSection->id]) }}">
                        {{ $currentSection->title }}
                    </a>
                </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="b">{{ $title }}</h2>

        <div class="row">
            <div class="col-lg-6">
                <div class="form">
                    <form action="{{ route('section.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="language_id" value="{{ $language->id }}">
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <div class="mt-3">
                            <label class="mb-2">
{{--                                Название раздела--}}
                                {{ __('messages.sections.sect_name') }}
                            </label>
                            <input class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autofocus>
                            @error('title')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label class="mb-2">
{{--                                Комментарий, описание--}}
                                {{ __('messages.sections.comment') }}
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description">
                                {{ old('description') }}
                            </textarea>
                            @error('description')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="btn-group mt-4">
                            <button type="submit" class="btn btn-outline-primary">
{{--                                Добавить--}}
                                {{ __('messages.languages.add_sec') }}
                            </button>
                            <a class="btn btn-outline-danger"

                               href="{{ route('section.show', ['section' => $parent_id]) }}"
                            >
{{--                                Отмена--}}
                                {{ __('messages.languages.cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
