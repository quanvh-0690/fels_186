@extends('layout.master')
@section('content')
    <div class="col-md-offset-1 col-md-10">
        <div class="content-box-header">
            <div class="panel-title">{{ trans('lesson.details') }}</div>
        </div>
        <div class="content-box-large box-with-header">
            <div class="row">
                <div class="col-md-5">
                    <h3>{{ $lesson->name }}</h3>
                    <p><strong>{{ trans('lesson.category') }}</strong> {{ $lesson->category->name or '' }}</p>
                    <p><strong>{{ trans('lesson.lesson_description') }}</strong> {{ $lesson->description }}</p>
                    <p><strong>{{ trans('layout.created_at') }}</strong> {{ $lesson->created_at }}</p>
                    <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
                </div>
                <div class="col-md-7">
                    <h4>{{ trans('lesson.words_of_lesson') }}</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ trans('lesson.word.id') }}</th>
                            <th>{{ trans('lesson.word.content') }}</th>
                            <th>{{ trans('lesson.word.correct_answer') }}</th>
                        </tr>
                        @foreach ($lesson->words as $word)
                            <tr>
                                <td>{{ $word->id }}</td>
                                <td>{{ $word->content }}</td>
                                <td>{{ $word->correct_answer }}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection