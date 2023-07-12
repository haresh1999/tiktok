<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Likes;
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
        $posts = Post::with('category')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status',1)
            ->pluck('name','id');

        return view('post.create',compact('category'));
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
            'description' => 'required|max:500',
            'file' => 'required',
            'status' => 'required',
            'type' => 'required',
            'html' => 'nullable',
            'category_id' => 'required'
        ]);

        $input['user_id'] = auth()->id();
        $input['filename'] = Storage::disk('s3')->put('posts', $request->file);

        Post::create($input);

        return redirect()
            ->route('post')
            ->with('success', 'Post Created SuccessFully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('status',1)
        ->pluck('name','id');

        $post = Post::find($id);

        return view('post.edit', compact('post','category'));
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
            'description' => 'required|max:500',
            'file' => 'nullable',
            'status' => 'required',
            'type' => 'required',
            'html' => 'nullable',
            'category_id' => 'required'
        ]);

        if ($request->hasFile('file')) {

            $input['filename'] = Storage::disk('s3')->put('posts', $request->file);

            $post = Post::find($id);

            Storage::disk('s3')->delete($post->filename);

        } else {

            unset($input['filename']);
        }

        unset($input['file']);

        Post::where('id', $id)->update($input);

        return redirect()
            ->route('post')
            ->with('success', 'Post Updated SuccessFully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        Storage::disk('s3')->delete($post->filename);

        Post::destroy($id);

        return redirect()
            ->route('post')
            ->with('success', 'Post deleted SuccessFully.');
    }

    public function postList(Request $request)
    {
        $data = Post::with('user')
            ->select(
                'id',
                'user_id',
                'id as like_status',
                'title',
                'location',
                'description',
                'type',
                'html',
                'filename',
                'likes',
                'created_at',
                'updated_at',
            )
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return response()->json([
            'data'      => $data,
            'message'   => 'Posts List!',
            'response'  => true
        ], 200);
    }

    public function postDetails($id)
    {
        $data = Post::with('user')
            ->select(
                'id',
                'user_id',
                'id as like_status',
                'title',
                'location',
                'description',
                'filename',
                'html',
                'likes',
                'created_at',
                'updated_at',
                'type'
            )
            ->where('id', $id)
            ->first();

        return response()->json([
            'data'      => $data,
            'message'   => 'Posts In Details!',
            'response'  => true
        ], 200);
    }

    public function likes(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
        ]);

        if ($v->fails()) {

            return response()->json([
                'message'   => $v->errors(),
                'response'  => false
            ], 422);
        }

        if (Likes::where('post_id',$request->post_id)->where('ip',$request->ip())->exists()) {
            
            Likes::where('post_id',$request->post_id)
                ->where('ip',$request->ip())
                ->delete();
    
            $post = Post::where('id', $request->post_id)->first();

            $post->decrement('likes', 1);

            Category::where('id',$post->category_id)->decrement('likes', 1);

        }else{
            
            Likes::create([
                'post_id' => $request->post_id,
                'ip' => $request->ip()
            ]);
    
            $post = Post::where('id', $request->post_id)->first();

            $post->increment('likes', 1);

            Category::where('id',$post->category_id)->increment('likes', 1);
        }

        $res['likes'] = Post::where('id', $request->post_id)->value('likes');

        return response()->json([
            'data'      => $res,
            'message'   => 'Posts Likes!',
            'response'  => true
        ], 200);
    }
}
