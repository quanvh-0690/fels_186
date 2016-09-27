@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="content-box-header">
                <div class="panel-title">{{ trans('category.edit_category') }}</div>
            </div>
            <div class="content-box-large box-with-header">
                @include('common.block_alert')
                {{ Form::model($category, ['route' => ['admin.categories.update', $category->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'role' => 'form']) }}
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
                        {{ Form::select('parent_id', $parentCategories, null, ['class' => 'form-control', 'placeholder' => '',!$category->parent_id ? 'disabled' : '']) }}
                        @include('common.block_error', ['field' => 'parent_id'])
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