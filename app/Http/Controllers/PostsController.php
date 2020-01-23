<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    // Add auth to the controller
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(4);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // returns post view
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     * @var $imagepath $image $data
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get the post and veryfy
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);


        // Store image
        $imagepath = request('image')->store('uploads', 'public');

        // Intervention image    
        $image = Image::make(public_path("storage/{$imagepath}"))->fit(1200, 1200);
        $image->save();    

        // Add user id        
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagepath,
        ]);

        return redirect('/profile/' . auth()->user()->id);

    }

    /**
     * Display the specified post resource.
     *
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
