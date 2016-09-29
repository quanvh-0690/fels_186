@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">{{ trans('user.list') }}</div>
                </div>
                <div class="panel-body">
                    @include('common.block_alert')
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::open(['url' => route('admin.users.search'), 'class' => 'form-inline', 'method' => 'GET']) }}
                                <div class="input-group">
                                    {{ Form::text('keyword', request('keyword'), ['class' => 'form-control', 'placeholder' => trans('user.placeholder_search')]) }}
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                   </span>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <hr>
                    @if ($users->count())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('user.id') }}</th>
                                    <th>{{ trans('user.name') }}</th>
                                    <th>{{ trans('user.email') }}</th>
                                    <th>{{ trans('user.avatar') }}</th>
                                    <th>{{ trans('user.register_at') }}</th>
                                    <th width="25%">{{ trans('layout.actions.title') }}</th>
                                </tr>
                            </thead>
                            <tbody style="vertical-align: middle;!important;">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <img class="img-circle avatar-list-thumb" src="{{ asset($user->avatar) }}" alt="">
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-eye-open"></i> {{ trans('layout.actions.view') }}</a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
                                            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}"><i class="fa fa-trash-o"></i> {{ trans('layout.actions.delete') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{ $users->render() }}
                        </div>
                        @include('common.modal_delete')
                    @else
                        <div class="alert alert-warning">{{ trans('user.no_results') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

