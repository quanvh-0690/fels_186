@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="content-box-header">
                <div class="panel-title">{{ trans('answer.add_answer') }}</div>
            </div>
            <div class="content-box-large box-with-header">
                {{ Form::open(['route' => 'admin.answers.store', 'class' => 'form-horizontal', 'role' => 'form']) }}
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        {{ Form::label('content', trans('answer.content'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('content', null, ['placeholder' => trans('answer.content'), 'class' => 'form-control', 'id' =>'content']) }}
                            @include('common.block_error', ['field' => 'content'])
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('lesson_id') ? ' has-error' : '' }}">
                        {{ Form::label('lesson_id', trans('answer.lesson'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('lesson_id', $lessons, null, ['class' => 'form-control']) }}
                            @include('common.block_error', ['field' => 'lesson_id'])
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('word_id') ? ' has-error' : '' }}">
                        {{ Form::label('word_id', trans('answer.word'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('word_id', $words, null, ['class' => 'form-control']) }}
                            @include('common.block_error', ['field' => 'word_id'])
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('is_correct', trans('answer.is_correct'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-md-9 checkbox">
                            <label>
                                <input type="checkbox">
                            </label>
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