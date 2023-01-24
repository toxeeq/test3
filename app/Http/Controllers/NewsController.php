<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Comments;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:admin',['except' => ['index','show', 'store', 'edit', 'update']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.news', ['new'=>BlogPost::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
            return view('home.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!(empty($request->input('status')))){
            if($request->input('status') == 'reject'){
                $notifi = new Notification();
                $notifi->title = 'Your Request Result';
                $notifi->content = 'Your Topic REJECTED by Admin';
                $notifi->admin_id = Auth::id();
                $notifi->user_id = $request->input('creator_id');
                $notifi->part = 'topic';
                $notifi->type = 'request';
                $notifi->save();
                Notification::query()->where('title', $request->input('title'))->where('content',  $request->input('content'))->where('admin_id', $request->input('creator_id'))->delete();
                session()->flash('status', 'درخواست برای ثبت تاپیک ریجکت شد');
                return redirect('/notification');
            }
            else{
                $new = New BlogPost();
                $new->title = $request->input('title');
                $new->content = $request->input('content');
                $new->has_comment = 0;
                $name = User::query()->where('id', $request->input('creator_id'))->get('name')->toArray();
                $new->creator = $name[0]['name'];
                $new->creator_id = $request->input('creator_id');
                $new->save();
                $notifi = new Notification();
                $notifi->title = 'Your Request Result';
                $notifi->content = 'Your Topic ACCEPTED by Admin';
                $notifi->admin_id = Auth::id();
                $notifi->user_id = $request->input('creator_id');
                $notifi->part = 'topic';
                $notifi->type = 'request';
                $notifi->comment_id = $new->id;
                $notifi->save();
                Notification::query()->where('title', $request->input('title'))->where('content',  $request->input('content'))->where('admin_id', $request->input('creator_id'))->delete();
                session()->flash('status', 'درخواست برای ثبت تاپیک تایید شد');
                return redirect()->route('news.show', ['news'=> $new->id]);
            }
        }
            $new = New BlogPost();
            $new->title = $request->input('title');
            $new->content = $request->input('content');
            $new->has_comment = 0;
            $new->creator = Auth::user()->name;
            $new->creator_id = Auth::id();
            $new->save();
            session()->flash('status', 'تاپیک شما با موفقیت ساخته شد');
            return redirect()->route('news.show', ['news'=> $new->id]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checker = BlogPost::query()->where('id', $id)->get()->toArray();
        if (!(empty($checker))){
            $checkComment = Comments::query()->where('new_id', $id)->get()->toArray();
            if(empty($checkComment)){
                BlogPost::query()->where('id', $id)->update(['has_comment'=> 0]);
            }
                else {
                BlogPost::query()->where('id', $id)->update(['has_comment'=> 1]);
            }
            $has_comment = BlogPost::query()->where('id', $id)->first('has_comment')->toArray();
            $has_comment = $has_comment['has_comment'];
            return view('home.news', ['new'=>BlogPost::findOrFail($id), 'has_comment'=> $has_comment,'comments'=>Comments::query()->where('new_id', $id)->get(['name', 'comment', 'user_id'])->toArray() , 'comment_id'=>Comments::query()->where('new_id', $id)->get()->toArray(),'created_at'=>Comments::query()->where('new_id', $id)->get('created_at')->toArray()]);
    }
    else{
        session()->flash('status', 'تاپیک حذف شده یا وجود ندارد');
        return redirect()->back();
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
        $checker = BlogPost::query()->where('id', $id)->get('content')->toArray();
        $creator_checker = BlogPost::query()->where('id', $id)->get('creator_id')->toArray();
        if(Auth::id() == $creator_checker[0]['creator_id'] && Auth::user()->role == 'user'){
            return view('home.edit', ['new'=> $checker, 'id'=>$id]);
        } elseif(Auth::user()->role == 'admin') {
            if(!(empty($checker))){
                return view('home.edit', ['new'=> $checker, 'id'=>$id]);
            }
            else{
                session()->flash('status', 'تاپیک حذف شده یا وجود ندارد');
                return redirect()->back();
            }
        } else{
            session()->flash('status', 'دسترسی غیر مجاز');
            return redirect()->back();
        }


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
        $admins = User::query()->where('role', 'admin')->get('id')->toArray();
        foreach($admins as $admin) {
            $create = new Notification;
            $create->title = 'The Topic was EDITED';
            $create->content = $request->input('edited_text');
            $create->user_id = $admin['id'];
            $create->comment_id = $id;
            $create->admin_id = Auth::id();
            $create->type = 'edit';
            $create->part = 'topic';
            $create->save();
        }
        BlogPost::query()->where('id', $id)->update(['content'=>$request->input('edited_text')]);
        BlogPost::query()->where('id', $id)->update(['editor'=>Auth::user()->name]);
        BlogPost::query()->where('id', $id)->update(['editor_id'=>Auth::id()]);
        session()->flash('status', 'تاپیک شما با موفقیت ویرایش شد');
        return redirect()->route('news.show', [$news = $id]);
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
