<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Comments;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentsController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('can:admin',['except' => ['index','show', 'create', 'store']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $has_comment = BlogPost::query("SELECT has_comment FROM blog_post");
        // dd($has_comment);
        // return view('home.news', ['new'=>Comments::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('news.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('chapta') == $request->input('chapta_answer')){
            $newComment = Comments::query()->create([
            'new_id' => $request->input('new_id'),
            'comment' =>  $request->input('comment'),
            'name'=> Auth::user()->name,
            'user_id'=> Auth::user()->id
        ]);
        } else {
            return redirect()->back()->withErrors(['error'=>'سوال رو به درستی جواب دهید']);
        }
        session()->flash('status', 'کامنت شما اضافه شد');
        return redirect()->route('news.show', ['news'=>BlogPost::findOrFail($newComment->new_id), 'comments'=> $newComment->comment, 'comment_id'=>$newComment->new_id, 'name'=> Auth::user()->name]);
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
        $comment = Comments::query()->where('id', $id)->get('comment')->toArray();
        if((Auth::check() == false)){
            session()->flash('status', 'دسترسی غیرمجاز');
            return view('Auth.login');
        }
        if(!(empty($comment))){
            if(Auth::user()->role == 'user'){
                $user_id = Comments::query()->where('id', $id)->get('user_id')->toArray();
                if($user_id[0]['user_id'] == Auth::user()->id) 
                {
                    return view('home.comment.edit', ['comment'=> Comments::query()->where('id', $id)->get('comment')->toArray(), 'id'=>$id]);
                }
                else{
                    session()->flash('status', 'دسترسی غیرمجاز');
                    return redirect()->back();
                }
            } else {
            return view('home.comment.edit', ['comment'=>$comment , 'id'=>$id]);
            }
        }
        else{
            session()->flash('status', 'کامنت حذف شده یا وجود ندارد');
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
        $data = Comments::query()->where('id', $id)->get()->toArray();
        $create = new Notification;
        $create->title = 'Your Comment was EDITED';
        $create->content = $data[0]['comment'];
        $create->user_id = $data[0]['user_id'];
        $create->comment_id = $data[0]['id'];
        $create->admin_id = Auth::id();
        $create->type = 'edit';
        $create->part = 'comment';
        $create->save();
        Comments::query()->where('id', $id)->update(['comment'=>$request->input('edited_text')]);
        $postId = Comments::query()->where('id', $id)->get('new_id')->toArray();
        session()->flash('status', 'کامنت شما ویرایش شد');
        return redirect()->route('news.show', ['news'=>$postId[0]['new_id']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Comments::query()->where('id', $id)->get()->toArray();
        $create = new Notification;
        $create->title = 'Your Comment was REMOVED';
        $create->content = $data[0]['comment'];
        $create->user_id = $data[0]['user_id'];
        $create->admin_id = Auth::id();
        $create->type = 'delete';
        $create->part = 'comment';
        $create->save();
        Comments::query()->where('id', $id)->delete();
        session()->flash('status', 'کامنت شما حذف شد');
        return redirect()->back();
    }
}
