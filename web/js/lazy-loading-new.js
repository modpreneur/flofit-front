/**
 * Created by Hermi on 11.02.16.
 */

function getScrollBarWidth() {
    if ($(document).height() > $(window).height()) {
        $('body').append('<div id="fakescrollbar" style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"></div>');
        fakeScrollBar = $('#fakescrollbar');
        fakeScrollBar.append('<div style="height:100px;">&nbsp;</div>');
        var w1 = fakeScrollBar.find('div').innerWidth();
        fakeScrollBar.css('overflow-y', 'scroll');
        var w2 = $('#fakescrollbar').find('div').html('html is required to init new width.').innerWidth();
        fakeScrollBar.remove();
        return (w1 - w2);
    }
    return 0;
}

var w = 0;
var s = 0;
var c = 1200;

$(function () {
    s = getScrollBarWidth();

    $('.link a').click(function () {
        var id = $(this).data('id');
        $('.toggle').each(function () {
            if ($(this).attr('id') == id) {
                var span = $(this).siblings().find('span:last-child');
                if (span.html() == '+') {
                    span.html('-');
                    $(this).slideDown();
                }
                else {
                    span.html('+');
                    $(this).slideUp();
                }
            }
        });
        return false;
    });

    w = $(window).width() + s;
    imgLoading(w);

    function imgLoading(w) {
        var dom = "";
        var threshold = 1200;

        if (w >= 1200) {
            dom = "img.lazy-big";
        } else if (w < 1220 && w >= 1024) {
            dom = "img.lazy-1220";
        } else if (w < 1024 && w >= 768) {
            dom = "img.lazy-1024";
        } else if (w < 768 && w >= 480) {
            dom = "img.lazy-768";
        } else if (w < 480) {
            dom = "img.lazy-480";
        }
        $(dom).removeClass("display-none");

        $(dom).lazyload({
            effect: "fadeIn",
            threshold : threshold,
            placeholder : "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        });
    }

    imgLoadingOnly(w);
    function imgLoadingOnly(w) {
        var dom = "";
        var threshold = 1200;
        var imgOnly = $("img").hasClass("lazy-only");

        if (imgOnly) {
            dom = "img.lazy-only";
        }
        $(dom).removeClass("display-none");

        $(dom).lazyload({
            effect: "fadeIn",
            threshold : threshold,
            placeholder : "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        });
    }
});
