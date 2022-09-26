@extends('base') 
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endpush
@section('content')

<div class="container-fluid">
        <div class="wrapper">
            <div class="logo">
                <img src="{{ asset('images/seeklogo.png') }}" alt="">
            </div>
            <div class="text-center mt-4 name">
                Login
            </div>
            <form method="post" class="p-3 mt-3" action="{{ route('login.custom')}}">
                 @csrf
                <div class="form-field d-flex align-items-center">
                    <span class="fa fa-user"></span>
                    <input type="text" name="name" id="name" placeholder="Username">
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name')}}</span>
                    @endif
                </div>
                <div class="form-field d-flex align-items-center">
                    <span class="fa fa-key"></span>
                    <input type="password" name="password" id="pwd" placeholder="Password">
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn mt-3">Login</button>
            </form>
        </div>
    </div>

@endsection