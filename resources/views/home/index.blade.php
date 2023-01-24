@extends('layouts.app')
@section('title')
صفحه اصلی
@endsection
@section('style', 'rtl')
@section('content')
<div style="color: rgb(255, 115, 115)">
<h1 style="text-align:right; width: fit-content; font-size: 50px">سر تیتر تاپیک ها</h1>
</div> 
<br>
<div style="background-color:cyan; width: 30%; border-radius: 10px; opacity: 0.8">
@foreach ($new as $key=> $number)
@if($loop->even)
<li style="border-right: 5px solid red;text-align:right; width: 100%; display:block; font-size: 30px;padding-top:5px"> 
    <a href="http://127.0.0.1:8000/news/{{ $key + 1 }}", style="color: rgb(231, 197, 3); text-decoration: none; padding: 5px 10px; opacity: 1">{{ $key + 1 }}. {{ $number['title'] }}</a>
</li>    
@else
<li style="border-right: 5px solid red;text-align:right; width: 100%; display:block; font-size: 30px;padding-top:5px;"> 
    <a href="http://127.0.0.1:8000/news/{{ $key + 1 }}", style="color: rgb(255, 255, 255);text-decoration: none; padding: 5px 10px; opacity: 1">{{ $key + 1 }}. {{ $number['title'] }}</a>
</li>  
@endif
@endforeach
</div>
@endsection