<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;

class PostsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = auth()->user()->following()-> pluck('profiles.user_id');
        // $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(3); //For Laravel pagination
        // $posts = Post::whereIn('user_id', $users)->with('user')->get();
        $posts = Post::orderBy('id')->paginate(3);
        $artilces = '';
        if($request->ajax()){
            foreach ($posts as $p) {
                $artilces.= 
                            '<div class="row">'.
                                '<div class="col-7 offset-1" style="border: 1px solid #D3D3D3; margin-top: 55px;">'.
                                    '<div class="d-flex pt-2">'.
                                        '<a href="/profile/'. $p->user->id .'">'.
                                            '<img src="'.$p->user->profile->profileImage().'" class="rounded-circle" alt=""
                                                style="width: 50px; height: 50px; margin-bottom:10px;"></a>&nbsp; &nbsp; &nbsp;'.
                                        '<a href="/profile/'.$p->user->id .'">'.
                                            '<h5 class="pt-3 pl-0">'. $p->user->username .'</h5>'.
                                        '</a>'.
                                    '</div>'.
                                    '<a href="/profile/'.$p->user->id.'">'.
                                        '<img src="/storage/'.$p->image.'">'.
                                    '</a>'.
                                '</div>'.
                                '<div class="row pt-2 pb-2">'.
                                    '<div style="padding-left: 10%;">'.
                                        '<p><span class="font-weight-bold">'.
                                        '<a href="/profile/'.$p->user->id.'">'.
                                            // '<img src="'.$p->user->profile->profileImage().'" class="rounded-circle" alt="" style="width: 30px; height: 30px;">'.
                                            '<span class="text-dark">'.$p->user->username.'</span>'.
                                        '</a>'.
                                        '</span><span class="pl-2">'.$p->caption.'</span>'.
                                        '</p>'.
                                        '<i class="fa fa-home fa-2x" aria-hidden="true"></i>'.
                                        '<i class="fa fa-thumbs-up fa-2x" aria-hidden="true"> Like </i>'.
                                    '</div>'.
                                '</div>'.
                            '</div>';
            }
            return $artilces;
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