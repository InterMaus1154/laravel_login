@extends('components.layout')

@section('content')
    <div class="login-section">

        <div class="login-wrapper">
            <h1>Login form</h1>
            @if($authMessage != null)
                <h2 class="auth-form-message">{{$authMessage}}</h2>
            @endif
            <form action="{{ route('auth.login') }}" method="POST" class="auth-form">
                @csrf
                <div class="input-wrappers">
                    <div class="input-wrapper">
                        <label for="username">Username:</label>
                        <input type="text" id="username" placeholder="Username" name="username" required/>
                    </div>
                    <div class="input-wrapper">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Password" required/>
                    </div>
                </div>
                <button type="submit">Log In</button>
            </form>
            @include('components.anchor', [
                'path' => route('register'),
                'textValue' => "Register"
            ])
    </div>

</div>
@endsection
