@extends('layouts.app')
@section('title', $title = 'languages | Главная')
@section('content')
    <div class="container-fluid">
        <div class="main-button" style="color: {{ $color }}; border-color: {{ $color }};">
            <h1 class="b text-center">Languages</h1> <br>
            <h3 class="b text-center" >
{{--                Поможет изучить любой язык--}}
                @lang('messages.main.slogan')
            </h3>        </div>
    </div>
@endsection
