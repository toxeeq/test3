@extends('layouts.app')
@section('title', 'Edit User')
@section('style', 'rtl')
@section('content')
<div style="background-color:rgb(241, 73, 185); border-radius:10px; padding:5px; width:20%; float: left;">
    <h1 style="text-align: center">Users</h1>
        @foreach ($data as $user)
        <div class="my-2 my-md-0 mr-md-3" style="float: left; padding-left:10px">
            <h5 style="float: left"><a href="http://127.0.0.1:8000/user/{{ $user['id'] }}" style="text-decoration: none; color:black">{{ $user['name'] }}</a></h5>
            @if (!(empty($user['sex'])))
            <span style="background-color: green; border-radius:10px; padding:3px; float: left; font-size:12px">{{ $user['sex'] }}</span>  
            @endif
            <br>
            <br>
            <label style="float:left;">:Email</label>
            <input value="{{ $user['email'] }}" readonly class="form-control">
            <div style="float: left">Role: {{ $user['role'] }}</div>
            <br>
            <br>
        </div>
    @endforeach
</div>
@endsection