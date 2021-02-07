@extends('layouts.app')

<!--ここは新規追加-->
@section('content')

    @if (Auth::check())
    
    <div class="row">

        <!--microposts部追加時　修正        -->
        <aside class="col-sm-4">
            
            <div class="card">
                <div class="card-header">
                    <!--Auth　facade check()して、更に名前を出す。-->
                    <h3 class="card-title">{{ Auth::user()->name }}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded img-fluid" src="{{ Gravatar::src(Auth::user()->email, 500) }}" alt="">
                </div>
            </div>
        
        </aside>

        <!--別View　の　micoroposts部を読み込み-->
        <div class="col-sm-8">

            <!--別View　の　micoroposts部を読み込み-->
            @if (Auth::id() == $user->id)
                {!! Form::open(['route' => 'microposts.store']) !!}
                    <div class="form-group">
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            @endif


            @if (count($microposts) > 0)

                @include('microposts.microposts', ['microposts' => $microposts])
            
            @endif
        </div>
    
    </div>
    
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