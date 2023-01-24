@extends('layouts.app')
@section('title' , 'Profile')
@section('style', 'rtl')
@section('content')
<div style="background-color: rgb(159, 165, 168); border-radius:5px; width: 30%; padding: 10px; float: left; opacity: 1">
    <div style="width:100%">
    <a href="http://127.0.0.1:8000/notification"><img src="https://s6.uupload.ir/files/565422_jrzm.png" alt="Notification" class="img-fluid rounded-circle" width="50" height="50" style="float:right; background-color:white; padding:10px"></a>
    <b style="float: left; font-size:30px">{{ Auth::user()->name }}</b></div>
    @if (!(empty(Auth::user()->sex)))
    <span style="background-color: green; border-radius:10px; padding:5px; float: left; font-size:12px">{{ Auth::user()->sex }}</span>    
    @endif
    <br>
    <br>
    <div><h6 style="float: left">:Joined At</h6><br><b style="float: right">{{ Auth::user()->created_at }}</b></div>
    <br>
    <div><h6 style="float: left">:Email Address</h6> 
        <br><b style="float: right"><input value="{{ Auth::user()->email }}" readonly class="form-control" style="font-size: 80%; background-color:rgb(154, 143, 165)"></b></div>
    <br>
    <br>
    @if (!empty(Auth::user()->address))
        <div><h6 style="float: left">:Address </h6><br><address style="flaot:right">{{ Auth::user()->address }}</address></div>
        <br>
    @endif

    <div><h6 style="float: left">User ID: <b>{{ Auth::user()->id }}</b></h6> 
        <br>
        <br>
    <div><h6 style="float: left"><b>!</b>You Are <b>{{ Auth::user()->role }}</b></h6>
        <br>
        <br>
    <a href="{{ route('profile.edit', Auth::user()->id) }}">Edit</a>
</div>
@endsection