@extends('layouts.app')
@section('title', $title = __('messages.options.password_change'))
@section('content')
<div class="container" style="min-height: 60vh">
    <nav
        style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.train.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('options') }}">{{ __('messages.options.options') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
        </ol>
    </nav>
    <hr>

    <h2 class="b">{{ $title }}</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="min-height: 25em; margin-top: 3em;">
                <div class="card-header">{{ $title }}</div>
                @if( session()->has('messageSuccess') )
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ __('messages.options.attention') }}!</strong> {{ session()->get('messageSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if( session()->has('passwordOld') )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ __('messages.options.attention') }}!</strong> {{ session()->get('passwordOld') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-body" style="padding-top: 2em;">

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="row mb-3">
                            <label for="passwordOld" class="col-md-4 col-form-label text-md-end">{{ __('messages.options.old_password') }}</label>

                            <div class="col-md-6">
                                <input id="passwordOld" type="password" class="form-control @error('passwordOld') is-invalid @enderror" name="passwordOld" required autocomplete="new-password">

                                @error('passwordOld')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('messages.auth.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('messages.auth.confirmed') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.main.change') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
