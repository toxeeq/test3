<?php

namespace App\Http\Controllers\Api\P1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewPanel;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!(empty($request->input('phone_number')))){
            $phone_number = $request->input('phone_number');
            $email = $request->input('email');
            // $search = NewPanel::where('phone_number', 'like', "%{$phone_number}%")->where('email', 'like', "%{$email}%")->get();
            $search = NewPanel::where('phone_number', 'like', "%{$phone_number}%")->get();
            return response()->json([
                'data' => $search
            ]);
        }
        if(!(empty($request->input('email')))){
            $phone_number = $request->input('email');
            $search = NewPanel::where('email', 'like', "%{$phone_number}%")->get();
            return response()->json([
                'data' => $search
            ]);
        }
        if(!(empty($request->input('national_code')))){
            $national_code = $request->input('national_code');
            $search = NewPanel::where('phone_number', 'like', "%{$national_code}%")->get();
            return response()->json([
                'data' => $search
            ]);
        }
        return NewPanel::all()->toArray();
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
