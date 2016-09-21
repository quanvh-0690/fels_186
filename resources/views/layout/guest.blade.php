<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('layout.header_title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ Html::style('css/app.css') }}
    {{ Html::style('css/styles.css') }}
    {{ Html::style('css/font-awesome.css') }}
</head>
<body>
<div class="header">
    @include('layout.header')
</div>

<div class="page-content container">
    <div class="row">
        @yield('content')
    </div>
</div>

{{ Html::script('js/app.js') }}
{{ Html::script('js/custom.js') }}
</body>
</html>
