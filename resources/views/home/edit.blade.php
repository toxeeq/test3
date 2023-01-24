@extends('layouts.app')

@section('title', 'ویرایش')
@section('style', 'rtl')
@section('content')
<form action="{{ route('news.update',$id) }}" method="POST" class="form-group">
{{ method_field('PUT') }}
@csrf
<br>
<div><input type="text" name="edited_text" style="padding: 30px 50px;" value="{{ $new[0]['content'] }}" class="form-control"></div>
<button class="btn btn-success btn-lg" style="text-align: center">تایید</button>
</form>
@endsection

