$('.btn-delete').click(function () {
    $('#form-delete').attr('action', $('input[name=base_action]').val() + '/' + $(this).data('id'));
    $('#modal-delete').modal();
});

$('#btn-delete-yes').click(function () {
    $('#form-delete').submit();
});