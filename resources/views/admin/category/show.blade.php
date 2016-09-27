@extends('layout.master')
@section('content')
    <div class="col-md-offset-1 col-md-10">
        <div class="content-box-header">
            <div class="panel-title">{{ trans('category.details') }}</div>
        </div>
        <div class="content-box-large box-with-header">
            <div class="row">
                <div class="col-md-5">
                    <h3>{{ $category->name }}</h3>
                    <p><strong>{{ trans('category.parent_category') }}</strong> {{ $category->parentCategory->name or '' }}</p>
                    <p><strong>{{ trans('layout.created_at') }}</strong> {{ $category->created_at }}</p>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
                </div>
                <div class="col-md-7">
                    <h4>{{ trans('category.lessons_of_category') }}</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ trans('layout.admin.lessons.id') }}</th>
                            <th>{{ trans('layout.admin.lessons.name') }}</th>
                            <th>{{ trans('layout.admin.lessons.description') }}</th>
                        </tr>
                        @foreach ($category->list_lessons as $lesson)
                            <tr>
                                <td>{{ $lesson->id }}</td>
                                <td>{{ $lesson->name }}</td>
                                <td>{{ $lesson->description }}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection