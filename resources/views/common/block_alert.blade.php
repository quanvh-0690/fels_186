@if (session()->has('status'))
    <div class="alert alert-{{ session()->get('status') }}">
        <button class="close" type="button" data-dismiss="alert">&times;</button>
        <div>{{ session()->get('message') }}</div>
    </div>
@endif