@extends('layouts.app')

@section('content')
<div class="container">
  @foreach($myFavorites as $myFavorite)
  <div class="row">
    <div class="col-6 offset-3">
      <a href="/p/{{ $myFavorite->id }}">
        <img src="/storage/{{ $myFavorite->image }}" class="w-100">
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-6 offset-3">
        <p><span class="font-weight-bold">
          <a href="/profile/{{ $myFavorite->user->id }}">
          <span class="text-dark">{{ $myFavorite->user->username }}</span>
        </a></span> {{ $myFavorite->caption }}</p>
      </div>

    </div>
  </div>
  @endforeach

  <div class="row">
    <div class="col-12 d-flex justify-content-center">
      {{ $myFavorites->links() }}
    </div>
  </div>

</div>
@endsection
