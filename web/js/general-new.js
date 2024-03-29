function updateBillingInfo() {
    $("input[placeholder]").each(function () {
        if ($(this).val() == "") {
            // $(this).addClass('hasplaceholder');
            $(this).val($(this).attr("placeholder"));
            $(this).focus(function () {
                if ($(this).val() == $(this).attr("placeholder")) $(this).val("");
                // $(this).removeClass('hasplaceholder');
            });
            $(this).blur(function () {
                if ($(this).val() == "") {
                    // $(this).addClass('hasplaceholder');
                    $(this).val($(this).attr("placeholder"));
                }
            });
        }
    });

    $('form').submit(function (evt) {
        $('input[placeholder]').each(function () {
            if ($(this).attr("placeholder") == $(this).val()) {
                $(this).val('');
            }
        });
    });
    $('.billing-cell2 input').bind('keydown keyup change', function (e) {
        if ($('#match_shipping').is(':checked')) {
            myID = $(this).attr('id');
            $('#billing_' + myID).val($(this).val());
        }
    });
    $('.billing-cell2 select').bind('change click blur', function (e) {
        if ($('#match_shipping').is(':checked')) {
            myID = $(this).attr('id');
            $('#billing_' + myID).val($(this).val());
        }
    });
    $('#cc_number').bind('keyup', function (e) {
        firstNum = $(this).val().substr(0, 1);
        if (firstNum == '4')
            checkCC('VISA');
        else if (firstNum == '5')
            checkCC('MC');
        else if (firstNum == '3')
            checkCC('AMEX');
        else if (firstNum == '6')
            checkCC('DISC');
        else {
            $('.cc-image').removeClass('active-cc-type');
            $('#cc_type').val('');
        }

    });
}

function checkCC(type) {
    $('#cc_type').val(type);
    $('.cc-image').removeClass('active-cc-type');
    $('#cc-' + type).addClass('active-cc-type');
}


function removeItem(price, id, su, remainder) {
    $('#quantity_' + id).val(0);
    updateQuantity(price, id, su);
}

function toggleConfirm(how) {
    if (how == 'on' && $('#country_ID').val() > 0) {
        $('input#order-button').removeAttr('disabled');
    } else {
        $('input#order-button').attr('disabled', 'disabled');
    }
}

function addToCart(id, price, su) {

    var ids = $('#IDs').val();
    ids += ',' + id;
    $('td.cross-sell-' + id).hide();
    $('#IDs').val(ids);
    // let's update the cart subtotal here.
    subT = parseFloat($('#cart_subtotal').val());
    taxT = parseFloat($('#tax_subtotal').val());
    subT = subT + price;
    taxT = taxT + price;
    $('#cart_subtotal').val(subT);
    $('#tax_subtotal').val(taxT);
    $('.order-cart_subtotal').html('$' + subT.toFixed(2));
    updateQuantity(price, id, su, 0, true);
    return false;
}

function updateQuantity(price, id, su, remainder, isNew) {
    toggleConfirm('off');
    var newQ = parseInt($('#quantity_' + id).val());
    var tax_price = parseFloat($('#price_' + id).val());
    var ids = $('#IDs').val().split(',');
    var new_ID_list = new Array();
    var my_su = '';
    var isSplit = 0;
    var isRecurring = 0;
    var remains = 0;
    var oldSub = parseFloat($('#cart_subtotal_' + id).val());
    var ordercart_subtotal = parseFloat($('#cart_subtotal').val());
    var oldTax = parseFloat($('#tax_subtotal_' + id).val());
    var ordertax_subtotal = parseFloat($('#tax_subtotal').val());
    var recurring_subtotal = parseFloat($('#recurring_subtotal').val());
    var cart_subtotal = 0;
    var tax_subtotal = 0;
    var totalQ = 0;
    if (!isNew) {
        var isNew = false;

    } else {
        newQ = 1;
        tax_price = price;
        oldSub = price;
        oldTax = price;
    }


    if (isNaN(newQ)) {
        alert('Numeric quantities only, please');
        return false;
    }

    _gaq.push(['_trackEvent', 'Cart', 'Update Quantity', id, newQ]);
    if (newQ <= 0) {
        $('.row_' + id).remove();
        for (var i = 0; i < ids.length; i++) {
            if (ids[i] != id)
                new_ID_list.push(ids[i]);
        }
        $('#IDs').val(new_ID_list.join(','));
    }
    /*if($('#IDs').val() == '6') {
     $('#fs_eligible').val(1);
     } else {
     $('#fs_eligible').val(0);
     $('#is_free_shipping').val(0);
     }*/
    $('#fs_eligible').val(0);
    $('#is_free_shipping').val(0);

    cart_subtotal = newQ * parseFloat(price);
    cart_subtotal = Math.round(cart_subtotal * 100) / 100;
    $('.item-cart_subtotal-' + id).html('$' + cart_subtotal.toFixed(2));
    $('#cart_subtotal_' + id).val(cart_subtotal);
    // update the order cart_subtotal
    ordercart_subtotal = (ordercart_subtotal - oldSub) + cart_subtotal;
    $('.order-cart_subtotal').html('$' + ordercart_subtotal.toFixed(2));
    $('#cart_subtotal').val(ordercart_subtotal);

    tax_subtotal = newQ * tax_price;
    tax_subtotal = Math.round(tax_subtotal * 100) / 100;
    $('#tax_subtotal_' + id).val(tax_subtotal);
    ordertax_subtotal = (ordertax_subtotal - oldTax) + tax_subtotal;
    $('#tax_subtotal').val(ordertax_subtotal);
    if ($('#is_recurring_' + id).val() == '1') {
        recurring_subtotal = (recurring_subtotal - oldSub) + cart_subtotal;
        $('#recurring_subtotal').val(recurring_subtotal);
        $('.recurring-order-subtotal').html('$' + recurring_subtotal.toFixed(2));
        isRecurring = 1;
    }
    if ($('#is_split_' + id).val() == '1') {
        isSplit = 1;
    }
    myQ = 0;
    $('.field-quantity').each(function () {
        my_su = $(this).attr('id').replace('quantity_', 'shipping_unit_');
        my_su = parseFloat($('#' + my_su).val());
        totalQ = totalQ + (parseInt($(this).val()) * my_su);
    });
    // update the remainder total
    $('.remainder_price').each(function () {
        remains += parseFloat($(this).val());
        zQ = $(this).attr('id').replace('remainder_price_', 'quantity_');
        myQ += parseInt($('#' + zQ).val());
    });
    remains = remains * myQ;
    $('#remainder_total').val(remains.toFixed(2));
    $('#shipping_quantity').val(totalQ);
    updateShippingTotal();
    //remove the cart if its empty

    if (totalQ <= 0) {
        $('table.shopping-cart').remove();
        $('.empty-cart').show();
        _gaq.push(['_setCustomVar', 1, 'Visitor Type', 'Emptied Cart', 1]);
    }

    // update the cart db
    $.ajax({
        type: "POST",
        url: '/~TOOL_ECOMM/act_update-cart.cfm',
        data: 'prod_ID=' + id + '&pID=' + id + '&quantity=' + newQ + '&price=' + price + '&is_split=' + isSplit + '&is_recurring=' + isRecurring + '&isNew=' + isNew + '&isJS=true',
        dataType: 'json',
        success: function (msg) {
            updateCartText(id, isNew, msg);
            updateOrderTotal();
        }
    });
}

function updateCartText(id, isNew, msg) {
    if (isNew) {
        txt = '<tr class="row_' + id + '"><td width="107" rowspan="2"><img align="left" alt="' + msg.PRODNAME + '" src="' + msg.PRODIMG + '" /></td>';
        txt += '<td class="cell-title"><strong>' + msg.PRODNAME + '</strong></td>';
        txt += '<td class="cell-price"><input id="price_' + id + '" type="hidden" name="price_' + id + '" value="' + msg.PRICE + '" />$' + msg.PRICE.toFixed(2) + '</td>';
        txt += '<td class="cell-quantity"><input type="tel" maxLength="6" size="3" value="1" class="field-quantity" id="quantity_' + id + '" name="quantity_' + id + '" onchange="updateQuantity(' + msg.PRICE + ',' + id + ',' + msg.SHIPPINGUNIT + ',0)" /><input type="hidden" id="shipping_unit_' + id + '" name="shipping_unit_' + id + '" value="' + msg.SHIPPINGUNIT + '" /></td>';
        txt += '<td class="cell-cart_subtotal cell-cart_subtotal-' + id + '"><span class="item-cart_subtotal-' + id + '">$' + msg.PRICE.toFixed(2) + '</span><input type="hidden" name="cart_subtotal_' + id + '" id="cart_subtotal_' + id + '" value="' + msg.PRICE + '" />';
        txt += '<input type="hidden" name="tax_subtotal_' + id + '" id="tax_subtotal_' + id + '" value="' + msg.PRICE + '" /><input type="hidden" name="split_price_' + id + '" value="' + msg.PRICE + '" /><input type="hidden" name="is_recurring_' + id + '" id="is_recurring_' + id + '" value="' + msg.IS_RECURRING + '" /><input type="hidden" name="is_split_' + id + '" id="is_split_' + id + '" value="' + msg.IS_SPLIT + '" />';
        txt += '</td>';
        txt += '</tr><tr class="row_' + id + '"><td class="cart-print">' + msg.SMALLPRINT + '</td>';
        txt += '<td class="cell-links" colspan="3"><a onclick="removeItem(' + msg.PRICE + ',' + id + ',' + msg.SHIPPINGUNIT + ',0); return false;" href="cart/?pID=' + id + '&q=0">Remove</a> | <input class="plain-button-link" type="submit" value="Update" name="update_cart" /></td>';
        txt += '</tr>';
        $('table#products-list').append(txt);
    }
}

function doStateSelect(obj) {
    toggleConfirm('off');
    var myZone = $(obj).val();
    /*var can_fs = $('#fs_eligible').val();
     var is_fs = $('#is_free_shipping').val();*/
    var can_fs = 0;
    var is_fs = 0;
    var myHTML = '';
    if (myZone == 0) {
        $('#state-selector').html('');
        $('.tax-type-1').html('');
        $('.tax-type-2').html('');
        $('.tax-total-1').html('$0.00');
        $('.tax-total-2').html('');
        $('#cart_tax1').val(0);
        $('#cart_tax2').val(0);
        $('#tax_type_1').val('');
        $('#tax_type_2').val('');
        $('#cart_shipping').val(0);
        $('#is_free_shipping').val(0);
        $('.s-h-total').html('$0.00');
        $('.s-h-title').html('Shipping &amp; Handling:')
        $('#shipping_price').val(0);
        $('#shipping_multiplier').val(0);
        updateOrderTotal();
    } else {
        $.ajax({
            type: "POST",
            url: '/~TOOL_ECOMM/ajax/ajax_state-select.cfm',
            data: 'zone_ID=' + myZone + '&isJS=true',
            dataType: 'json',
            beforeSend: function (msg) {
                $('#state-selector').html('Loading...');
            },
            success: function (msg) {
                if (!msg.HASSTATES) {
                    myHTML = myHTML + '<input type="text" name="state" class="state-input grey-text" value="State/Province" placeholder="state" onFocus="clearVal(this);" />';
                } else {
                    myHTML = myHTML + '<select name="state" placeholder="state" id="state" class="cart-select" onchange="updateTaxTotal(this);"><option value="">Please Select</option>';
                    for (var i = 0; i < msg.RSSTATES.DATA.length; i++) {
                        myHTML = myHTML + '<option value="' + msg.RSSTATES.DATA[i][2] + '">' + msg.RSSTATES.DATA[i][3] + '</option>';
                    }
                    myHTML = myHTML + '</select>';
                }
                $('#state-selector').html(myHTML);
                $('.tax-type-1').html('');
                $('.tax-total-1').html('$0.00');
                $('#cart_tax1').val(0);
                $('#tax_type_1').val('');
                $('.tax-total-2').html('');
                $('.tax-type-2').html('');
                $('#cart_tax2').val(0);
                $('#tax_type_2').val('');
                /*if(can_fs == '1' && (myZone == 1 || myZone ==2)) {
                 $('#is_free_shipping').val(1);
                 $('.s-h-title').html('');
                 } else {
                 $('#is_free_shipping').val(0);
                 $('.s-h-title').html('Shipping &amp; Handling:');
                 }*/
                $('#is_free_shipping').val(0);
                $('.s-h-title').html('Shipping &amp; Handling:')

            }
        });
    }
    updateOrderTotal();
    return false;

}

function clearVal(obj) {
    $(obj).removeClass('grey-text');
    if ($(obj).val() == 'State/Province') {
        $(obj).val('');
    }
}

function updateShippingTotal() {
    var shippingCost_ID = $('#shippingCost_ID').val();
    /*var can_fs = $('#fs_eligible').val();
     var is_fs = $('#is_free_shipping').val();*/
    var can_fs = 0;
    var is_fs = 0;
    var myZone = $('#zone_ID').val();
    if (typeof myZone === 'undefined')
        myZone = $('#stored_zone_ID').val();
    var price, multiplier = 0;
    toggleConfirm('off');
    $.ajax({
        type: "POST",
        url: '/~TOOL_ECOMM/ajax/ajax_shipping-cost.cfm',
        data: 'shippingCost_ID=' + shippingCost_ID + '&isJS=true',
        dataType: 'json',
        success: function (msg) {
            /*if (can_fs == '1'  && is_fs == '1' && (myZone == 1 || myZone ==2)) {
             msg.PRICE = 0;
             msg.MULTIPLIER = 0;
             }*/
            $('#shipping_price').val(msg.PRICE);
            $('#shipping_multiplier').val(msg.MULTIPLIER);
            price = parseFloat($('#shipping_price').val());
            multiplier = parseFloat($('#shipping_multiplier').val());
            var quantity = parseFloat($('#shipping_quantity').val());
            var recurring_quantity = parseFloat($('#recurring_shipping_quantity').val());
            var old_total = parseFloat($('#cart_shipping').val());
            var old_recurring = parseFloat($('#recurring_shipping').val());
            var shipping = 0;
            var recurring_shipping = 0;
            if (multiplier > 0) {
                shipping = price + (quantity * multiplier);
                recurring_shipping = price + (recurring_quantity * multiplier);
            } else {
                shipping = price;
                recurring_shipping = price;
            }
            shipping = parseFloat(shipping).toFixed(2);
            recurring_shipping = parseFloat(recurring_shipping).toFixed(2);

            $('.s-h-title').html('Shipping &amp; Handling:');
            if (msg.PRICE == 0 && msg.MULTIPLIER == 0) {
                $('.s-h-total').html('FREE!');
            } else {
                $('.s-h-total').html('$' + shipping.toString());
            }
            $('.s-h-type').html(msg.NAME);
            $('#cart_shipping').val(shipping);
            $('#recurring_shipping').val(recurring_shipping);
            updateTaxTotal();
        }
    });

}

function updatePromo() {
    // check if this promo is valid
    var pCode = $('#promo').val();
    var discount = 0;
    var isPercent = 1;
    var includeShipping = 0;
    var id = 0;
    var promoTotal = 0;
    var subTotal = parseFloat($('#tax_subtotal_no_promo').val());
    $.ajax({
        type: "POST",
        url: '/~TOOL_ECOMM/ajax/ajax_check-promo.cfm',
        data: 'promo=' + pCode + '&isJS=true',
        dataType: 'json',
        success: function (msg) {
            if (msg.RSPROMO.DATA.length == 1) {
                discount = parseInt(msg.RSPROMO.DATA[0][1]);
                isPercent = msg.RSPROMO.DATA[0][0];
                includeShipping = msg.RSPROMO.DATA[0][2];
                id = msg.RSPROMO.DATA[0][4];
                $('#promo_type').val(isPercent);
                $('#promo_ID').val(id);
                if (isPercent) {
                    promoTotal = subTotal * (discount / 100);
                    $('#promo_total').val(promoTotal);
                    $('.promo-type').text(' (' + discount + '%)');
                    $('#promo_text').val(discount + '%');
                    $('.promo-total').text('-$' + (Math.floor(promoTotal * 100) / 100).toFixed(2));
                } else {
                    promoTotal = discount;
                    $('#promo_total').val(promoTotal);
                    $('.promo-type').text(' ($' + (Math.floor(promoTotal * 100) / 100).toFixed(2) + ')');
                    $('#promo_text').val('$' + (Math.floor(promoTotal * 100) / 100).toFixed(2));
                    $('.promo-total').text('-$' + (Math.floor(promoTotal * 100) / 100).toFixed(2));
                }
                $('#tax_subtotal').val(subTotal - promoTotal);
                $('.discount-row').show();
                $('.cart-promo-info').hide();
                updateOrderTotal();
                updateTaxTotal();
            } else {
                $('.promo-message').text('Sorry, that is not a valid Promo Code').show();
                $('#promo').val('');
                $('#tax_subtotal').val(subTotal);
                $('#promo_total').val(0);
                $('#promo_ID').val(0);
                $('#promo_text').val('');
                $('promo_type').val(0);
                $('.discount-row').hide();
                updateOrderTotal();
                updateTaxTotal();
            }
        },
        error: function (e) {
            $('.promo-message').text('Sorry, that is not a valid Promo Code').show();
            $('#promo').val('');
            $('#tax_subtotal').val(subTotal);
            $('#promo_total').val(0);
            $('#promo_ID').val(0);
            $('promo_type').val(0);
            $('.discount-row').hide();
            updateOrderTotal();
            updateTaxTotal();
        }
    });

    return false;
}

function updateTaxTotal(obj) {
    if ($(obj).attr('id') == 'billing_state') {
        updateOrderTotal();
        return false;
    }
    var state = $('#state').val();
    var countryID = $('#country_ID').val();
    var myHTML = '';
    var cart_tax1 = 0;
    var tax_type1 = '';
    var inc_shipping1 = 0;
    var cart_tax2 = 0;
    var tax_type2 = '';
    var inc_shipping2 = 0;
    var stackable = 0;
    var tax_total1, tax_total2 = 0;
    var cart_subtotal = parseFloat($('#tax_subtotal').val());
    var discount_total = parseFloat($('#promo_total').val());
    var shipping = parseFloat($('#cart_shipping').val());
    // we include the subtotal in the value
    var tax_cart_subtotal = cart_subtotal - discount_total;
    toggleConfirm('off');
    $('#stored_state').val(state);
    if (state == '') {
        $('#cart_tax1').val(0);
        $('#cart_tax2').val(0);
        $('#tax_type_1').val('');
        $('#tax_type_2').val('');
        $('.tax-type-1').html('');
        $('.tax-type-2').html('');
        $('.tax-total-1').html('$0.00');
        $('.tax-total-2').html('');
    } else {
        $.ajax({
            type: "POST",
            url: '/~TOOL_ECOMM/ajax/ajax_get-taxes.cfm',
            data: 'countryID=' + countryID + '&state=' + state + '&isJS=true',
            dataType: 'json',
            success: function (msg) {

                if (msg.RSTAX.DATA.length >= 1) {
                    cart_tax1 = msg.RSTAX.DATA[0][2];
                    tax_type1 = msg.RSTAX.DATA[0][1];
                    inc_shipping1 = msg.RSTAX.DATA[0][7];

                }
                if (inc_shipping1 > 0) {
                    // if the tax should include shipping, we add that to our subtotal
                    tax_cart_subtotal = cart_subtotal + shipping;
                    //recurring_tax_subtotal = recurring_subtotal + recurring_shipping;
                }

                // our tax amount
                tax_total1 = tax_cart_subtotal * cart_tax1;
                tax_total1 = Math.round(tax_total1 * 100) / 100;
                $('#cart_tax1').val(tax_total1.toFixed(2));
                $('.tax-total-1').html('$' + tax_total1.toFixed(2).toString());

                //if we have a tax name, write it in.
                if (tax_type1.length) {
                    $('.tax-type-1').html('(' + (cart_tax1 * 100).toFixed(1) + '% ' + tax_type1 + ') ');
                    $('#tax_type_1').val('(' + (cart_tax1 * 100).toFixed(1) + '% ' + tax_type1 + ') ');
                } else {
                    $('.tax-type-1').html('');
                    $('#tax_type_1').val('');
                }
                if (msg.RSTAX.DATA.length >= 2) {
                    cart_tax2 = msg.RSTAX.DATA[1][2];
                    tax_type2 = msg.RSTAX.DATA[1][1];
                    stackable = msg.RSTAX.DATA[1][6];
                    inc_shipping2 = msg.RSTAX.DATA[1][7];
                    if (inc_shipping2 > 0) {
                        // if the tax should include shipping, add that in
                        tax_cart_subtotal = cart_subtotal + shipping;
                    }
                    if (stackable) {
                        // if this tax should include tax1, we add that to our subtotal //
                        tax_total2 = (tax_cart_subtotal + tax_total1) * cart_tax2;
                        text = '<br />(+';
                    } else {
                        tax_total2 = tax_cart_subtotal * cart_tax2;
                        text = '<br />(';
                    }
                    // our tax2 amount
                    tax_total2 = Math.round(tax_total2 * 100) / 100;
                    $('#cart_tax2').val(tax_total2.toFixed(2));
                    $('.tax-total-2').html('$' + tax_total2.toFixed(2).toString());
                    // if we have a tax2 name, write it in.
                    if (tax_type2.length) {
                        $('.tax-type-2').html(text + (cart_tax2 * 100).toFixed(1) + '% ' + tax_type2 + ') ');
                        $('#tax_type_2').val(text + (cart_tax2 * 100).toFixed(1) + '% ' + tax_type2 + ') ');
                    }
                } else {
                    // if there's no tax2, null the values;
                    $('.tax-type-2').html('');
                    $('#cart_tax2').val(0);
                    $('#tax_type_2').val('');
                    $('.tax-total-2').html('');
                }

                updateOrderTotal();
            }
        });
    }

}

function updateOrderTotal() {
    var subtotal = parseFloat($('#cart_subtotal').val());
    var promototal = parseFloat($('#promo_total').val());
    var shipping = parseFloat($('#cart_shipping').val());
    var tax1 = parseFloat($('#cart_tax1').val());
    var tax2 = parseFloat($('#cart_tax2').val());
    var total = 0;
    var recurring_subtotal = parseFloat($('#recurring_subtotal').val());
    var recurring_shipping = parseFloat($('#recurring_shipping').val());
    var recurring_total = 0;
    var remainder = parseFloat($('#remainder_total').val());

    total = Math.round((subtotal - promototal + shipping + tax1 + tax2) * 100) / 100;
    recurring_total = Math.round((recurring_subtotal + recurring_shipping) * 100) / 100;

    $('#order_total').val(total);
    $('#recurring_total').val(recurring_total);
    $('.order-total').html('$' + total.toFixed(2));

    if (remainder == 0) {
        $('.split-payment-box').hide();
    } else {
        $('.split-order-total').html('$' + total.toFixed(2));
        $('.split-order-remainder').html('$' + remainder.toFixed(2));
    }
    toggleConfirm('on');

}

function clearPlaceholder(obj, txt) {
    if ($(obj).val() == txt) {
        $(obj).removeClass('grey-text');
        $(obj).val('');
    }
}

function setPlaceholder(obj, txt) {
    var myName = $(obj).attr('name');
    if ($(obj).val() == '') {
        $(obj).addClass('grey-text');
        $(obj).val(txt);
    } else if ($('#match_shipping').is(':checked') && myName.substring(0, 8) != 'billing_') {
        // match the billing field to this field.

        if (myName == 'state') {
            $('.billing_state-selector').html($('.state-selector').html());
            $('.billing_state-selector').find('input').attr('name', 'billing_state');
            $('.billing_state-selector').find('input').attr('id', 'billing_state');
            $('.billing_state-selector').find('select').attr('name', 'billing_state');
            $('.billing_state-selector').find('select').attr('id', 'billing_state');
            $('#billing_state').val($(obj).val());
        }
        else {
            $('#billing_' + myName).val($(obj).val());
        }
    }
}


function fillBillingInfo() {
    $('.billing-info-fields').show();
    var list = new Array('fname', 'lname', 'address1', 'city', 'state', 'zip', 'country_ID', 'phone', 'email');
    var myVal = ''
    if ($('#match_shipping').is(':checked')) {
        for (var i = 0; i < list.length; i++) {
            myVal = $('#' + list[i]).val();
            $('#billing_' + list[i]).val(myVal).removeClass('grey-text');
        }
        $('.billing_state-selector').html($('.state-selector').html());
        $('.billing_state-selector').find('input').attr('name', 'billing_state');
        $('.billing_state-selector').find('input').attr('id', 'billing_state');
        $('.billing_state-selector').find('select').attr('name', 'billing_state');
        $('.billing_state-selector').find('select').attr('id', 'billing_state');
        $('#billing_state').val($('#state').val());
    }
    //$('.billing-cell').toggle();
}

function updateStateList(obj, target) {
    var cID = $(obj).val();
    var can_fs = $('#fs_eligible').val();
    if ((cID == 38 || cID == 230) && can_fs == '1') {
        $('#is_free_shipping').val(1);
    }
    var is_fs = $('#is_free_shipping').val();
    var myHTML = '';
    $.ajax({
        type: "POST",
        url: '/~TOOL_ECOMM/ajax/ajax_state-select.cfm',
        data: 'country_ID=' + cID + '&isJS=true',
        dataType: 'json',
        beforeSend: function (msg) {
            $('.' + target + '-selector').html('Loading...');
        },
        success: function (msg) {
            if (!msg.HASSTATES) {
                myHTML = myHTML + '<input type="text" name="' + target + '" id="' + target + '" class="info-field-mid" value="State/Province" placeholder="State/Province" onFocus="clearPlaceholder(this,\'State/Province\');" onblur="setPlaceholder(this,\'State/Province\');" />';
            } else {
                myHTML = myHTML + '<select name="' + target + '" id="' + target + '" class="info-field-mid" onchange="updateTaxTotal(this);" onblur="setPlaceholder(this,\'State/Province\');"><option value="">Please Select</option>';
                for (var i = 0; i < msg.RSSTATES.DATA.length; i++) {
                    myHTML = myHTML + '<option value="' + msg.RSSTATES.DATA[i][2] + '">' + msg.RSSTATES.DATA[i][3] + '</option>';
                }
                myHTML = myHTML + '</select>';
            }
            if ($(obj).attr('id') == 'country_ID')
                $('#stored_country_ID').val(cID);
            $('.' + target + '-selector').css('display', 'none');
            $('.' + target + '-selector').html(myHTML);
            $('.' + target + '-selector').css('display', 'inline');
        }
    });
    if (target == 'state' && parseInt(cID) > 0) {
        $.ajax({
            type: "POST",
            url: '/~TOOL_ECOMM/ajax/ajax_shipping-select.cfm',
            data: 'country_ID=' + cID + '&isJS=true',
            dataType: 'json',
            beforeSend: function (msg) {
                $('.s-h-total').html('$0.00');
                $('#shippingCost_select_ID').hide();
                $('#shipping-selector-name').html('').css('display', 'none');
                $('#shipping-selector-title').css('display', 'none');
            },
            success: function (msg) {
                $("#shippingCost_ID").val(msg.RSSHIPPINGOPTIONS.DATA[0][0]);
                currentID = $("#shippingCost_ID").val();
                //myHTML2 = '<select name="shippingCost_select_ID" id="shippingCost_select_ID" class="info-field-mid" onchange="updateShippingCostID()" style="width:195px;margin-left:5px"><option value="">Please Select</option>';
                myHTML2 = '';
                for (var i = 0; i < msg.RSSHIPPINGOPTIONS.DATA.length; i++) {
                    if (msg.RSSHIPPINGOPTIONS.DATA[i][0] == currentID) {
                        sel = ' selected="selected"';
                    } else {
                        sel = '';
                    }
                    myHTML2 = myHTML2 + '<option value="' + msg.RSSHIPPINGOPTIONS.DATA[i][0] + '"' + sel + '>' + msg.RSSHIPPINGOPTIONS.DATA[i][1] + '</option>';
                }
                $('#shipping_price').val(0);
                $('#shipping_multiplier').val(0);
                $('#cart_tax1').val(0);
                $('#cart_tax2').val(0);
                $('#tax_type_1').val('');
                $('#tax_type_2').val('');
                $('.tax-total-1').html('$0.00');
                $('.tax-type-1').html('');
                $('.tax-total-2').html('');
                $('.tax-typel-1').html('');
                //myHTML2 = myHTML2 + '</select>';
                $('#shippingCost_select_ID').html(myHTML2);

                if (msg.RSSHIPPINGOPTIONS.DATA.length == 1) {
                    $('#shipping-selector-name').css('display', 'none');
                    $('#shipping-selector-name').html('<strong>(' + msg.RSSHIPPINGOPTIONS.DATA[0][1] + ')</strong>')
                    $('#shipping-selector-name').css('display', 'block');
                    $('#shippingCost_select_ID').hide();
                } else {
                    $('#shipping-selector-name').css('display', 'none');
                    $('#shippingCost_select_ID').show();
                    $('#shippingCost_select_ID').attr('style', 'width:238px');
                }
                $('#shipping-selector-title').css('display', 'inline');
                $('#shipping-selector-title').attr('style', 'background:none; font-weight:bold');
                $('#shipping-selector-name').attr('style', 'background:none; font-weight:bold');
                $('#stored_zone_ID').val(msg.ZONE_ID);

                updateShippingTotal();
            }
        });
    }
    return false;

}


function updateShippingCostID() {
    var selectedID = $('#shippingCost_select_ID').val();
    $('#shippingCost_ID').val(selectedID);
    updateShippingTotal();
}

/*function getleftCellHeight() {
 var myHeight = $('.cart-right').css('height');
 }*/

function getPlayer(file1, file2, poster, category, w, h, container) {
    var theURL = '/ASSETS/video/';
    var playOnLoad = false;

    if (typeof container == 'undefined')
        container = 'video-container';
    if (typeof category == 'undefined')
        category = 'Videos';
    if (typeof w == 'undefined')
        w = 618;
    if (typeof h == 'undefined')
        h = 360;
    if (typeof poster == 'undefined') {
        poster = 'video-placeholder.png';
    } else if (!poster.length) {
        poster = 'video-placeholder.png';
    }
    theURL = 'http://cdn.mypypeline.com/GSPRF/';
    theSkinURL = 'http://cdn.mypypeline.com/GSPRF/';
    if ($('#' + container).hasClass('play-on-load')) {
        playOnLoad = true;
    }
    if ($('#' + container).hasClass('tv-trailer')) {
        file1 = 'rushfit-trailer.m4v';
    }
    jwplayer(container).setup({
        file: theURL + file1,
        width: w,
        height: h,
        image: theURL + 'posters/' + poster,
        skin: theSkinURL + 'beelden/beelden.zip',
        players: [
            {type: 'html5'},
            {type: 'flash', src: '/%7EASSETS/JS/player.swf'}
        ],
        events: {
            onPlay: function (evt) {
                ga('send', 'event', category, 'Play', file1);
            },
            onPause: function (evt) {
                ga('send', 'event', category, 'Pause', file1);
            },
            onBuffer: function (evt) {
                ga('send', 'event', category, 'Buffering', file1);
            }
        }
    });
    if (playOnLoad) {
        jwplayer(container).play();
    }
    /*

     levels: [
     {file: theURL + file1},
     {file: theURL + file2}
     ],

     */
}


function loadSelectedVideo() {
    var myS = $('.video-select-block ul li.current-item a').attr('href').replace('#v=', '').replace('?v=', '').split(',');
    myVid = myS[0];
    if (myS.length >= 2)
        myPreload = myS[1];
    if (myS.length >= 3)
        myPoster = myS[2];
    myVidType = myVid.split('.');
    myOGV = '';
    for (var i = 0; i < myVidType.length - 1; i++) {
        myOGV = myOGV + myVidType[i];
    }
    myOGV = myOGV + '.ogv';
    getPlayer(myVid, myOGV, myPoster);
}


function loadPopPlayer(vid, poster, category) {
    //loads popup only if it is disabled
    $(".backgroundPopup").css('height', $(document).height());
    $(".backgroundPopup").css('display', 'block');
    $(".backgroundPopup").fadeIn("fast");
    if (typeof category == 'undefined')
        category = 'Trailer Video';
    myVidType = vid.split('.');
    myOGV = '';
    for (var i = 0; i < myVidType.length - 1; i++) {
        myOGV = myOGV + myVidType[i];
    }
    myOGV = myOGV + '.ogv';
    var windowWidth = $(window).width();
    var windowHeight = $(window).height();

    var popupHeight = $("#player-pop").height();
    var popupWidth = $("#player-pop").width();

    //centering
    var top = (windowHeight / 2 - popupHeight / 2) + $(window).scrollTop();
    if (top < 0) {
        top = 5;
    }
    $("#player-pop").css({
        "position": "absolute",
        "top": top + 'px',
        "left": windowWidth / 2 - popupWidth / 2 + 'px',
        "z-index": 2500
    });
    $('#player-pop').show('fast');
    getPlayer(vid, myOGV, poster, category, 640, 368, 'player-pop-body');
    return false;
}

function closePlayer() {
    $(".backgroundPopup").fadeOut("fast");
    $("#player-pop").fadeOut("fast");
    $("#player-pop-body").html('');
    return false;
}

function downloadEmail(fld) {
    //loads popup only if it is disabled
    $(".backgroundPopup").css('height', $(document).height());
    $(".backgroundPopup").css('display', 'block');
    $(".backgroundPopup").fadeIn("fast");

    $.ajax({
        type: "POST",
        url: '~SITE/layout/dsp_email.cfm',
        data: 'email=' + fld,
        success: function (msg) {
            $("#player-pop-body").html(msg);
            //request data for centering
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();

            var popupHeight = $("#player-pop").height();
            var popupWidth = $("#player-pop").width();

            //centering
            var top = (windowHeight / 2 - popupHeight / 2) + $(window).scrollTop();
            if (top < 0) {
                top = 5;
            }
            $("#player-pop").css({
                "position": "absolute",
                "top": top + 'px',
                "left": windowWidth / 2 - popupWidth / 2 + 'px'
            });
            $("#player-pop").fadeIn("fast");
        }
    });
}

function showGuarantee() {
    //loads popup only if it is disabled
    $(".backgroundPopup").css('height', $(document).height());
    $(".backgroundPopup").css('display', 'block');
    $(".backgroundPopup").fadeIn("fast");

    $.ajax({
        type: "POST",
        url: '/refund_policy/',
        data: 'ispop=true',
        success: function (msg) {
            $("#player-pop-body").html(msg);
            //request data for centering
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();

            var popupHeight = $("#player-pop").height();
            var popupWidth = $("#player-pop").width();

            //centering
            var top = (windowHeight / 2 - popupHeight / 2) + $(window).scrollTop();
            if (top < 0) {
                top = 5;
            }
            $("#player-pop").css({
                "position": "absolute",
                "top": top + 'px',
                "left": windowWidth / 2 - popupWidth / 2 + 'px'
            });
            $("#player-pop").fadeIn("fast");
        }
    });
}

function showShippingDetails() {
    //loads popup only if it is disabled
    $(".backgroundPopup").css('height', $(document).height());
    $(".backgroundPopup").css('display', 'block');
    $(".backgroundPopup").fadeIn("fast");

    $.ajax({
        type: "POST",
        url: '/shipping-policy/',
        data: 'ispop=true',
        success: function (msg) {
            $("#player-pop-body").html(msg);
            //request data for centering
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();

            var popupHeight = $("#player-pop").height();
            var popupWidth = $("#player-pop").width();

            //centering
            var top = (windowHeight / 2 - popupHeight / 2) + $(window).scrollTop();
            if (top < 0) {
                top = 5;
            }
            $("#player-pop").css({
                "position": "absolute",
                "top": top + 'px',
                "left": windowWidth / 2 - popupWidth / 2 + 'px'
            });
            $("#player-pop").fadeIn("fast");
        }
    });
}


function getCellHeight() {
    if ($(window).width() > 320) {
        var leftSide, rightSide = 0;
        leftSide = $('.cart-left').height();
        rightSide = $('.cart-right').height();
        if (leftSide > rightSide) {
            $('.cart-right').css('height', leftSide + 'px');
        }
    }
}


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
            else {
                //$(this).hide();
                //$(this).siblings().find('span:last-child').html('+');
            }
        });

        return false;
    });

    w = $(window).width() + s;
    imgLoading(w);

    function imgLoading(w) {
        var dom = "";
        var threshold = "";

        if (w >= 1300) {
            dom = "img.lazy-1200";
            threshold = 100;
        } else if (w < 1300 && w >= 1100) {
            dom = "img.lazy-1024";
            threshold = 100;
        } else if (w < 1100 && w >= 1000) {
            dom = "img.lazy-960";
            threshold = 100;
        } else if (w < 1000 && w >= 768) {
            dom = "img.lazy-768";
            threshold = 100;
        } else if (w < 768) {
            dom = "img.lazy-320";
            threshold = 50;
        }
        $(dom).removeClass("display-none");
        $('.special-display').not(dom).css("display","none");

        $(dom).lazyload({
            effect: "fadeIn",
            threshold : threshold,
            placeholder : "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        });

    }


    /*if (w >= 1300) {

     }
     else if (w < 1300 && w >= 1100) {
     $('img').each(function () {
     $(this).attr('data-src', $(this).data('1024'));
     });
     }
     else if (w < 1100 && w >= 1000) {
     $('img').each(function () {
     $(this).attr('data-src', $(this).data('960'));
     });
     }
     else if (w < 1000 && w >= 768) {
     $('img').each(function () {
     $(this).attr('data-src', $(this).data('768'));
     });
     }
     else if (w < 768) {
     $('img').each(function () {
     $(this).attr('data-src', $(this).data('320'));
     });
     }*/

    //$("img.lazy").trigger("appear");

    //$("img.lazy").lazyload({
    //	effect : "fadeIn"
    //});

});
/*
$(window).resize(function () {
    w = $(window).width() + s;

    if (w >= 1300 && c != 1300) {
        $('img').each(function () {
            $(this).attr('data-src', $(this).data('1200'));
        });
        //$("img.lazy").trigger("appear");
        c = 1200;
    }
    else if (w < 1300 && w >= 1100 && c != 1024) {
        $('img').each(function () {
            $(this).attr('data-src', $(this).data('1024'));
        });
        //$("img.lazy").trigger("appear");
        c = 1024;
    }
    else if (w < 1100 && w >= 1000 && c != 960) {
        $('img').each(function () {
            $(this).attr('data-src', $(this).data('960'));
        });
        //$("img.lazy").trigger("appear");
        c = 960;
    }
    else if (w < 1000 && w >= 768 && c != 768) {
        $('img').each(function () {
            $(this).attr('data-src', $(this).data('768'));
        });
        //$("img.lazy").trigger("appear");
        c = 768;
    }
    else if (w < 768 && c != 320) {
        $('img').each(function () {
            $(this).attr('data-src', $(this).data('320'));

        });
        //$("img.lazy").trigger("appear");
        c = 320;
    }

    $("img.lazy").lazyload({
     effect : "fadeIn"
     });

});*/


$(window).scroll(function () {

    if ($(this).scrollTop() > 0) {
        $('.top').addClass('top-small');
    }
    else {
        $('.top').removeClass('top-small');
    }
});

$(document).ready(function () {
    $('.mobile-total-right').html($('.order-total').html());

    $('a.mobile-cart ').click(function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $(this).find('i').removeClass('fa-minus').addClass('fa-plus');
            $('div.mobile-accordion').slideUp();
        }
        else {
            $(this).addClass('open');
            $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
            $('div.mobile-accordion').slideDown();
        }

        return false;
    });
});

