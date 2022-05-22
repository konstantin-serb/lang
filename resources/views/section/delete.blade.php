@extends('layouts.app')
@section('title', $title = __('messages.sections.deleteSection'))
@section('content')


    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ route('language.index') }}">{{ __('messages.main.languages') }}</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('language.show', ['language' => $section->language->id]) }}">{{ $section->language->title }}</a>
                </li>
                <?= $section->getBreadcrumb($section->id)?>
                <li class="breadcrumb-item"><a
                        href="{{ route('section.show', ['section' => $section->id]) }}">{{ $section->title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="">{{ $title . ': ' }} <span class="b">{{ $section->title }}</span></h2>

        <div class="row">
            <div class="col-lg-12">
                <div class="form">
                    <form action="{{ route('section.destroy', ['section' => $section->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="section_id" value="{{ $section->id }}">
                        <div class="row">

                                @if($section->countPhrases() > 1 )
                                <p class="b text-danger" style="font-size: 1.5rem; ">
{{--                                    В этом разделе содержится n фраз!--}}
                                    {{ __('messages.sections.attention1', ['n' => $section->countPhrases()]) }}
                                </p>
                                    <div class="">
                                        <img class="myImage" src="/img/janik.jpg">
                                    </div>
                            <br>
                                <p style="font-size: 1.2rem;  margin-top: 1em;">
                            <span class="b text-danger" style="font-size: 1.1em;">
{{--                                Если вы удалите этот раздел, все эти фразы будут удалены без возможности восстановления--}}
                                {{ __('messages.sections.attention2') }}
                            </span>
                                   </p>
                            @else
                                <p style="font-size: 1.2rem;  margin-top: 1em;">
                                    <span class="b text-info">
{{--                                В этом разделе не содержится ни одной фразы--}}
                                        {{ __('messages.sections.attention4') }}
                                    </span>
                                </p>
                                @endif

                                <h4>
{{--                                    Вы уверены, что хотите удалить раздел?--}}
                                    {{ __('messages.sections.attention3') }}
                                </h4>
                        </div>

                        <div class="btn-group mt-4">
                            <button type="submit" class="btn btn-danger">
                                {{--                                    Удалить--}}
                                {{ __('messages.main.delete') }}
                            </button>

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
