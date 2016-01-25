$(function () {
	'use strict';

    $(document).ajaxStart(function() {
        $('body').prepend('<div id="loading"></div>').show();
    }).ajaxStop(function() {
        $('#loading').remove();
    });

}());
