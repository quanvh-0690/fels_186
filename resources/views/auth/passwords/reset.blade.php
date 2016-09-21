@extends('layout.guest')

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="login-wrapper">
            <div class="box">
                <div class="content-wrap">
                    {{ Form::open(['url' =>  action('Auth\PasswordController@reset'), 'class' => 'form-horizontal', 'role' => 'form']) }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ trans('user.email_label') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}">
                                {{ Form::text('email', $email or old('email'), ['id' => 'email', 'class' => 'form-control', 'placeholder' => trans('user.placeholder_email'),]) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ trans('user.password_label') }}</label>

                            <div class="col-md-6">
                                {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => trans('user.placeholder_password'),]) }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">{{ trans('user.password_confirm_label') }}</label>
                            <div class="col-md-6">
                                {{ Form::password('password_confirmation', ['id' => 'password-confirm', 'class' => 'form-control', 'placeholder' => trans('user.placeholder_password'),]) }}
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i> {{ trans('user.reset_password_button') }}
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
