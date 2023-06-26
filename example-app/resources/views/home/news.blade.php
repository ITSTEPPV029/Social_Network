@extends('layouts.app')

@section('content')

 <div class="news-containes-appNews" id="appNews">
    <News :this-User="{{ json_encode(Auth::user())}}" /> 
 </div> 
  
@endsection