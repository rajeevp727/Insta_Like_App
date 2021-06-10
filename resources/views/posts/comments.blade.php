@extends('layouts.app')

@section('content')
<div class="container">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Your Post's Comments</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Your Comments</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Your Post's comments with replies</a>
    </li>
  </ul>

<div class="tab-content">
  <div id="home" class="container tab-pane active"><br>
    <ul class="list-unstyled">
      @foreach($posts as $post)
            @foreach($post->comments as $comment)
                @if(!($comment->commenter->id == Auth::user()->id))
                      @include('posts.commentComponent')
                      <a href="/p/{{ $comment->commentable->id }}">Post</a>
                      <hr/>
                @endif
            @endforeach
        @endforeach
    </ul>
  </div>

  <div id="menu1" class="container tab-pane fade"><br>
    <ul class="list-unstyled">
      @php
          $grouped_comments = $comments->sortByDesc('created_at')->groupBy('child_id');
      @endphp
      @foreach($grouped_comments as $comment_id => $comments)
          {{-- Process parent nodes --}}
              @foreach($comments as $comment)
                  @include('comments::_comment', [
                      'comment' => $comment,
                      'grouped_comments' => $grouped_comments
                  ])
                  <a href="/p/{{ $comment->commentable->id }}">Post</a>
                  <hr/>
              @endforeach
      @endforeach
    </ul>
  </div>

  <div id="menu2" class="container tab-pane fade"><br>
    @foreach($posts as $post)
        @php
            $grouped_comments = $post->comments->sortByDesc('created_at')->groupBy('child_id');
        @endphp
        <ul class="list-unstyled">
          @foreach($grouped_comments as $comment_id => $comments)
              {{-- Process parent nodes --}}
              @if($comment_id == '')
                  @foreach($comments as $comment)
                      @include('comments::_comment', [
                          'comment' => $comment,
                          'grouped_comments' => $grouped_comments
                      ])
                      <a href="/p/{{ $comment->commentable->id }}">Post</a>
                      <hr/>
                  @endforeach
              @endif
          @endforeach
      </ul>
    @endforeach
  </div>
</div>
</div>
  </div>
@endsection
