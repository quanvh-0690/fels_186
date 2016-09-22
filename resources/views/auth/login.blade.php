@extends('layout.guest')
@section('content')
    <div class="col-md-4 col-md-offset-4">
        <div class="login-wrapper">
            <div class="box">
                <div class="content-wrap">
                    <h6 class="text-center">{{ trans('user.login_title') }}</h6>
                    {{ Form::open(['url' => action('Auth\AuthController@login')]) }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::text('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => trans('user.placeholder_email'),]) }}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => trans('user.placeholder_password'),]) }}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('remember') }}
                                    {{ trans('user.remember_label') }}
                                </label>
                            </div>
                        </div>
                        <div class="action text-center">
                            <button class="btn btn-primary signup" type="submit">{{ trans('user.login_button') }}</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="already">
                <p>{{ trans('user.forgot_password_label') }}</p>
                <a href="{{ action('Auth\PasswordController@showResetForm') }}">{{ trans('user.link_to_recover_password') }}</a>
            </div>
        </div>
    </div>
@endsection