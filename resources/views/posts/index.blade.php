@extends('layouts.app')

@section('content')
<div class="container">
@if(count($posts)>0)
<div>
    <div class="col-4 offset-9" style="border: 1px solid red;">
        <div class="d-flex pt-2">
            <a href="/profile/{{ Auth::user()->id }}">
                <img src="{{ Auth::user()->profile->profileImage() }}" class="rounded-circle" alt="" style="width: 50px; height: 50px;">
            </a>
            &nbsp; &nbsp; &nbsp;
            <a href="/profile/{{ Auth::user()->id }}">
                <h5 class="pt-3">{{Auth::user()->username}}</h5>
            </a>
        </div>
        <div class="d-flex">
            <h6 class="pt-3" style="color:#808080;">Suggestions for you&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</h6>
            <h6 class="pt-3"><a href="" style="text-decoration: none; color: black">Show All</a></h6>
        </div>
        <h6>{{Auth::user()->profile->user->u}}</h6>
    </div>    
</div>
@foreach ($posts as $post)
<div class="row" style="margin-top: -110px; margin-bottom: 150px;">
        <div class="col-6 offset-2" style="border: 1px solid #D3D3D3;">
            <div class="d-flex pt-2">
                <a href="/profile/{{ $post->user->id }}">
                    <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle" alt="" style="width: 50px; height: 50px;">
                </a>
                &nbsp; &nbsp; &nbsp;
                <a href="/profile/{{ $post->user->id }}">
                    <h5 class="pt-3">{{$post->user->username}}</h5>
                </a>
            </div>
            <hr>
            <a href="/profile/{{ $post->user->id }}">
                <img src="/storage/{{ $post->image }}" class="card-img-top">
             </a>
        </div>
        {{-- <div class="row pt-2 pb-4"> --}}
            <div class="col-6 offset-2">
                <p><span class="font-weight-bold">
                    <a href="/profile/{{ $post->user->id }}">
                        {{-- <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle" alt="" style="width: 30px; height: 30px;"> --}}
                        <span class="text-dark">{{ $post->user->username }}
                        </span>
                        
                    </a>
                </span> {{ $post->caption }}
                </p>
            </div>
        {{-- </div> --}}
</div>
@endforeach
@else
<div class="col-6 offset-2" style="border: 1px solid #D3D3D3;">
        <img src="/storage/Welcome.png" alt="Welcome to Insta_Like_App" style="width: 50px; height: 50px;">
</div>
@endif
{{-- Pagination numbers --}}
    <div class="row col-6">
        <div class="d-flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
</div>
@endsection
