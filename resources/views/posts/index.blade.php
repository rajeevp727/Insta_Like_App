@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

@section('content')

    <section class="posts endless-pagination" data-next-page="{{ $posts->nextPageUrl() }}">

        <div class="container">
            <div id="data-wrapper">
                {{-- @if (count($posts) > 0) --}}

                {{-- User card Code on right side --}}
                <div style="margin-right: 5%;">
                    <div class="col-4 offset-6" style="position: fixed; margin-top: 55px;">
                        <div class="d-flex pt-2">
                            <a href="/profile/{{ Auth::user()->id }}">
                                <img src="{{ Auth::user()->profile->profileImage() }}" class="rounded-circle" alt=""
                                    style="width: 50px; height: 50px;">
                            </a>
                            &nbsp; &nbsp; &nbsp;
                            <a href="/profile/{{ Auth::user()->id }}">
                                <h5 class="pt-3">{{ Auth::user()->username }}</h5>
                            </a>
                            <i class="fa fa-comments-o"></i>

                        </div>
                        <div class="d-flex">
                            <h6 class="pt-3" style="color:#808080;">Suggestions for
                                you&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</h6>
                            <h6 class="pt-3"><a href="" style="text-decoration: none; color: black">Show All</a></h6>
                        </div>
                        <h6>{{ Auth::user()->profile->user->username }}</h6>
                    </div>
                </div>
                {{-- @foreach ($posts as $post) --}}
                Posts Code
                {{-- <div class="row"> --}}
                {{-- <div class="col-7 offset-1" style="border: 1px solid #D3D3D3;"> --}}
                {{-- <div class="d-flex pt-2"> --}}
                {{-- <a href="/profile/{{ $post->user->id }}"> --}}
                {{-- <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle" alt="" --}}
                {{-- style="width: 50px; height: 50px;"> --}}
                {{-- </a> --}}
                {{-- &nbsp; &nbsp; &nbsp; --}}
                {{-- <a href="/profile/{{ $post->user->id }}"> --}}
                {{-- <h5 class="pt-3 pl-0">{{ $post->user->username }}</h5> --}}
                {{-- </a> --}}
                {{-- </div> --}}
                {{--  --}}
                {{-- <a href="/profile/{{ $post->user->id }}"> --}}
                {{-- <img src="/storage/{{ $post->image }}" class="card-img-top"> --}}
                {{-- </a> --}}
                {{-- </div> --}}
                {{-- <div class="row pt-2 pb-4"> --}}
                {{-- <div class="col-7 offset-2"> --}}
                {{-- <p><span class="font-weight-bold"> --}}
                {{-- <a href="/profile/{{ $post->user->id }}"> --}}
                {{-- <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle" --}}
                {{-- alt="" style="width: 30px; height: 30px;"> --}}
                {{-- <span class="text-dark">{{ $post->user->username }} --}}
                {{-- </span> --}}
                {{-- </a> --}}
                {{-- </span> {{ $post->caption }} --}}
                {{-- </p> --}}
                {{--  --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- @endforeach --}}
                {{-- @else --}}
                {{-- <div class="col-6 offset-2" style="border: 1px solid #D3D3D3;"> --}}
                {{-- <img src="/storage/Welcome.png" alt="Welcome to Insta_Like_App" style="width: 50px; height: 50px;"> --}}
                {{-- </div> --}}
            {{-- </div> --}}
            {{-- @endif --}}
{{--  --}}
            <!-- Data Loader -->
            <div class="auto-load text-center">
                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                    <path fill="#000"
                        d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                            from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                    </path>
                </svg>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        infinteLoadMore(page);

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() + 100 >= $(document).height()) {
                page++;
                infinteLoadMore(page);
            }
        });

        function infinteLoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "/home?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.auto-load').show();
                    }
                })
                .done(function(response) {
                    if (response.length == 0) {
                        $('.auto-load').html("Reached the end :(");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }

    </script>
@endsection
