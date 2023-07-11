<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'name' => 'required|unique:categories',
            'status' => 'required',
            'img' => 'required|image'
        ]);

        $input['img'] = uploadImage($input['img'],'category');

        Category::create($input);

        return redirect()
            ->route('category')
            ->with('category.success','Category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit',compact('Category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id,
            'status' => 'required',
            'img' => 'nullable|image'
        ]);

        if (isset($input['img'])) {
            
            $input['img'] = uploadImage($input['img'],'category');

            deleteImage($category);
        }

        Category::where('id',$category->id)->update($input);

        return redirect()
            ->route('category')
            ->with('category.success','Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Post::where('category_id',$category->id)->delete();

        $category->delete();

        return redirect()
            ->route('category')
            ->with('category.warning','Category deleted successfully!');
    }
}
