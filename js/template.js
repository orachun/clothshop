jQuery.extend(jQuery.validator.messages, {
    required: "<div class=\"validation-err-msg\">กรุณากรอกข้อมูลช่องนี้ด้วยค่ะ</div>",
    remote: "Please fix this field.",
    email: "<div class=\"validation-err-msg\">กรุณากรอก Email ด้วยค่ะ (ตัวอย่าง: tom@gmail.com)</div>",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "<div class=\"validation-err-msg\">กรุณากรอกเป็นตัวเลขเท่านั้นค่ะ</div>",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "<div class=\"validation-err-msg\">กรุณากรอกรหัสซ้ำอีกครั้งค่ะ</div>",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("<div class=\"validation-err-msg\">ข้อมูลต้องไม่ต่ำกว่า {0} ตัวค่ะ</div>"),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

function th_color(col)
{
    switch(col)
    {
        case 'red': return 'แดง';
        case 'green': return 'เขียว';
        case 'blue': return 'น้ำเงิน';
        case 'lightblue': return 'ฟ้า';
        case 'black': return 'ดำ';
        case 'white': return 'ขาว';
        case 'yellow': return 'เหลือง';
        case 'brown': return 'น้ำตาล';
        case 'purple': return 'ม่วง';
        case 'orange': return 'ส้ม';
        case 'gray': return 'เทา';
        case 'pink': return 'ชมพู';
    }
}


$.pnotify.defaults.styling = "jqueryui";
$.pnotify.defaults.history = false;
$.pnotify.defaults.delay = 8000;
function notify(type, title, message)
{
    $.pnotify({
        title: title,
        text: message,
        type: type,
        before_open: function(pnotify) {
            pnotify.css({
                "left": ($(window).width() / 2) - (pnotify.width() / 2)
            });
        }
    });
}


function form_valid(form_selector, rules_obj)
{
    var validator = $(form_selector).validate({
        rules: rules_obj
    });
    validator.form();
    return $(form_selector).valid();
}



function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example 1: number_format(1234.56);
    // *     returns 1: '1,235'
    // *     example 2: number_format(1234.56, 2, ',', ' ');
    // *     returns 2: '1 234,56'
    // *     example 3: number_format(1234.5678, 2, '.', '');
    // *     returns 3: '1234.57'
    // *     example 4: number_format(67, 2, ',', '.');
    // *     returns 4: '67,00'
    // *     example 5: number_format(1000);
    // *     returns 5: '1,000'
    // *     example 6: number_format(67.311, 2);
    // *     returns 6: '67.31'
    // *     example 7: number_format(1000.55, 1);
    // *     returns 7: '1,000.6'
    // *     example 8: number_format(67000, 5, ',', '.');
    // *     returns 8: '67.000,00000'
    // *     example 9: number_format(0.9, 0);
    // *     returns 9: '1'
    // *    example 10: number_format('1.20', 2);
    // *    returns 10: '1.20'
    // *    example 11: number_format('1.20', 4);
    // *    returns 11: '1.2000'
    // *    example 12: number_format('1.2000', 3);
    // *    returns 12: '1.200'
    var n = !isFinite(+number) ? 0 : +number, 
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}


function themeButton(selector)
{
    var btnSelector = selector + ' .button';
    $(btnSelector).addClass('ui-state-default');
    $(btnSelector+':not(.disabled)').hover(
        function(){ $(this).addClass('ui-state-hover'); }, 
        function(){ $(this).removeClass('ui-state-hover'); }
    );
    $(btnSelector+'.disabled').addClass('ui-state-disabled');
}


function openTab(tab)
{
    tab.addClass("opening-tab");
    tab.animate({right: "-140px"}, 200);
    reloadTab(tab);
}

function closeTab(tab)
{
    tab.zIndex = 1999;
    tab.removeClass("opening-tab");
    tab.animate({right: "-480px"}, 200);
}

function reloadTab(tab)
{
    var tabContent = tab.find(".right-tab-content");
    if (tabContent.attr("url") !== undefined)
    {
        tabContent.waiting();
        tabContent.load(tabContent.attr("url"), function(){
			tabContent.waiting('done');
        });
    }
}

$(function() {
    $(document).tooltip({
        track: true,
        hide: {
            effect: "fade",
            duration: 50
        }
    });
    $(".right-tab .handle").click(function() {
        var tab = $(this).parent();
        if (!tab.hasClass("opening-tab"))
        {
            tab.zIndex = 2000;
            closeTab($(".opening-tab"));
            openTab(tab);
        }
        else
        {
            closeTab(tab);
        }
    });

    $("html").click(function(e) {
        if (e.isTrigger === undefined
                && $(e.target).parents(".right-tab").length === 0
                && !$(e.target).is(".form-item-buy-btn")
                && $(e.target).parents(".form-item-buy-btn").length === 0
                && !$(e.target).is('.order-review .register-btn')
                && $(e.target).parents('.order-review .register-btn').length === 0
                && !$(e.target).is('.customer-orders .payment-inform-btn')
                && $(e.target).parents('.customer-orders .payment-inform-btn').length === 0
                )
        {
            closeTab($(".opening-tab"));
        }
    });
    $("#order-modal").dialog({
        autoOpen: false,
        height: $(window).height() - 100,
        width: $(window).width() - 300,
        modal: false,
        dialogClass: "order-modal-dialog",
        open: function( event, ui ) {
            var dialog = $('.order-modal-dialog:first');
            dialog.css({
                "left": ($(window).width() / 2) - (dialog.width() / 2),
                "top": ($(window).height() / 2) - (dialog.height() / 2),
                "position": "fixed"
            });
        }
    });
    
    $('#topbar #product-cat').change(function(){
        var catid = $(this).val();
        if(catid > 0)
        {
            window.location.href = base_url+'index.php/product/index/'+catid;
        }
    });
    $('#topbar #search-btn').click(function(){
        var key = $.trim($('#topbar #search-box').val());
        if(key != '')
        {
            window.location.href = base_url+'index.php/product/search/'+key;
        }
        else
        {
            notify('error', 'ค้นหา', 'กรุณาใส่คำเพื่อค้นหา');
        }
    });
    
    themeButton('');
});


