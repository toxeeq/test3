@extends('layouts.app')
@section('title' , 'User')
@section('style', 'rtl')
@section('content')
<a href="{{ URL::previous() }}"; style="color: black; float:left; padding:10px 10px; font-size: 30px; text-decoration: none; border: 1px solid rgb(31, 255, 225); border-radius: 10px; background: rgb(31, 255, 225)">بازگشت</a>
<br>
<br>
<br>
<br>
<div style="background-color: rgb(159, 165, 168); border-radius:5px; width: 30%; padding: 10px; float: left; opacity: 1">
    <div style="width:100%"><a href="https://s6.uupload.ir/files/download_(1)_iy.png"><img src="https://s6.uupload.ir/files/download_(1)_iy.png" alt="Logo" class="img-fluid rounded-circle" width="50px" height="50px" style="float: right;"></a>
    <b style="float: left; font-size:30px">{{ $data[0]['name'] }}</b></div>
    @if (!(empty($data[0]['sex'])))
    <span style="background-color: green; border-radius:10px; padding:5px; float: left; font-size:12px">{{ $data[0]['sex'] }}</span>     
    @endif
    <br>
    <br>
    <div><h6 style="float: left">:Joined At</h6><br><b style="float: right">{{ substr($data[0]['created_at'], 0 , -17) }}</b></div>
    <br>
    @can('admin')
    <div><h6 style="float: left">:Email Address</h6> 
        <br><b style="float: right"><input value="{{ $data[0]['email'] }}" readonly class="form-control" style="font-size: 80%; background-color:rgb(154, 143, 165)"></b></div>
    <br>
    <br>
    @if (!empty($data[0]['address']))
        <div><h6 style="float: left">:Address </h6><br><address style="flaot:right">{{ $data[0]['address'] }}</address></div>
        <br>
    @endif
    @endcan
    <div><h6 style="float: left">User ID: <b>{{ $data[0]['id']}}</b></h6> 
        <br>
        <br>
    <div><h6 style="float: left"><b>!</b><b>{{ $data[0]['role'] }}</b></h6>
        <br>
        <br>
        @can('admin')
            <a href="{{ route('user.edit', $data[0]['id']) }}">Edit</a>
        @endcan

</div>
@endsection