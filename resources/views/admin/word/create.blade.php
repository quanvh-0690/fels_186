@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="content-box-header">
                <div class="panel-title">{{ trans('word.add_word') }}</div>
            </div>
            <div class="content-box-large box-with-header">
                {{ Form::open(['route' => 'admin.words.store', 'class' => 'form-horizontal', 'role' => 'form']) }}
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        {{ Form::label('content', trans('word.content'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('content', null, ['placeholder' => trans('word.content'), 'class' => 'form-control', 'id' =>'content']) }}
                            @include('common.block_error', ['field' => 'content'])
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('lesson_id') ? ' has-error' : '' }}">
                        {{ Form::label('lesson_id', trans('word.lesson'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('lesson_id', $lessons, null, ['class' => 'form-control']) }}
                            @include('common.block_error', ['field' => 'lesson_id'])
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