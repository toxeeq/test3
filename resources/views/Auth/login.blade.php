@extends('layouts.app')
@section('title', 'Login')
@section('style', 'rtl')
@section('content')
<form method="POST" action="{{ route('login') }}" style="width: 30%">
@csrf

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
<button type="submit" class="btn btn-primary btn-block">ورود</button>

<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" 
        value="{{ old('remember') ? 'checked': '' }}"> 

        <label class="form-check-label" for="remember" style="float:left; color:white">Remember Me</label>
    </div>
</div>
</form>
@endsection