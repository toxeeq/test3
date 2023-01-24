<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $ProfleImage = Image::query()->where('user_id', Auth::user()->id)->get('file_path')->toArray();
        if(Auth::check()){
        return view('Profile.index'/**, ['profile_image'=> $ProfleImage[count($ProfleImage) - 1]['file_path']] */);
        }
        else{
            return view('Auth.login');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('Profile.edit');
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
        User::query()->where('id', $id)->update(['name'=>$request->input('name')]);
        User::query()->where('id', $id)->update(['email'=>$request->input('email')]);
        User::query()->where('id', $id)->update(['address'=>$request->input('address')]);
        User::query()->where('id', $id)->update(['sex'=>$request->input('sex')]);
        session()->flash('status', 'اطلاعات شما ویرایش شد');
        return view('Profile.index');
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
