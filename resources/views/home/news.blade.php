@extends('layouts.app')
@section('title')
        {{ $new['title'] }}
@endsection
@section('style', 'rtl')
@section('content')
<div style="display: flex; flex-flow:column; justify-content:space-between; height:100%">
<div>
<a href="{{ URL::previous() }}"; style="color: black; float:left; padding:10px 10px; font-size: 30px; text-decoration: none; border: 1px solid rgb(31, 255, 225); border-radius: 10px; background: rgb(31, 255, 225)">بازگشت</a>
<b style="padding: 0px 3px; font-size: 50px; color: rgb(252, 190, 190)">تیتر تاپیک: {{ $new['title'] }}</b>
@if (now()->diffInMinutes($new->created_at) < 180)
    <span class="badge badge-pill badge-success" style="background: green; font-size:15px">تاپیک جدید!</span>
@endif

<div style="background-color:cyan; width: 100%; border-radius: 10px; opacity: 0.7; border-right: 5px solid red;border-left: 5px solid red;">
<div style="background-color:cyan; width: 100%; border-radius: 10px; opacity: 1; font-size: 35px; width: 100%; padding-right: 5px; color:black;">{{ $new['content'] }}
</div>
<div style="float: left; font-size: 15px; padding-left: 5px; ">Created by: <a href="http://127.0.0.1:8000/user/{{ $new['creator_id'] }}" style="text-decoration:none; color:black">{{ $new['creator'] }}</a></div>
@if (!(empty($new['editor'])))
<div style="float: right; font-size: 15px; padding-right: 5px;">Edit by: <a href="http://127.0.0.1:8000/user/{{ $new['editor_id'] }}" style="text-decoration:none; color:black">{{ $new['editor'] }}</a></div>
@endif
<br>
</div>
<div style="float: left"><p style="float: left; color: white">Added {{ $new->created_at->diffForHumans() }}</p></div>
    @can('admin')
    <a href="http://127.0.0.1:8000/news/{{ $new->id }}/edit", style="text-decoration: none; font-size: 20px; color:black">ویرایش</a>     
    @endcan
    @can('user')
    @if ($new['creator_id'] == Auth::id())
    <a href="http://127.0.0.1:8000/news/{{ $new->id }}/edit", style="text-decoration: none; font-size: 20px; color:black">ویرایش</a>
    @endif
    @endcan

</div>
<div>
</div>
<div style="padding: 10px 0px; font-size: 20px; color:aqua">کامنت ها:
@if ($has_comment)
<?php $number = 0;?>
    @foreach ($comments as $key => $comment)
    <form action="{{ route('comment.destroy',$comment_id[$number]['id']) }}" method="post">
        <div style="border-bottom: 2px dotted white; padding: 20px 0px; width: 35%; font-size: 15px; color:chartreuse">
            [{{ $comment['user_id'] }}] <a href="http://127.0.0.1:8000/user/{{ $comment['user_id'] }}" style="text-decoration: none;color:chartreuse">{{ $comment['name'] . ":" }}</a> <br> {{ $comment['comment'] }}
           
                {{ method_field('DELETE') }}
                @csrf
                @can('user')
                @if ($comment['user_id'] == Auth::user()->id)
                    <button type="submit" style="float: left; font-size: 15px;" class="btn btn-danger">حذف</button>
                    <a href="http://127.0.0.1:8000/comment/{{ $comment_id[$number]['id'] }}/edit" 
                    style="float:left;text-decoration: none; font-size: 15px; background-color:yellow; border-radius:5px;padding: 7px;color:black">ویرایش</a>              
                @endif    
                @endcan
                @can('admin')          
                    <button type="submit" style="float: left; font-size: 15px;" class="btn btn-danger">حذف</button>
                    <a href="http://127.0.0.1:8000/comment/{{ $comment_id[$number]['id'] }}/edit" 
                    style="float:left;text-decoration: none; font-size: 15px; background-color:yellow; border-radius:5px;padding: 7px;color:black">ویرایش</a>              
                @endcan
            <?php $number = $number + 1;?>
        </div>
    </form>    
    @endforeach
@else
<div style="font-size: 20px; color:bisque">کامنتی وجود ندارد!</div>
@endif
<br>
@if (Auth::check())
<form method="POST" action="{{ route('comment.store') }}" class="form-group">
    @csrf
    <input type="text" name="new_id" value="{{ $new->id }}" hidden>
    <div><input type="text" name="comment" class="form-control" placeholder="کامنت جدید" style="width: 35%"></div>
    <br>
    <div style="color: white">
        <?php  
        $a = random_int(10 , 30);
        $b = random_int(10 , 30);
        ?>
        <input type="text" name="chapta">
        <input type="text" name="chapta_answer" value="{{ $a + $b }}" hidden>
        <label>= {{ $a }} + {{ $b }}</label>
        @if ($errors->has('error'))
        <div class="error" style="color:white; background-color:red; width: fit-content; border-radius:10px; padding: 5px">{{ $errors->first('error') }}</div>
        @endif
       
    </div>
    <button class="btn btn-primary btn-block">ثبت کامنت</button>
</form>   
@else
<div style="font-size: 30px; color:rgb(255, 21, 21); background-color: rgb(56, 56, 56); width: fit-content; border-radius: 10px; padding: 5px">برای ثبت کامنت جدید باید <a href="http://127.0.0.1:8000/login">لاگین</a> کنید.</div>
@endif
</div>
</div>
@endsection