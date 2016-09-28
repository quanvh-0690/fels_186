@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">{{ trans('lesson.list') }}</div>
                </div>
                <div class="panel-body">
                    @include('common.block_alert')
                    @if ($lessons)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('lesson.id') }}</th>
                                    <th>{{ trans('lesson.name') }}</th>
                                    <th>{{ trans('lesson.category') }}</th>
                                    <th>{{ trans('lesson.total_words') }}</th>
                                    <th>{{ trans('lesson.lesson_description') }}</th>
                                    <th width="25%">{{ trans('layout.actions.title') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($lessons as $lesson)
                                <tr>
                                    <td>{{ $lesson->id }}</td>
                                    <td>{{ $lesson->name }}</td>
                                    <td>{{ $lesson->category->name or '' }}</td>
                                    <td>{{ $lesson->words->count() }}</td>
                                    <td>{{ $lesson->description }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> {{ trans('layout.actions.add', ['name' => 'Word']) }}</button>
                                        <a href="{{ route('admin.lessons.show', $lesson->id) }}" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-eye-open"></i> {{ trans('layout.actions.view') }}</a>
                                        <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
                                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $lesson->id }}"><i class="fa fa-trash-o"></i> {{ trans('layout.actions.delete') }}</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{ $lessons->render() }}
                        </div>
                    @else
                        <div class="alert">{{ trans('lesson.no_results') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

