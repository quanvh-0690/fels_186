@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="content-box-header">
                <div class="panel-title">{{ trans('lesson.add_lesson') }}</div>
            </div>
            <div class="content-box-large box-with-header">
                <div class="alert" style="display: none;">
                    <button class="close" type="button" data-dismiss="alert">&times;</button>
                    <div class="content"></div>
                </div>
                {{ Form::open(['route' => 'admin.lessons.store', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'form-create-lesson', 'onsubmit' => 'return false;']) }}
                    <div class="form-group">
                        {{ Form::label('name', trans('lesson.lesson_name'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name', null, ['placeholder' => trans('lesson.lesson_name'), 'class' => 'form-control', 'id' =>'name']) }}
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('category_id', trans('lesson.category_of_lesson'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', trans('lesson.lesson_description'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('description', null, ['placeholder' => trans('lesson.lesson_description'), 'class' => 'form-control', 'id' =>'description']) }}
                            <span class="help-block">
                                <strong></strong>
                            </span>
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

@section('script')
    {{ Html::script('/js/admin_lessons.js') }}
@endsection