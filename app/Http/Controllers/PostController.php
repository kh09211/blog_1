<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $posts = $posts->sortByDesc('created_at')->all(); // sort newest first

        return view('posts/index', ['posts' => $posts]);
    }

    /**
     * Display a listing of the AUTHENTICATED user's posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $posts = Post::where('user_id', $request->user()->id)->get();
        $posts = $posts->sortByDesc('created_at')->all(); // sort by newest first

        return view('posts/index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // user must be logged in to create a new post
        if (!auth::check()) {
            abort(403);
        }

        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // protected by policy

        // validate the incoming data
        $data = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'photo' => ['required', 'string', 'url', 'max:255'],
                'text' => ['required', 'string'],
        ]);

        $userid = $request->user()->id;

        Post::create([
            'user_id' => $userid,
            'title' => $data['title'],
            'photo' => $data['photo'],
            'text' => $data['text'],
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts/show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // check if the user is authorized to update this post before showing view with a gate
        Gate::authorize('update-post', $post);


        return view('posts/edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // validate the incoming data
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'string', 'url', 'max:255'],
            'text' => ['required', 'string'],
        ]);
        
        $post->title = $data['title'];
        $post->photo = $data['photo'];
        $post->text = $data['text'];

        $post->save();

        return redirect('/posts/' . $post->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

}
