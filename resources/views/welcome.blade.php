@extends('layouts.app')

<!--ここは新規追加-->
@section('content')

    @if (Auth::check())
    <!--Auth　facade check()して、更に名前を出す。-->
        {{ Auth::user()->name }}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                
                <!--USER登録Link-->
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
    
            </div>
        </div>
    @endif


@endsection