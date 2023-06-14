@extends('layouts.app')

@section('content')

 <div id="appNews">
    <News :this-User="{{ json_encode(Auth::user())}}" /> 
 </div> 
  
@endsection