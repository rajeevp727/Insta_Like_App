@extends('layouts.app')

@section('content')

<section class="posts endless-pagination" data-next-page="{{ $posts->nextPageUrl() }}">

<div class="container">
@if(count($posts)>0)
{{-- User Code on right side--}}
<div style="margin-right: 5%;">
    <div class="col-4 offset-6" style="position: fixed;">
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
{{-- Posts Code --}}
<div class="row">
        <div class="col-7 offset-1" style="border: 1px solid #D3D3D3;">
            <div class="d-flex pt-2">
                <a href="/profile/{{ $post->user->id }}">
                    <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle" alt="" style="width: 50px; height: 50px;">
                </a>
                &nbsp; &nbsp; &nbsp;
                <a href="/profile/{{ $post->user->id }}">
                    <h5 class="pt-3 pl-0">{{$post->user->username}}</h5>
                </a>
            </div>
            <hr>
            <a href="/profile/{{ $post->user->id }}">
                <img src="/storage/{{ $post->image }}" class="card-img-top">
             </a>
        </div>
        {{-- <div class="row pt-2 pb-4"> --}}
            <div class="col-7 offset-2">
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

{{-- Pagination --}}
    {{-- <div class="row"> --}}
        {{-- <div class="col-12 text-center"> --}}
            {{-- {{ $posts->links() }} --}}
        {{-- </div> --}}
    {{-- </div> --}}
{{-- </div> --}}
{{-- <style> --}}
     {{-- .w-5{ --}}
         {{-- display: none; --}}
         {{-- } --}}
        {{-- </style> --}}
        
</div>
</section>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
    $(document).ready(function() { 
        window.scroll(fetchPosts);

        function fetchPosts() {
            var page = $('.endless-pagination').data('next-page');

            if(page !== null){

                clearTimeout($.data(this, "scrollCheck"));

                $.data(this, "scrollCheck", setTimeout(function() {
                    var scroll_position_for_posts_load = $(window).height() + $(window).scrollTop() + 100;

                    if(scroll_position_for_posts_load >= $(document).height()) {
                        $.get(page, function(data){
                            $('.posts').append(data.posts);
                            $('.endless-pagination').data('next-page', data.next_page);
                        });
                    }
                }, 100))
            }
        }
    })
</script>
@endsection 