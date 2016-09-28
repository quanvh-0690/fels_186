$('#form-create-lesson').submit(function () {
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
            if (data.status === 'success') {
                window.location.href = data.url;
            } else {
                $('.alert').show();
                $('.alert').addClass('alert-' + data.status);
                $('.alert').children('.content').html(data.message);
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