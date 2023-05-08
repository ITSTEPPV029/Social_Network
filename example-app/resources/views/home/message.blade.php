@extends('layouts.app')

@section('content')

<div id="appMyMap">
  <Mymap /> 
</div> 

<div id="appMessage">
  <Message  :user="{{ json_encode($user) }}" :auth="{{ json_encode(Auth::user()->id) }}"  /> 
</div> 



@endsection