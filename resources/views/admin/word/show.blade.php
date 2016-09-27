@extends('layout.master')
@section('content')
    <div class="col-md-offset-1 col-md-10">
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
                </div>
                <div class="col-md-7">
                    <h4>{{ trans('word.answers_of_word') }}</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ trans('word.answer.id') }}</th>
                            <th>{{ trans('word.answer.content') }}</th>
                            <th>{{ trans('word.answer.is_correct') }}</th>
                        </tr>
                        @foreach ($word->answers as $answer)
                            <tr>
                                <td>{{ $answer->id }}</td>
                                <td>{{ $answer->content }}</td>
                                <td><i class="fa fa-{{ $answer->is_correct ? 'check text-success' : 'times text-danger' }}"></i></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection