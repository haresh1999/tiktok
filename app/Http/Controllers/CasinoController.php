<?php

namespace App\Http\Controllers;

use App\Models\Casino;
use Illuminate\Http\Request;

class CasinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casinos = Casino::paginate(10);

        return view('casino.list', compact('casinos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('casino.create');
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
            'name' => 'required|max:250',
            'title' => 'required|unique:casions',
            'description' => 'required',
            'rating' => 'required',
            'url' => 'required|url',
            'img' => 'required|image',
            'status' => 'required|in:0,1'
        ]);

        $input['img'] = uploadImage($input['img'], 'casino');

        Casino::create($input);

        return redirect()
            ->route('casino')
            ->with('casino.success', 'Casino created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Casino  $casino
     * @return \Illuminate\Http\Response
     */
    public function edit(Casino $casino)
    {
        return view('casino.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Casino  $casino
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Casino $casino)
    {
        $input = $request->validate([
            'name' => 'required|max:250',
            'title' => 'required|unique:casions',
            'description' => 'required',
            'rating' => 'required',
            'url' => 'required|url',
            'img' => 'required|image',
            'status' => 'required|in:0,1'
        ]);

        if (isset($input['img'])) {

            $input['img'] = uploadImage($input['img'], 'casino');

            deleteImage($casino->img);
        }

        Casino::where('id', $casino->id)
            ->update($input);

        return redirect()
            ->route('casino')
            ->with('casino.success', 'Casino updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Casino  $casino
     * @return \Illuminate\Http\Response
     */
    public function destroy(Casino $casino)
    {
        $casino->delete();

        return redirect()
            ->route('casino')
            ->with('casino.error', 'Casino deleted successfully!');
    }
}
