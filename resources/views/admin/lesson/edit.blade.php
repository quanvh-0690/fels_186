@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="content-box-header">
                <div class="panel-title">{{ trans('lesson.edit_lesson') }}</div>
            </div>
            <div class="content-box-large box-with-header">
                @include('common.block_alert')
                {{ Form::model($lesson, ['route' => ['admin.lessons.update', $lesson->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'role' => 'form']) }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name', trans('lesson.lesson_name'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name', null, ['placeholder' => trans('lesson.lesson_name'), 'class' => 'form-control', 'id' =>'name']) }}
                            @include('common.block_error', ['field' => 'name'])
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                        {{ Form::label('category_id', trans('lesson.category'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => '']) }}
                            @include('common.block_error', ['field' => 'category_id'])
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        {{ Form::label('description', trans('lesson.lesson_description'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('description', null, ['placeholder' => trans('lesson.lesson_description'), 'class' => 'form-control', 'id' =>'description']) }}
                            @include('common.block_error', ['field' => 'description'])
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button class="btn btn-primary" type="submit">{{ trans('layout.actions.edit') }}</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection