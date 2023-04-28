@extends('layouts.app')

@section('content')

  <br /> <br />
 <form action="{{ route('savePet') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <div class="row mb-3">

              <label for="name" class="col-md-4 col-form-label text-md-end">введіть ім’я</label>
        <div class="col-md-6">
           <input id="name" name="name" type="text">
<br>

        <label for="avatar" class="col-md-4 col-form-label text-md-end">завантажити фото</label>
        <div class="col-md-6">
           <input class="inputfile" id="avatar" name="avatar" type="file">
    @error('avatar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
                    <br />
    <input type="submit" value="Додати">
  </div>
    </div>
  </form> 

@endsection