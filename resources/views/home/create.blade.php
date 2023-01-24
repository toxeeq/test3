@extends('layouts.app')

@section('title', 'Create News')
@section('style', 'rtl')
@section('content')
<form action="{{ route('news.store') }}" method="POST" class="form-group">
@csrf
<div>
    <div style="font-size: 30px">تیتر</div>
    <input type="text" name="title" class="form-control">
</div>
<div>
    <div style="font-size: 30px">جزئیات</div>
    <input type="text" name="content" class="form-control">
</div>
<div style="text-align: center"><button class="btn btn-success">ساخت</button></div>
</form>
@endsection