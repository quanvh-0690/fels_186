<div class="modal fade" id="modal-delete" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{ trans('layout.actions.delete_modal.title') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ trans('layout.actions.delete_modal.content') }}</p>
                {{ Form::open(['method' => 'DELETE', 'id' => 'form-delete']) }}
                    {{ Form::hidden('base_action', url()->current()) }}
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btn-delete-yes">{{ trans('layout.actions.delete_modal.btn_yes') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('layout.actions.delete_modal.btn_cancel') }}</button>
            </div>
        </div>
    </div>
</div>