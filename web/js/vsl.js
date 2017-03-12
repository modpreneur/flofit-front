/**
 * Created by Hermi on 05.01.16.
 */

$(document).ready(function(){
    $('.section-160 p').each(function(index) {
        var pHeight = $(this).height();
        if (pHeight < 50) {
            //$(this).css("padding-top", "14px");
            $(this).addClass("fix-padding");
        }
    });
});

function getScrollBarWidth() {
    if($(document).height() > $(window).height()){
        $('body').append('<div id="fakescrollbar" style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"></div>');
        fakeScrollBar = $('#fakescrollbar');
        fakeScrollBar.append('<div style="height:100px;">&nbsp;</div>');
        var w1 = fakeScrollBar.find('div').innerWidth();
        fakeScrollBar.css('overflow-y', 'scroll');
        var w2 = $('#fakescrollbar').find('div').html('html is required to init new width.').innerWidth();
        fakeScrollBar.remove();
        return (w1-w2);
    }
    return 0;
}

var w = 0;
var s = 0;
var c = 1220;

$(function() {
	s = getScrollBarWidth();

	$("img.lazy-notrigger").lazyload({
		effect : "fadeIn"
	});

	$("img.lazy").lazyload({
		effect : "fadeIn"
	});

	w = $(window).width() + s;

	if (w >= 1220) {
		$('img').each(function() {
			$(this).attr('src',$(this).data('1200'));
		});
	}
	else if (w < 1220 && w >= 1024) {
		$('img').each(function() {
			$(this).attr('src',$(this).data('1024'));
		});
	}
	else if (w < 1024 && w >= 768) {
		$('img').each(function() {
			$(this).attr('src',$(this).data('768'));
		});
	}
	else if (w < 768) {
		$('img').each(function() {
			$(this).attr('src',$(this).data('320'));
		});
	}

	$("img.lazy").trigger("appear");

});

$(window).resize(function() {
	w = $(window).width() + s;

	if (w >= 1220 && c != 1220) {
		$('img').each(function() {
			$(this).attr('src',$(this).data('1200'));
		});
		$("img.lazy").trigger("appear");
		c = 1220;
	}
	else if (w < 1220 && w >= 1024 && c != 1024) {
		$('img').each(function() {
			$(this).attr('src',$(this).data('1024'));
		});
		$("img.lazy").trigger("appear");
		c = 1024;
	}
	else if (w < 1024 && w >= 768 && c != 768) {
		$('img').each(function() {
			$(this).attr('src',$(this).data('768'));
		});
		$("img.lazy").trigger("appear");
		c = 768;
	}
	else if (w < 768 && c != 320) {
		$('img').each(function() {
			$(this).attr('src',$(this).data('320'));
		});
		$("img.lazy").trigger("appear");
		c = 320;
	}
});



