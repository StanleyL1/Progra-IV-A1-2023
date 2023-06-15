@extends('layouts.appweb')

@section('content')
    <div id="app" class="m-0">
        <chat-component></chat-component>
    </div>
@endsection

@section('scripts')
@vite('resources/js/app.js')
@endsection
