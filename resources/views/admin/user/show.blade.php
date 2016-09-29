@extends('layout.master')
@section('content')
    <div class="col-md-offset-1 col-md-10">
        <div class="content-box-header">
            <div class="panel-title">{{ trans('user.details') }}</div>
        </div>
        <div class="content-box-large box-with-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle user-detail-avatar" src="{{ $user->avatar }}" alt="User profile picture">

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <p class="text-muted text-center">{{ $user->email }}</p>
                            <p class="text-muted text-center">{{ $user->created_at }}</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>{{ trans('user.followers') }}</b> <a class="pull-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ trans('user.following') }}</b> <a class="pull-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ trans('user.total_lessons_learned') }}</b> <a class="pull-right">13,287</a>
                                </li>
                            </ul>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">{{ trans('user.activity') }}</div>
                        </div>
                        <div class="panel-body">
                            Ut tristique adipiscing mauris, sit amet suscipit metus porta quis. Donec dictum tincidunt erat, eu blandit ligula. Nam sit amet dolor sapien. Quisque velit erat, congue sed suscipit vel, feugiat sit amet enim. Suspendisse interdum enim at mi tempor commodo. Sed tincidunt sed tortor eu scelerisque. Donec luctus malesuada vulputate. Nunc vel auctor metus, vel adipiscing odio. Aliquam aliquet rhoncus libero, at varius nisi pulvinar nec. Aliquam erat volutpat. Donec ut neque mi. Praesent enim nisl, bibendum vitae ante et, placerat pharetra magna. Donec facilisis nisl turpis, eget facilisis turpis semper non. Maecenas luctus ligula tincidunt iasdsd vitae ante et,
                            <br><br>
                            Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque sed consectetur erat. Maecenas in elementum libero. Sed consequat pellentesque ultricies. Ut laoreet vehicula nisl sed placerat. Duis posuere lectus n, eros et hendrerit pellentesque, ante magna condimentum sapien, eget ultrices eros libero non orci. Etiam varius diam lectus.
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection