var adminAnswer = new function () {
    var self = this;
    this.add_new_answer = function () {
        $('#form-add-answer').submit(function () {
            $.ajax({
                url : $(this).attr('action'),
                type : $(this).attr('method'),
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#btn-submit-add-answer').attr('disabled', 'disabled');
                    $('.alert').hide();
                    $('.help-block').each(function () {
                        $(this).parents('.form-group').removeClass('has-error');
                        $(this).children('strong').html('');
                    });
                },
                success: function (data) {
                    $('.alert').children('.content').html(data.message);
                    $('.alert').removeClass('alert-success alert-danger');
                    $('.alert').addClass('alert-' + data.status);
                    $('.alert').show();
                    $('#btn-submit-add-answer').removeAttr('disabled');
                    if (data.status === 'success') {
                        $(data.html).appendTo('table');
                        $('input[name=content]').val('');
                        self.open_delete_modal();
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
    };
    this.open_delete_modal = function () {
        $('.btn-delete-answer').click(function () {
            $('#form-delete').attr('action', $('input[name=base_action]').val() + '/answers/' + $(this).data('id'));
            $('#form-delete').attr('onsubmit', 'return false;');
            $('#modal-delete').modal();
        });
    };
    this.delete_answer = function () {
        $('#btn-delete-answer-yes').click(function () {
            var self = $(this);
            var $form = $('#form-delete');
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: $form.serialize(),
                beforeSend: function () {
                    self.attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status === 'success') {
                        $('#modal-delete').modal('hide');
                        $('tr#' + data.id).remove();
                        self.removeAttr('disabled');
                    }
                }
            })
        });
    };
    this.request_create_answer = function (action) {
        $.ajax({
            url : $('#form-create-answer').attr('action'),
            type : $('#form-create-answer').attr('method'),
            data: $('#form-create-answer').serialize() + '&action=' + action,
            beforeSend: function () {
                $('.alert').hide();
                $('.help-block').each(function () {
                    $(this).parents('.form-group').removeClass('has-error');
                    $(this).children('strong').html('');
                });
            },
            success: function (data) {
                $('.alert').children('.content').html(data.message);
                $('.alert').removeClass('alert-success alert-danger');
                $('.alert').addClass('alert-' + data.status);
                $('.alert').show();
                if (data.status === 'success') {
                    $('input[name=content]').val('');
                    if (data.action === 'add_one') {
                        window.location.href = data.redirectUrl;
                    }
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
    };
    this.create_answer = function () {
        $('#add-one-answer').click(function () {
            self.request_create_answer('add_one');
        });
        $('#add-more-answer').click(function () {
            self.request_create_answer('add_more');
        });
    };
    this.init = function () {
        $('#btn-delete-yes').attr('id', 'btn-delete-answer-yes');
        self.add_new_answer();
        self.open_delete_modal();
        self.delete_answer();
        self.create_answer();
    }
};

adminAnswer.init();