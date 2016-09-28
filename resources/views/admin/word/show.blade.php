@extends('layout.master')
@section('content')
    <div class="col-md-12">
        <div class="content-box-header">
            <div class="panel-title">{{ trans('word.details') }}</div>
        </div>
        <div class="content-box-large box-with-header">
            <div class="row">
                <div class="col-md-5">
                    <h3>{{ $word->content }}</h3>
                    <p><strong>{{ trans('word.lesson') }}</strong> {{ $word->lesson->name or '' }}</p>
                    <p><strong>{{ trans('layout.created_at') }}</strong> {{ $word->created_at }}</p>
                    <a href="{{ route('admin.words.edit', $word->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
                    <hr>

                    <div class="row">
                        <div class="col-md-12 panel-primary">
                            <div class="content-box-header">
                                <div class="panel-title">{{ trans('word.add_answer') }}</div>
                            </div>
                            <div class="content-box-large box-with-header">
                                <div class="alert" style="display: none;">
                                    <button class="close" type="button" data-dismiss="alert">&times;</button>
                                    <div class="content"></div>
                                </div>
                                {{ Form::open(['route' => ['admin.words.add_answer', $word->id], 'class' => 'form-horizontal', 'role' => 'form', 'onsubmit' => 'return false;', 'id' => 'form-add-answer']) }}
                                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                    {{ Form::label('content', trans('answer.content'), ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-10">
                                        {{ Form::text('content', null, ['placeholder' => trans('answer.content'), 'class' => 'form-control', 'id' =>'content']) }}
                                        <span class="help-block">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('is_correct', trans('answer.is_correct'), ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-md-9 checkbox">
                                        <label>
                                            {{ Form::checkbox('is_correct', 1) }}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn btn-primary" type="submit">{{ trans('layout.actions.add_btn_title') }}</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h4>{{ trans('word.answers_of_word') }}</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ trans('word.answer.id') }}</th>
                            <th>{{ trans('word.answer.content') }}</th>
                            <th>{{ trans('word.answer.is_correct') }}</th>
                            <th width="25%">{{ trans('layout.actions.title') }}</th>
                        </tr>
                        @foreach ($word->answers as $answer)
                            <tr class="list-answers">
                                <td>{{ $answer->id }}</td>
                                <td>{{ $answer->content }}</td>
                                <td><i class="fa fa-{{ $answer->is_correct ? 'check text-success' : 'times text-danger' }}"></i></td>
                                <td>
                                    <a href="{{ route('admin.words.edit', $word->id) }}" class="btn btn-primary btn-sm btn-edit-answer"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $word->id }}"><i class="fa fa-trash-o"></i> {{ trans('layout.actions.delete') }}</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="list-answers hidden">
                            <td></td>
                            <td></td>
                            <td><i></i></td>
                            <td>
                                <a class="btn btn-primary btn-sm btn-edit-answer"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
                                <button class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash-o"></i> {{ trans('layout.actions.delete') }}</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{ Html::script('/js/admin_answers.js') }}
@endsection