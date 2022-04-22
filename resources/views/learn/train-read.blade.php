@extends('layouts.app')
@section('title', $title = 'Упражнение по чтению')
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/readPhrase.js"></script>
    <script src="/js/changePhrase.js"></script>
    <script src="/js/addToFavorite.js"></script>
@endpush
@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('train.index') }}">Тренировка</a></li>
                <li class="breadcrumb-item"><a href="javascript:history.back()">Результаты поиска</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="b">{{ $title }}</h2>
        <form id="form" action="" method="post">
            @csrf
        </form>


        <hr>
        <span class=" h5">Сгененировано <span class="b">{{ count($endCollection) }}</span> строк</span>
        @if(!$endCollection == null)
            <div class="h5 mt-5">
                @foreach($endCollection as $key=>$value)
                    <div class="row mt-2" style="border-bottom:gray dashed 1px">

                        <div class="col-lg-11" >
                            <input class="form-check-input readInput" type="radio" id="radioNoLabel1" value="" data-id="{{ $value->id }}"
                                   style="vertical-align: 0.001em; width: 0.8em; height: 0.8em;" >
                            &nbsp;<?php $type = 'read'?>
                            @include('learn.parts.editModal')


                            <span style="vertical-align: bottom;" class="phrase-{{ $value->id }}"
                                          @if($value->transcription)
                                          title="({{ $value->transcription }})"
                                          @endif
                            >{{ $value->phrase }}
                             </span> &nbsp;
                            <span class="cloRead translate-{{ $value->id }}" style="">
                                {{ $value->translate }}
                            </span> &nbsp;
                        </div>

                        <div class="col-lg-1">
                            <span class="countRead count{{ $value->id }}">
                                @if(!$value->reading)
                                    0
                                @else
                                    {{ $value->reading }}
                                @endif
                            </span>
                        </div>

                    </div>

                @endforeach
            </div>

        @endif


    </div>
@endsection
