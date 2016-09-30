@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><i class="fa fa-users"></i> {{ trans('admin.user_panel.title') }}</strong> -
                        <span class="text-muted text-small">{{ trans('admin.user_panel.top_users_newest', ['number' => config('admin.number_user_newest')]) }}</span>
                    </div>
                    <div class="panel-options">
                        <span class="text-muted">{{ trans('admin.user_panel.total_users') }} {{ $totalUsers }}</span>
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="users-list clearfix">
                        @foreach ($users as $user)
                            <li>
                                <img alt="User Image" src="{{ asset($user->avatar) }}">
                                <br>
                                <a href="#" class="users-list-name">{{ $user->name }}</a>
                                <h5 class="users-list-date">{{ $user->register_at }}</h5>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-box-header">
                        <div class="panel-title">
                            <strong><i class="fa fa-list"></i> {{ trans('admin.category_panel.title') }}</strong>
                        </div>
                        <div class="panel-options">
                        </div>
                    </div>
                    <div class="content-box-large box-with-header">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('category.name') }}</th>
                                    <th>{{ trans('category.parent_category') }}</th>
                                    <th>{{ trans('category.total_lessons') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->parentCategory->name or '' }}</td>
                                        <td>{{ $category->lessons->count() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="content-box-header">
                        <div class="panel-title">
                            <strong><i class="fa fa-book"></i> {{ trans('admin.lesson_panel.title') }}</strong> -
                            <span class="text-small text-muted">{{ trans('admin.lesson_panel.top_lessons_newest', ['number' => config('admin.number_lesson_newest')]) }}</span>
                        </div>

                        <div class="panel-options">
                            <span class="text-muted text-small">{{ trans('admin.lesson_panel.total_lessons') }} {{ $totalLessons }}</span>
                        </div>
                    </div>
                    <div class="content-box-large box-with-header">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('lesson.name') }}</th>
                                    <th>{{ trans('lesson.category') }}</th>
                                    <th>{{ trans('lesson.total_words') }}</th>
                                    <th>{{ trans('lesson.lesson_description') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lessons as $key => $lesson)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $lesson->name }}</td>
                                        <td>{{ $lesson->category->name or '' }}</td>
                                        <td>{{ $lesson->words->count() }}</td>
                                        <td>{{ $lesson->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
                <div class="panel-title ">
                    <strong><i class="fa fa-file-text"></i> {{ trans('admin.word_panel.title') }}</strong>
                    <span class="text-muted text-small">{{ trans('admin.word_panel.top_words_newest', ['number' => config('admin.number_word_newest')]) }}</span>
                </div>
                <div class="panel-options">
                    <span class="text-muted text-small">{{ trans('admin.word_panel.total_words') }} {{ $totalWords }}</span>
                </div>
            </div>
            <div class="content-box-large box-with-header">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('word.content') }}</th>
                            <th>{{ trans('word.lesson') }}</th>
                            <th>{{ trans('word.answers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($words as $key => $word)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $word->content }}</td>
                                <td>{{ $word->lesson->name or '' }}</td>
                                <td>
                                    <ol type="A">
                                        @foreach ($word->answers as $answer)
                                            <li class="{{ $answer->is_correct == config('answer.correct') ? 'text-success' : '' }}">{{ $answer->content }} <i class="fa{{ $answer->is_correct == config('answer.correct') ? ' fa-check' : '' }}"></i></li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection