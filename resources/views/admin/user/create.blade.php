@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="content-box-header">
                <div class="panel-title">{{ trans('user.add_user') }}</div>
            </div>
            <div class="content-box-large box-with-header">
                {{ Form::open(['route' => 'admin.users.store', 'class' => 'form-horizontal', 'role' => 'form']) }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name', trans('user.name'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name', null, ['placeholder' => trans('user.name'), 'class' => 'form-control', 'id' =>'name']) }}
                            @include('common.block_error', ['field' => 'name'])
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::label('email', trans('user.email'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('email', null, ['placeholder' => trans('user.email'), 'class' => 'form-control', 'id' =>'email']) }}
                            @include('common.block_error', ['field' => 'email'])
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        {{ Form::label('password', trans('user.password'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('password', null, ['placeholder' => trans('user.password'), 'class' => 'form-control', 'id' =>'password']) }}
                            @include('common.block_error', ['field' => 'password'])
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {{ Form::label('password_confirmation', trans('user.password_confirmation'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('password_confirmation', null, ['placeholder' => trans('user.password_confirmation'), 'class' => 'form-control', 'id' =>'password_confirmation']) }}
                            @include('common.block_error', ['field' => 'password_confirmation'])
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button class="btn btn-primary" type="submit">{{ trans('layout.actions.add_btn_title') }}</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection