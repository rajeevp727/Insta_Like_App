<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Laravelista\Comments;

class PostsController extends Controller
{
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(8);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return View('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function favoritePost(Post $post)
    {
        Auth::user()->favorites()->toggle($post->id);

        return back();
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['image'],
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('uploads', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        $post->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/p/{$post->id}");
    }

    public function show(Post $post)
    {
        $likevalue = $post->favorited() ? 'Unlike' : 'Like';
        return view('posts.show', compact('post', 'likevalue'));
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/profile/' . Auth::user()->id);
    }

    public function myFavorites()
    {
        $myFavorites = Auth::user()->favorites()->latest()->paginate(8);

        return view('posts.myfavorites', compact('myFavorites'));
    }

    public function comments()
    {
        $posts = Auth::user()->posts;
        $comments = Auth::user()->comments;
        return view('posts.comments', compact('posts', 'comments'));
    }
}