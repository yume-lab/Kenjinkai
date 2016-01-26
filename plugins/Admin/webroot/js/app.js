/**
 * 管理画面共通スクリプト.
 */
$(function () {

    /**
     * ajaxローディング
     */
    $(document).ajaxStart(function() {
        $('body').prepend('<div id="loading"></div>').show();
    }).ajaxStop(function() {
        $('#loading').remove();
    });

    /**
     * メニューの活性化
     */
    $('ul.main-menu li a').each(function () {
        if (String(window.location).indexOf($($(this))[0].href) >= 0) {
            $(this).parent().addClass('active');
        }
    });
}());
