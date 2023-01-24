@extends('layouts.app')
@section('title', 'Notification')
@section('style', 'rtl')
@section('content')
<a href="{{ URL::previous() }}"; style="color: black; float:left; padding:10px 10px; font-size: 30px; text-decoration: none; border: 1px solid rgb(31, 255, 225); border-radius: 10px; background: rgb(31, 255, 225)">بازگشت</a>
<br>
<br>
<br>
<br>
<div style="background-color:red; float: left; width:40%; border-radius:10px; padding:10px">
@if (!(empty($notification)))
    @foreach ($notification as $notifi)
    @if ($notifi['part'] == 'comment')
        <div style="border-bottom: 2px dotted black">
        <div style="float: left;"><a href="http://127.0.0.1:8000/notification/{{ $notifi['id'] }}" style="text-decoration: none;color:black;">{{ $notifi['title'] }}</a></div>
        @if ($notifi['created_at'] == $notifi['updated_at'])
            <span class="badge badge-pill badge-success" style="background: green; font-size:10px;float:left;">new notification</span>
        @endif
        <div>{{ substr($notifi['created_at'], 0 , -17) }}</div>
        </div>
    @elseif ($notifi['part'] == 'topic')
    <div style="border-bottom: 2px dotted black">
        <div style="float: left;"><a href="http://127.0.0.1:8000/notification/{{ $notifi['id'] }}" style="text-decoration: none;color:black;">{{ $notifi['type'] }}1 Topic: <a href="http://127.0.0.1:8000/user/{{ $notifi['admin_id'] }}" style="text-decoration: none;color:black;">User[{{ $notifi['admin_id'] }}]</a></a></div>
        @if ($notifi['created_at'] == $notifi['updated_at'])
            <span class="badge badge-pill badge-success" style="background: green; font-size:10px;float:left;">new notification</span>
        @endif
        <div>{{ substr($notifi['created_at'], 0 , -17) }}</div>
        </div>
    @endif

@endforeach
</div>
@else
<h1 style="background-color: red; border-radius:10px; padding:10px">نوتیفیکیشنی وجود ندارد</h1>
@endif
@endsection