@extends('layouts.pagebuilder.app')
@section('content')

<div class="container">
    <div class="py-5 text-center">
    <h2>Website Manager</h2>
</div>

<div class="row">
    <div class="col-12 bg-light">
        <form class="login-form mt-3" method="post" action="http://localhost:8000/admin/auth?action=login">
            
            <input type="text" name="email" class="form-control mb-2 @error('email') is-invalid @enderror" placeholder="Enter Email " autofocus>
            @error('email')  <small class="text-danger">{{$message}}</small>  @enderror
            <input type="password" name="password" class="form-control mb-4 @error('password') is-invalid @enderror" placeholder="Password" required>
            @error('password')  <small class="text-danger">{{$message}}</small>  @enderror
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>
    </div>
</div>


</div>
@endsection