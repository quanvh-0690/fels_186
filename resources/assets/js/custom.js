/**
 * Created by FRAMGIA\vo.hong.quan on 21/09/2016.
 */
$(document).ready(function(){
    $('.submenu > a').click(function(e) {
        e.preventDefault();
        var $li = $(this).parent('li');
        var $ul = $(this).next('ul');

        if($li.hasClass('open')) {
            $ul.slideUp(350);
            $li.removeClass('open');
        } else {
            $('.nav > li > ul').slideUp(350);
            $('.nav > li').removeClass('open');
            $ul.slideDown(350);
            $li.addClass('open');
        }
    });
});

$('.btn-delete').click(function () {
    $('#form-delete').attr('action', $('input[name=base_action]').val() + '/' + $(this).data('id'));
    $('#modal-delete').modal();
});

$('#btn-delete-yes').click(function () {
    $('#form-delete').submit();
});

$(function() {
    var url = window.location.href;
    $('.sidebar').find('a[href="' + url + '"]').parent('li').addClass('current').parents('li').addClass('open');
});