@extends('layouts.authmaster')

@section('content')
<form class="form-signin" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
  <!--    <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  -->
      <h2 class="h2 mb-3 font-weight-normal">Maprom | InsertTool</h2>
      <h4 class="h4 mb-3 font-weight-normal">Please sign in</h4>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

      <label for="email" class="sr-only">Email address</label>

      <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>
      @if ($errors->has('email'))
          <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
      @endif
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
      <label for="inputPassword" class="sr-only">Password</label>

      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      @if ($errors->has('password'))
          <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <a class="btn btn-link" href="{{ route('password.request') }}">
          Forgot Your Password?
      </a>

      <p class="mt-5 mb-3 text-muted"><!--&copy;--> Maprom database 2018</p>
    </form>



@endsection
