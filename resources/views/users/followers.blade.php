@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">

            <!--共通部読み込み-->
            @include('users.card', ['user' => $user])
        
        </aside>
        <div class="col-sm-8">
        
            <!--共通部読み込み-->
            @include('users.navtabs', ['user' => $user])
            @include('users.users', ['users' => $users])
        
        </div>
    </div>
@endsection