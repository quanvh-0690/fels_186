$('#form-add-answer').submit(function () {
    $.ajax({
        url : $(this).attr('action'),
        type : $(this).attr('method'),
        data: $(this).serialize(),
        beforeSend: function () {
            $('.alert').hide();
            $('.help-block').each(function () {
                $(this).parents('.form-group').removeClass('has-error');
                $(this).children('strong').html('');
            });
        },
        success: function (data) {
            $('.alert').children('.content').html(data.message);
            $('.alert').addClass('alert-' + data.status);
            $('.alert').show();
            if (data.status === 'success') {
                var newRow = $('.list-answers').last().clone();
                $(newRow.children('td')[0]).html(data.answer.id);
                $(newRow.children('td')[1]).html(data.answer.content);
                $(newRow.children('td')[2]).children('i')
                        .addClass(data.answer.is_correct ? 'fa fa-check text-success' : 'fa fa-times text-danger');
                $(newRow.children('td')[3]).find('.btn-edit-answer').attr('href', data.editUrl);
                newRow.removeClass('hidden');
                newRow.appendTo($('table'));
            }
        },
        error: function (err) {
            var errorData = err.responseJSON;
            for (var key in errorData) {
                if (errorData.hasOwnProperty(key)) {
                    $('[name=' + key + ']').parents('.form-group').addClass('has-error');
                    $('[name=' + key + ']').next().children('strong').html(errorData[key]);
                }
            }
        }
    });
});