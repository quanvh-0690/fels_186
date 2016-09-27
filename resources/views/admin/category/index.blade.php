@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">{{ trans('category.list') }}</div>
                </div>
                <div class="panel-body">
                    @include('common.block_alert')
                    @if ($categories)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('category.id') }}</th>
                                    <th>{{ trans('category.name') }}</th>
                                    <th>{{ trans('category.parent_category') }}</th>
                                    <th>{{ trans('category.total_lessons') }}</th>
                                    <th width="25%">{{ trans('layout.actions.title') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->parentcategory->name or '' }}</td>
                                        <td>{{ $category->lessons_count }}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> {{ trans('layout.actions.add', ['name' => 'Lesson']) }}</button>
                                            <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-eye-open"></i> {{ trans('layout.actions.view') }}</a>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
                                            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $category->id }}"><i class="fa fa-trash-o"></i> {{ trans('layout.actions.delete') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{ $categories->render() }}
                        </div>
                    @else
                        <div class="alert">{{ trans('category.no_results') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
