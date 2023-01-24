<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin',['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all()->toArray();
        return view('user.index', ['data'=>$data]);
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
        $data = User::query()->where('id' , $id)->get()->toArray();
        if(empty($data)){
            session()->flash('status', 'کاربر مورد نظر یافت نشد');
            return redirect()->back();
        }
        return view('user.show', ['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::query()->where('id' , $id)->get()->toArray();
        if(empty($data)){
            session()->flash('status', 'کاربر مورد نظر یافت نشد');
            return redirect()->back();
        }
        return view('user.edit', ['id'=>$id, 'data'=>$data]);
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
        User::query()->where('id', $id)->update(['role'=>$request->input('role')]);
        User::query()->where('id', $id)->update(['sex'=>$request->input('sex')]);
        session()->flash('status', 'اطلاعات ویرایش شد');
        return redirect('http://127.0.0.1:8000/user');
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
//     private $sucess_status = 200;

//     public function createUser(Request $request){
//         $validator = Validator::make($request->all(),
//         [
//             'name' => 'required',
//             'email' => 'required|email',
//             'password' => 'required|alpha_num|min:5'
//         ]
//      );
 
//          if($validator->fails()){
//              return response()->json(["validattion_errors"=>$validator->errors()]);
//          }
 
//          $dataArray = array(
//              "name"=>$request->first_name,
//              "email"=>$request->email,
//              "password"=>bcrypt($request->password),
 
//          );
 
//          $user = User::create($dataArray);
//          if(!is_null($user)){
//              return response()->json(["status" => $this->sucess_status, "success" => true, "data" => $user]);
//          }else {
//              return response()->json(["status" => "failed", "success" => false, "message" => "User not created"]);
//          }
//     }
 
//     public function userLogin(Request $request){
//         $validator = Validator::make($request->all(),
//         [
//             'email' => 'required|email',
//             'password' => 'required|alpha_num|min:5'
//         ]
//      );
 
//      if($validator->fails()){
//          return response()->json(["validation_errors"=>$validator->errors()]);
//      }
 
//      if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
//          $user = Auth::user();
//          $token = $user->createToken('token')->accessToken;
//          return response()->json(["status" => $this->sucess_status, "success" => true, "login" => true, "token" => $token, "data" => $user]);
//      } else{
//          return response()->json(["status" => "failed", "success" => false, "message" => "Invalid email or password"]);
//      }
//     }
 
//     public function userDetail(){
//         $user = Auth::user();
//         if(!is_null($user)){
//          return response()->json(["status" => $this->sucess_status, "success" => true, "user" => $user]);
//         }else {
//          return response()->json(["status" => "failed", "success" => false, "message" => "No user found"]);
//      }
//     }
//  }

}