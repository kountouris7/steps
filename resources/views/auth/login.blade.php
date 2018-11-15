@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-title center-align">
                <strong>LOGIN</strong>
            </div>
            <div class="row">

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-field col s6">
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                        <label for="email">{{ __('E-Mail Address') }}</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                        <label for="password">{{ __('Password') }}</label>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 center-align">
                        <button type="submit" class="waves-effect pink accent-3 btn-large">
                            {{ __('Login') }}
                        </button>

                        <a class="waves-effect pink accent-3 btn-large" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
