@extends('layouts.app')
@section('title', $title = 'Добавление изучаемого языка')
@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">Языки</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <h2 class="b">{{ $title }}</h2>

        <div class="row">
            <div class="col-lg-6">
                <div class="form">
                    <form action="{{ route('language.store') }}" method="post">
                        @csrf
                        <div class="mt-3">
                            <label class="mb-2">Название языка</label>
                            <input class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
                            @error('title')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="btn-group mt-4">
                            <button type="submit" class="btn btn-outline-primary">Добавить</button>
                            <a class="btn btn-outline-danger" href="{{ route('language.index') }}">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
