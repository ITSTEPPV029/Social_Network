@extends('layouts.app')

@section('content')

<div id="appSearch">
  <Search :users="{{ json_encode($users) }}" :userthis="{{ json_encode(Auth::user()) }}"/> 
</div>

@endsection