// globals
var fullHeight = 2240;
var duration = 500;
// first slide then remove self element 
function slideHide() {
    $(this).slideUp(duration, function () {
        $(this).remove()
    }); 
}
// show error in self form element
function showError(text) {
    slideHide.call($(this).find('.affiliatemail-error'));
    $(this).prepend("<p class='affiliatemail-error' style='display: none'>" + text + "</p>");
    $(this).find('.affiliatemail-error').slideDown(duration)
}


function checkEmail() {
    $("#spinner").css("display", "block");

    $.ajax({
        url: "check-email/?emailAddress=" + $("input[name='email']").val() + "&list=49478"
    }).done(function (msg) {
        if (msg["id"] != null) {
            slideHide.call($(".wf-email"));
            slideHide.call($(".wf-submit"));

            slideHide.call($('#affiliates-form .affiliatemail-error'));

            $("#done").show();
            $("#spinner").hide();
        } else {
            $("#spinner").css("display", "none");
            showError.call($('#affiliates-form'), "Sorry, your email is invalid or service is not available.");
        }
    });

}

function generate() {
    var error = [];
    
    // empty ID		
    if ($('#myid').val() == '') {
        error.push("Please enter your Clickbank ID.");
    }
    // didnt checked the box
    if (!$("#aff-verify").prop('checked')) {
        error.push("Please check the box to verify you have read and agree to our terms of service for affiliates.");
    }
    
    // error validation
    if (error.length > 0) {
        showError.call($('.hoplink-form'), error.join('<br />'));
        $(".wf-generatorlink").slideUp(duration);
        return;
    } else {
        slideHide.call($('.hoplink-form .affiliatemail-error'))
    }
    
    generate_link();

    $(".affiliates").animate({height: fullHeight}, duration);
    $(".wf-generatorlink").slideDown(duration);
}

function generate_link() {

    var url_params = {};

    var my_id = $('#myid').val();
    var track_id = $('#trackid').val();
    my_id == '' ? my_id = 'yourid' : my_id = my_id;
    track_id == '' ? track_url = '' : url_params['tid'] = escape(track_id);
    if(track_id =="") {
        var link = 'http://' + escape(my_id) + '.flofit.hop.clickbank.net/';
    }else {
        var link = 'http://' + escape(my_id) + '.flofit.hop.clickbank.net/?';
    }

    la = [];
    $.each(url_params, function (key, val) {
        if (val !== undefined && val !== '') {
            la.push(key + '=' + val);
        }
    })

    link += la.join('&')
    $('#generator_link').text(link);
    
}

function get_copied_text() {
    return $('#generator_link').text();
}

$(document).ready(function () {

    $('#trackid, #myid').change(function () {
        generate_link();
    });

    generate_link();
    new Clipboard('.generator_copy');

})