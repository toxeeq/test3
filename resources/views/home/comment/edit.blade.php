@extends('layouts.app')

@section('title', 'ویرایش')
@section('style', 'rtl')
@section('content')
<form action="{{ route('comment.update',$id) }}" method="POST" class="form-group">
{{ method_field('PUT') }}
@csrf
<br>
<div><input type="text" name="edited_text" style="padding: 30px 50px" value="{{ $comment[0]['comment'] }}" class="form-control"></div>
<button class="btn btn-success btn-lg">تایید</button>
</form>
@endsection