@extends('layouts.app')
@section('title', 'Notification')
@section('style', 'rtl')
@section('content')
<a href="{{ URL::previous() }}"; style="color: black; float:left; padding:10px 10px; font-size: 30px; text-decoration: none; border: 1px solid rgb(31, 255, 225); border-radius: 10px; background: rgb(31, 255, 225)">بازگشت</a>
<br>
<br>
<br>
<br>
<div style="background-color: whitesmoke; border-radius:5px; width:100%;text-align: center; padding:50px">
<h1>{{ $notification[0]['title'] }}</h1>
<br>
@if ($notification[0]['part'] == 'comment')
<div>Your '{{ $notification[0]['content'] }}' Comment {{ $notification[0]['type'] }} by <a href="http://127.0.0.1:8000/user/{{ $notification[0]['admin_id'] }}" style="text-decoration: none; color:black">User[{{ $notification[0]['admin_id'] }}]</a></div>
@if ($notification[0]['type'] == 'edit')
@foreach ($comment as $cm)
    @if ($cm['id'] == $notification[0]['comment_id'])
        <div>New Comment: {{ $cm['comment'] }}</div>
    @endif
@endforeach
@endif
@elseif ($notification[0]['part'] == 'topic')
@if ($notification[0]['type'] == 'edit')
<div>The '{{ $notification[0]['content'] }}' Topic {{ $notification[0]['type'] }} by <a href="http://127.0.0.1:8000/user/{{ $notification[0]['admin_id'] }}" style="text-decoration: none; color:black">User[{{ $notification[0]['admin_id'] }}]</a></div>   
@foreach ($topic as $tp)
    @if ($tp['id'] == $notification[0]['comment_id'])
        <div><a href="http://127.0.0.1:8000/news/{{ $notification[0]['comment_id'] }}">View Topic</a></div>
    @endif
@endforeach
@else
<div>{{ $notification[0]['content'] }}</div>
<br>
@if (!(empty($notification[0]['comment_id'])))
<a href="http://127.0.0.1:8000/news/{{ $notification[0]['comment_id'] }}">View Topic</a>
@endif
@endif
@if ($notification[0]['part'] == 'topic' && $notification[0]['type'] == 'request')
@can('admin')
    <form method="POST" action="{{ route('news.store') }}">
@csrf
<select class="form-select" name="status">
    <option value="reject">Reject</option>
    <option value="confirm">Confirm</option>
</select>
<input value="{{ $notification[0]['admin_id'] }}" name="creator_id" hidden>
<input value="{{ $notification[0]['title'] }}" name="title" hidden>
<input value="{{ $notification[0]['content'] }}" name="content" hidden>
<button class="btn btn-primary" type="submit" style="float: right">Submit</button>
</form>
@endif
</div>     
@endcan
@endif
@endsection