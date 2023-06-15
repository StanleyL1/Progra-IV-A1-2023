@extends('layouts.sitio')

@section('content')
    <div id="app">
        <users-table></users-table>
    </div>
@endsection

@section('scripts')
@vite('resources/js/app.js')
<script>
    localStorage.setItem('userId', {{ Auth::guard('web_asociates')->user()->id }});
    localStorage.setItem('userName', "{{ Auth::guard('web_asociates')->user()->name }}");
</script>
@endsection
