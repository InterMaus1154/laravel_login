@extends('components.layout')

@section('content')
<div class="login-section">

    <div class="login-wrapper">
        <h1>Registration form</h1>
        @if($authMessage != null)
            <h2 class="auth-form-message">{{$authMessage}}</h2>
        @endif
        <form action="{{route('auth.register')}}" method="POST" class="auth-form">
            @csrf
            <div class="input-wrappers">
                <div class="input-wrapper">
                    <label for="username">Username:</label>
                    <input type="text" id="username" placeholder="Username" name="username" required/>
                </div>
                <div class="input-wrapper">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password" minlength="8" required/>
                </div>
            </div>
            <button type="submit">Register</button>
        </form>
        @include('components.anchor', [
                'path' => route('login'),
                'textValue' => "Login"
            ])
    </div>

</div>
@endsection
