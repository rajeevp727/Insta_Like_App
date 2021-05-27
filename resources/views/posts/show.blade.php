@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
             <img src="/storage/{{ $posts->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div class="d-flex align-items-center">
                <div class= "pr-3">
                    <img src="{{ $posts->user->profile->profileImage() }}" alt="" class="w-100 rounded-circle" style="max-width:40px;">

                <div>
                    <div class="font-weight-bold">
                        <a href="/profile/{{ $posts->user->id }}">
                            <span class="text-dark">{{ $posts->user->username }}</span>
                            </a><span class="pl-1">•</span>
                            <a href="">Follow</a>
                        </a>
                    </div>
                </div>
            </div> 
            <hr>
                <p><span class="font-weight-bold">
                        <a href="/profile/{{ $posts->user->id }}">
                            <span class="text-dark">{{ $posts->user->username }}
                            </span>
                        </a>
                    </span> {{ $posts->caption }}
                </p>
        </div>
    </div>
</div>

@endsection
