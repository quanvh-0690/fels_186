@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">{{ trans('word.list') }}</div>
                </div>
                <div class="panel-body">
                    @include('common.block_alert')
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::open(['url' => route('admin.words.search'), 'class' => 'form-inline', 'method' => 'GET']) }}
                                <div class="form-group">
                                    {{ Form::label('type', trans('word.search_type'), ['class' => 'control-label']) }}
                                    {{ Form::select('type', config('word.search_type'), request('type'), ['class' => 'form-control']) }}
                                </div>
                                <div class="input-group">
                                    {{ Form::text('keyword', request('keyword'), ['class' => 'form-control', 'placeholder' => trans('layout.search')]) }}
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                   </span>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <hr>
                    @if ($words->count())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('word.id') }}</th>
                                    <th>{{ trans('word.content') }}</th>
                                    <th>{{ trans('word.lesson') }}</th>
                                    <th>{{ trans('word.correct_answer') }}</th>
                                    <th width="25%">{{ trans('layout.actions.title') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($words as $word)
                                    <tr>
                                        <td>{{ $word->id }}</td>
                                        <td>{{ $word->content }}</td>
                                        <td>{{ $word->lesson->name or '' }}</td>
                                        <td><p>{{ implode(' | ', $word->correct_answers->lists('content')->toArray()) }}</p></td>
                                        <td>
                                            <a href="{{ route('admin.words.answers.create', $word->id) }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> {{ trans('layout.actions.add', ['name' => 'Answer']) }}</a>
                                            <a href="{{ route('admin.words.show', $word->id) }}" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-eye-open"></i> {{ trans('layout.actions.view') }}</a>
                                            <a href="{{ route('admin.words.edit', $word->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
                                            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $word->id }}"><i class="fa fa-trash-o"></i> {{ trans('layout.actions.delete') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{ $words->render() }}
                        </div>
                        @include('common.modal_delete')
                    @else
                        <div class="alert alert-warning">{{ trans('word.no_results') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
