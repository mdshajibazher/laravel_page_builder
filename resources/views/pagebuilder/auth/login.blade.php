@extends('layouts.pagebuilder.app')
@section('content')

<div class="container-fluid">

<div class="row justify-content-center" style="margin-top: 15%">
    <div class="col-md-4 p-3" style="background: #ecf0f1;border-radius: 10px">
        <h4 class="text-center">Website Manager</h4>
        <form class="login-form mt-3" method="post" action="{{route('login')}}">
            @csrf
            @if(Session::has('status')) 
                 <p class="alert alert-succes">{{Session::get('status')}}</p>
            @endif
            <input type="text" name="email" class="form-control mb-2 @error('email') is-invalid @enderror" placeholder="Enter Email " >
            @error('email')  <small class="text-danger">{{$message}}</small>  @enderror
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" >
            @error('password')  <small class="text-danger">{{$message}}</small>  @enderror
            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Login</button>
        </form>
    </div>
</div>


</div>
@endsection