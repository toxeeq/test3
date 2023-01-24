<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('Image.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(Random::generate('10'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        // ]);

        // if ($request->hasFile('file')) {

        //     $request->validate([
        //         'image' => 'mimes:jpeg,bmp,png'
        //     ]);

        //     $request->file->store('images' , 'public');
        //     $product = new Image([
        //         "name" => $request->get('name'),
        //         "file_path" => $request->file->hashName(),
        //         "user_id"=> Auth::user()->id
        //     ]);
        //     $product->save(); 
        // }
        // $ProfleImage = Image::query()->where('user_id', Auth::user()->id)->get('file_path')->toArray();
        // return view('Profile.index', ['profile_image'=> $ProfleImage[count($ProfleImage) - 1]['file_path']]);

 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // Random::generate('10');
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
