@extends('layout.guest')
@section('content')
    <div class="col-md-4 col-md-offset-4">
        <div class="login-wrapper">
            <div class="box">
                <div class="content-wrap">
                    <h6 class="text-center">{{ trans('user.register_title') }}</h6>
                    {{ Form::open(['url' => action('Auth\AuthController@register')]) }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => trans('user.placeholder_name'),]) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
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
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {{ Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('user.placeholder_password_confirm'),]) }}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="action text-center">
                            <button class="btn btn-primary signup" type="submit">{{ trans('user.register_button') }}</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>

            <div class="already">
                <p>{{ trans('user.account_already') }}</p>
                <a href="{{ action('Auth\AuthController@showLoginForm') }}">{{ trans('user.login_button') }}</a>
            </div>
        </div>
    </div>
@endsection