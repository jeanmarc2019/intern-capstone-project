@extends('layouts.app')

@section('content')
<div id="app">
    <div class="content">
        <div class="row justify-content-center">{{env("COVER_MESSAGE", "This is not a substitute for a medical professional, only a screening.")}}</div>
        <test></test>
    </div>
</div>
@endsection
