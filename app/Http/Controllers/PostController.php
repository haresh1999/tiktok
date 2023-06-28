<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'title' => 'required|unique:posts',
            'location' => 'required',
            'description' => 'required',
            'file' => 'required',
            'status' => 'required'
        ]);

        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();

        $input['filename'] = 'posts/' . $name;

        Storage::disk('s3')->put($input['filename'], $request->file);

        Post::create($input);

        return redirect()->route('post.index')->with('success', 'Post Created SuccessFully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'title' => 'required|unique:posts,title,' . $id,
            'location' => 'required',
            'description' => 'required',
            'file' => 'nullable',
        ]);

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $name = time() . $file->getClientOriginalName();

            $input['filename'] = 'posts/' . $name;

            Storage::disk('s3')->put($input['filename'], $request->file);

            $post = Post::find($id);

            Storage::disk('s3')->delete($post->filename);
        } else {

            unset($input['filename']);
        }

        unset($input['file']);

        Post::where('id', $id)->update($input);

        return redirect()->route('post.index')->with('success', 'Post Updated SuccessFully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);

        return redirect()->route('post.index')->with('success', 'Post deleted SuccessFully.');
    }
}
