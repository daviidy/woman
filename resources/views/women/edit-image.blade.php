@extends('layouts.app')
@section('title', "Modifier $woman->name" )
@section('main')

<div class="row justify-content-center">


  <div class="col-md-6">
    <img src="/uploads/{{ $woman->image }}" alt="">
    <form action="{{ URL::to('upload') }}" method="post">
      {{ csrf_field() }}
      {{ method_field('patch') }}
      <div class="form-group">
        <label>Mettre à jour la photo de profil</label>
        <input type="file" name="image">
      </div>
      <button type="submit" class="btn btn-primary">
        Mettre à jour la photo
      </button>
    </form>

  </div>
</div>

@endsection
