@extends('layouts.admin')
@section('title', $title = 'Users ')
@section('content')

    <style>
        .selected {
            background-color: #badbcc;
        }
    </style>

    <div class="container">
        <h2 class="b">Users</h2>

        <div class="mt-4">
            <div class="row" style="border-bottom: 2px solid green; font-size: 1rem; font-weight: bold; padding-bottom: 0.3em;" >
                <div class="col-lg-2">
                    Id, name
                </div>
                <div class="col-lg-2">
                    E-mail
                </div>
                <div class="col-lg-1">
                    Table
                </div>
                <div class="col-lg-2">
                    Date created
                </div>

            </div>
            @foreach($users as $user)
                <div class="row @if($user->admin === 1) selected @endif" style="border-bottom: 1px solid green; font-size: 1.05rem; padding-bottom: 0.3em; padding-top:0.3em;" >
                    <div class="col-lg-2">
                        <a class="myLink" href="{{ route('admin.user.view', ['user' => $user->id]) }}">
                        {{ $user->id }}. {{$user->name}}
                        </a>
                    </div>
                    <div class="col-lg-2">
                        {{$user->email}}
                    </div>
                    <div class="col-lg-1">
                        {{$user->key}}
                    </div>
                    <div class="col-lg-2">
                        {{$user->created_at}}
                    </div>

                </div>
            @endforeach
        </div>
    </div>

@endsection
