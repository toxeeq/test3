@extends('layouts.app')
@section('title', 'Register')
@section('style', 'rtl')
@section('content')
<form method="POST" action="{{ route('register') }}" style="width: 30%">
@csrf
<div class="form-group">
    <label>نام</label>
    <input name="name" value="{{ old('name') }}" required
     class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}" >
 
</div>
<div class="form-group">
    <label>ایمیل</label>
    <input name="email" value="{{ old('email') }}" required
     class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="example@mail.com">
     @if($errors->has('name'))
     <span class="invalid-feedback">
         <strong>{{ $errors->first('name') }}</strong>
     </span>
  @endif
</div>
<div class="form-group">
    <label>کلمه ی عبور</label>
    <input name="password" required type="password"
    class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}">
    @if($errors->has('name'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('name') }}</strong>
    </span>
 @endif
</div>
<div class="form-group">
    <label>تکرار کلمه ی عبور</label>
    <input name="password_confirmation" required class="form-control" type="password">
</div>
<button type="submit" class="btn btn-primary btn-block">ثبت نام</button>
</form>
@endsection