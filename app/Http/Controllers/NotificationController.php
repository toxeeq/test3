<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comments;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(Auth::check())){
            return view('Auth.login');
        }
        $notification = Notification::query()->where('user_id', Auth::id())->get()->toArray();
        return view('Profile.notification.index', ['notification'=> $notification]);
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
        $admins = User::query()->where('role', 'admin')->get('id')->toArray();
        foreach ($admins as $admin){
            $new = new Notification();
            $new->title = $request->input('title');
            $new->content = $request->input('content');
            $new->type = 'request';
            $new->part = 'topic';
            $new->admin_id = Auth::id();
            $new->user_id = $admin['id'];
            $new->save();
        }
        session()->flash('status', 'درخواست با موفقیت ثبت شد');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!(Auth::check())){
            return view('Auth.login');
        }
        $notification = Notification::query()->where('id', $id)->get()->toArray();
        if(!(empty($notification))){
            if(!($notification[0]['user_id'] == Auth::id())){
                session()->flash('status', 'دسترسی غیرمجاز');
                return redirect('/notification');
            }
            Notification::query()->where('id', $id)->update(['updated_at'=>now()]);
            $comment = Comments::query()->where('user_id', Auth::id())->get()->toArray();
            return view('Profile.notification.show', ['notification'=> $notification, 'comment'=> $comment]);
        }
        else{
            session()->flash('status', 'نوتیفیکیشن وجود ندارد');
            return redirect('/notification');
        }
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
