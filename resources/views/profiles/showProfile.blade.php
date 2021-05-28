@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <img src="{{ $user->profile->profileImage() }}" alt="" class="rounded-circle w-100">
        <div class="col-3 p-5">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex pb-3">
                    <div class="h3">{{ $user->username }}</div>
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
            <div class="pr-5"><strong>{{ $postsCount }}</strong> posts</div>
            <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
            <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
            <div>{{$user->profile->description }}</div>
            <div class="font-weight-bold">
                <a href="#" style="text-decoration: none; color: black;">{{$user->profile->url}}</a>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $posts )
            <div class="col-4 pb-4">
            <a href="/p/{{ $posts->id }}">
                <img src="/storage/{{ $posts->image }}" class="w-100">
            </a>
            </div>
        @endforeach
    </div>
</div>

@endsection
