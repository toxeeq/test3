@extends('layouts.app')
@section('title', 'Edit User')
@section('style', 'rtl')
@section('content')
<form action="{{ route('user.update', $id) }}" method="POST" class="form-group" style="width: 25%; float: left;background-color:rgb(178, 183, 187); border-radius:10px; padding:10px">
    {{ method_field('PUT') }}
    @csrf
    <label style="float: left">Name</label>
    <div><input type="text" name="name" value="{{ $data[0]['name'] }}" class="form-control"></div>
    <label style="float: left">Email</label>
    <div><input type="text" name="email" value="{{ $data[0]['email'] }}" class="form-control"></div>
    <label style="float: left">Address</label>
    <div><input type="text" name="address" value="{{ $data[0]['address'] }}" class="form-control"></div>
    <label style="float: left">Role</label>
    <div>
        <select name="role" class="form-select">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
    </div>
    <label style="float: left">Sex</label>
    <div>
        <select name="sex" class="form-select">
            <option value="">-----</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
    <button class="btn btn-success btn-lg" style="float: left;">Submit</button>
</form>
@endsection