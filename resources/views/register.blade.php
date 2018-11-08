@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-title center-align">
                <strong>REGISTER</strong>
            </div>

            <div class="row">
                <form method="POST" action="{{ route('register.user') }}" class="col s12">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" value="{{ old('name') }}" placeholder="Name"
                                   required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                            <label for="name">{{ __('Name') }}</label>
                        </div>


                        <div class="input-field col s6">
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" placeholder="E-Mail"
                                   required>
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
                                   name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            <label for="password">{{ __('Password') }}</label>
                        </div>

                        <div class="input-field col s6">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation"
                                   placeholder="Password confirmation" required>
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        </div>

                    {{----}}    <div class="input-field col s6">
                            <input id="token" type="text"
                                   class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}"
                                   name="token" placeholder="Paste activation code" required>

                            @if ($errors->has('token'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('token') }}</strong>
                                    </span>
                            @endif
                            <label for="token">{{ __('Activation code') }}</label>
                        </div>

                        <div class="col s12 center-align">
                            <button type="submit"
                                    class="waves-effect pink accent-3 btn-large"> {{ __('Register') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
