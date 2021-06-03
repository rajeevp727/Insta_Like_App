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
            <div class="col-7 offset-2">
                <p><span class="font-weight-bold">
                    <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $post->user->username }}
                        </span>
                    </a>
                    </span> {{ $post->caption }}
                </p>
                
            </div>
</div>
@endforeach