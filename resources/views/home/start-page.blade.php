@extends('layouts.app')
@section('title', $title = 'languages | Главная')
@section('content')
    <div class="container-fluid">
        <div class="main-button" style="color: {{ $color }}; border-color: {{ $color }};">
            <h1 class="b">Languages</h1> <br>
            <h3 class="b" >Поможет изучить любой язык</h3>        </div>
    </div>
@endsection
