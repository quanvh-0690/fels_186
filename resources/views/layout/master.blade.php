<!DOCTYPE html>
<html>
    <head>
        <title>{{ trans('layout.header_title') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{ Html::style('css/app.css') }}
        {{ Html::style('css/styles.css') }}
    </head>
    <body>
        <div class="header">
            @include('layout.header')
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-2">
                    @include('layout.sidebar')
                </div>
                <div class="col-md-10">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer>
            @include('layout.footer')
        </footer>
        {{ Html::script('js/app.js') }}
        {{ Html::script('js/custom.js') }}
    </body>
</html>
