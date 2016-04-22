$(function () {
	'use strict';

    $(document).ajaxStart(function() {
        $('body').prepend('<div id="loading"></div>').show();
    }).ajaxStop(function() {
        $('#loading').remove();
    });

    $('.info-detail').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        $.post('/api/user-informations/read', {'id': id}, function(success) {
            $this.closest('li').removeClass('unread');
        });
        $this.siblings('.info-content').slideToggle('slow');
    });

}());
