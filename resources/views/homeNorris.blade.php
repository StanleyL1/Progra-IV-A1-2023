
@extends('layouts.appweb')

@section('content')

<div id="app">
        <home-Norris></home-Norris>
    </div>
@endsection
@section('scripts')
@vite('resources/js/app.js')
<script>
    localStorage.setItem('userId', {{ Auth::guard('web')->user()->id }});
    localStorage.setItem('userName', "{{ Auth::guard('web')->user()->name }}");
</script>
@endsection