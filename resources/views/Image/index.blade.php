@extends('layouts.app')
@section('title', ' Edit Picture')
@section('style', 'rtl')
@section('content')

@if ($errors->any())
   <div class="alert alert-danger">
     <ul>
     @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
     @endforeach
     </ul>
   </div>
@endif
<div>
<form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data" style="background-color:white; border-radius:10px; padding:10px; width:40%; float:left">
        @csrf
    <div class="form-group">
        <label style="color: black;float: left;">Upload Image</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
        <input type="file" name="file" required style="float: left">
    </div>
    <button type="submit" style="float: left">Submit</button>
    <br>
    <br>
</form>
</div>
@endsection