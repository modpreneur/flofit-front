/**
 * Created by Hermi on 28.09.15.
 */

$(window).resize(function () {
        var screenRatio = $(window).width() / $(window).height();
        var computedHeight, computedWidth;
        if (screenRatio > (16 / 9)) { // screen is more wide than 16:9 - lock 90% height
            computedHeight = $(window).height() * (90 / 100); // 90% of window height
            computedWidth = computedHeight * (16 / 9); // aspect ratio 16:9
        } else { // screen is less wide than 16:9 - lock 90% width
            computedWidth = $(window).width() * (90 / 100); // 90% of window width
            computedHeight = computedWidth * (9 / 16); // aspect ratio 16:9
        }
        $("#video").width(computedWidth);
        $("#video").height(computedHeight);
    }
);