@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8">
      @csrf
      <img src="/storage/{{ $post->image }}" class="w-100">
    </div>
    <div class="col-4">

      <div>
        <div class="d-flex">
          <div class="pr-3">
            <img src="{{ $post->user->profile->profileImage() }}" class="w-50 rounded-circle" style="max-width: 50px;">
          </div>
          <div>
            <div class="font-weight-bold">
              <a href="/profile/{{ $post->user->id }}">
              <span class="text-dark">{{ $post->user->username }}</span>
            </a>
            </div>
          </div>
          </div>
        </div>
        <hr>
        <p><span class="font-weight-bold">
          <a href="/profile/{{ $post->user->id }}">
          <span class="text-dark">{{ $post->user->username }}</span>
        </a></span> {{ $post->caption }}</p>
        <div class="pl-3 d-flex">
          <form action="/favorite/{{ $post->id }}" method="post">
            @csrf
            <input type="submit" name="likeToggle" value="{{ $likevalue }}" class="btn btn-info btn-lg" />
          </form>
          <h3 class="pl-3 pt-2">{{ $post->favorites()->count()}}</h3>

          @can('delete', $post)
            <form action="/p/{{ $post->id }}" method="post" class="pl-5">
              @csrf
              @method('DELETE')
              <input type="submit" name="delete" value="delete" class="btn btn-danger" />
            </form>
          @endcan
        </div>
        <div class="pt-4 pl-3">
          @can('update', $post)
            <form action="/p/{{ $post->id }}/edit" method="get">
              @csrf
              <input type="submit" name="edit" value="Edit" class="btn btn-primary" />
            </form>
          @endcan
          <hr>
          <h5>{{ $post->comments->count() }} Comments</h5>
          <br/>
          @comments(['model' => $post])
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
