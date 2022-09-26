@extends('base') 
@section('content')

<main class="signup-form">
    <div class="container" style="padding-top: 80px;">
        <div class="row">
            <div class="col-md-4">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                <div class="card">
                    <h3 class="card-header">
                        Register User
                    </h3>
                    <div class="card-body">
                        <form action="{{ route('register.custom')}}" method="POST">
                        @csrf
                            <div class="form-field d-flex align-items-center">
                                <span class="fa fa-user"></span>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Username">
                                @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-field d-flex align-items-center">
                                <span class="fa fa-user"></span>
                                <input type="text" name="email" class="form-control" placeholder="Email">
                                @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email')}}</span>
                                @endif
                            </div>
                            <div class="form-field d-flex align-items-center">
                                <span class="fa fa-key"></span>
                                <input type="password" class="form-control" name="password" id="pwd" placeholder="Password">
                                @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password')}}</span>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Register</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

</main>

@endsection