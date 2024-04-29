@extends('components.layout')

@section('content')
    <div class="dashboard-section">
        <h1>Welcome to the Dashboard! :)</h1>
        <h2>Log out if you have seen enough</h2>
        @include('components.anchor', [
            'path' => route('auth.logout'),
            'textValue' => 'Log out'

])
    </div>
@endsection
