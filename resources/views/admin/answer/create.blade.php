@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="content-box-header">
                <div class="panel-title">{{ trans('answer.add_answer') }}</div>
            </div>
            <div class="content-box-large box-with-header">
                <div class="alert" style="display: none;">
                    <button class="close" type="button" data-dismiss="alert">&times;</button>
                    <div class="content"></div>
                </div>
                {{ Form::open(['route' => ['admin.words.answers.store', $wordId], 'class' => 'form-horizontal', 'role' => 'form', 'onsubmit' => 'return false;', 'id' => 'form-create-answer']) }}
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        {{ Form::label('content', trans('answer.content'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('content', null, ['placeholder' => trans('answer.content'), 'class' => 'form-control', 'id' =>'content']) }}
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('word_id') ? ' has-error' : '' }}">
                        {{ Form::label('word_id', trans('answer.word'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('word_id', $words, $wordId, ['class' => 'form-control', 'disabled']) }}
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('is_correct', trans('answer.is_correct'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-md-9 checkbox">
                            <label>
                                {{ Form::checkbox('is_correct', 1) }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button class="btn btn-primary" type="submit" id="add-one-answer">{{ trans('layout.actions.add_btn_title') }}</button>
                            <button class="btn btn-primary" type="submit" id="add-more-answer">{{ trans('word.add_more_answer') }}</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{ Html::script('/js/admin_answers.js') }}
@endsection