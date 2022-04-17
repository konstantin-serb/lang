@extends('layouts.app')
@section('title', $title = 'Статистика изучения языков')
@section('content')
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">Языки</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <form id="form" action="" method="post">
            @csrf
        </form>

        <h2 class="b">{{ $title }}</h2>

        <div class="mt-5">
            @foreach($languages as $item)
                <div class="mt-5">
                    <h3>{{ $item->title }}</h3>
                    <div class="row">
                        <div class="col-lg-3">
                            <?php $created = \App\Models\Statistics::getStatisticTotal($item->id)->sum('created');?>
                            @if($created > 100) <a href="{{ route('statistic.diagram1', ['language_id' => $item->id, 'type' => 'created']) }}" class="link"> @endif
                            Общее количество фраз:   <span class="b text-primary">{{ $created }}</span>
                            @if($created > 100) </a> @endif
                        </div>
                        <div class="col-lg-3">
                            <span>Повторено раз: </span>  <span class="b text-primary">{{ \App\Models\Statistics::getRepeatedTotal($item->id) }}</span>
                        </div>

                        <div class="col-lg-3">
                        <span>Прочитано раз: </span>  <span class="b text-primary">{{ \App\Models\Statistics::getReadTotal($item->id) }}</span>
                        </div>

                        <div class="col-lg-3">
                            <span>Словарный запас: </span>  <span class="b text-primary">{{ \App\Models\Dictionary::getForLanguageAll($item->id)->count() }}</span>
                        </div>
                    </div>
                </div>
            <hr>
            @endforeach
        </div>


    </div>
@endsection
