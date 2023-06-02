@extends('layouts.app')

@section('content')

<div id="appSearch">
  <Search :users="{{ json_encode($users) }}"/> 
</div>

@endsection