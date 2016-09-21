@extends('layout.guest')

@section('content')
<div class="col-md-6 col-md-offset-3">
    <div class="login-wrapper">
        <div class="box">
            <div class="content-wrap">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                {{ Form::open(['url' => action('Auth\PasswordController@sendResetLinkEmail'), 'class' => 'form-horizontal', 'role' => 'form']) }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">{{ trans('user.email_label') }}</label>

                        <div class="col-md-6">
                            {{ Form::text('email', old('email'), ['id' => 'email', 'class' => 'form-control', 'placeholder' => trans('user.placeholder_email'),]) }}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-envelope">{{ trans('user.send_link_reset_button') }}</i>
                            </button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
