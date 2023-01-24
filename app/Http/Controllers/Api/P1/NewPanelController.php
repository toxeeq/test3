<?php

namespace App\Http\Controllers\Api\P1;

use App\Models\User;
use App\Models\NewPanel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('store');
        
    }
        
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $newpanel = User::all()->toArray();
        return [$newpanel];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $new = new User();
            $new->name = $request->input('name');
            $new->email = $request->input('email');
            $new->password = $request->input('password');
            $new->role = 'user';
            $new->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newpanel = User::query()->where('id', $id)->get()->toArray();
        if(empty($newpanel)){
            return "User not found!";
        }
        return $newpanel;
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
        if (!(empty($request->input('name')))) {
            User::query()->where('id', $id)->update(['name'=> $request->input('name') ]);
        }
        if (!(empty($request->input('email')))) {
            User::query()->where('id', $id)->update(['email'=> $request->input('email')]);
        }
        if (!(empty($request->input('password')))) {
            User::query()->where('id', $id)->update(['password'=> $request->input('password')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty(User::query()->where('id', $id)->get()->toArray())){
            return "User not found!";
        }
        User::query()->where('id', $id)->delete();
    }

    public function search(Request $request) {
        // $phone_number = request('phone_number');
        // $national_code = request('national_code');
        // $search = NewPanel::where('phone_number', 'like', "%{$phone_number}%")
        //         ->orWhere('national_code', 'like', "%{$national_code}%")
        //         ->get();

        // return response()->json([
        //     'data' => $search
        // ]);
    }
}