@extends('layouts.app-logo-only')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 mt25 ">
            <div class="card myCard">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('login') }}" class="myForm">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="">E-Mail Address</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class="">Password</label>

                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <hr>

                        <div class="form-group mb-0">
                          <button type="submit" class="btn btn-primary btn-lg">
                              Login
                          </button>

                          <a class="btn btn-link" href="{{ url('password/reset') }}">
                              Forgot Your Password?
                          </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
