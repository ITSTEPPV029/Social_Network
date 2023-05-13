@extends('layouts.app')

@section('content')

<div id="appSettings">
  <Settings :user="{{ json_encode(Auth::user())}}"/> 
</div>

@endsection