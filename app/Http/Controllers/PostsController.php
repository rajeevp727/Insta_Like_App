<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;

class PostsController extends Controller
{

    protected $posts_per_page = 3;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $users = auth()->user()->following()-> pluck('profiles.user_id');
        // $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(3); //For Laravel pagination
        
        // $posts = Post::whereIn('user_id', $users)->with('user')->get();
        $posts = Post::paginate($this->posts_per_page);


// Using AJAX to automatically load data
        if($request->ajax())  {
            return [
                'posts'=> view('posts.ajax.index', compact('posts'))->render(),
                'next_page'=> $posts->nextPageUrl()
            ];
        }

        return view('posts.index', compact('posts'));
    }   
    
    public function create()
    {
        return view('posts/create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption'=> 'required',
            'image'=> ['required', 'image'],
        ]);

        $imagePath = request('image')->store('Uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(600, 600);
        $image->save();

        auth()->user()->posts()->create([
            'caption'=>$data['caption'],
            'image'=>$imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }
    public function show(\App\Models\Post $posts)
    {
        return view('posts/show', compact('posts'));
    }
}
