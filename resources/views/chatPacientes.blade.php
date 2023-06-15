@extends('layouts.appweb')

@section('content')
    <div id="app" >
        <chat-pacientes></chat-pacientes>
    </div>
@endsection

@section('scripts')
@vite('resources/js/app.js')
@endsection
