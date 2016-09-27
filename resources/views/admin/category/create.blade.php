@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="content-box-header">
                <div class="panel-title">{{ trans('category.add_category') }}</div>
            </div>
            <div class="content-box-large box-with-header">
                {{ Form::open(['route' => 'admin.categories.store', 'class' => 'form-horizontal', 'role' => 'form']) }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name', trans('category.category_name'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name', null, ['placeholder' => trans('category.category_name'), 'class' => 'form-control', 'id' =>'name']) }}
                            @include('common.block_error', ['field' => 'name'])
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                        {{ Form::label('parent_id', trans('category.parent_category'), ['class' => 'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('parent_id', $parent_categories, null, ['class' => 'form-control', 'placeholder' => '']) }}
                            @include('common.block_error', ['field' => 'parent_id'])
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