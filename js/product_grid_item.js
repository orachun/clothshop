$(function(){
    $('.product-grid-item').click(function(e){
        e.preventDefault();
        $(".product-detail-container").remove();
        var pid = $(this).attr('pid');	
        var lastElement = null;
        if($(this).parents('.product-showcase').length == 0)
        {
            lastElement = $(this).parents('.product-grid-row');
        }
        else
        {
            lastElement = $(this).parents('.product-showcase');
        }
        lastElement.after('<div class="product-detail-container ui-corner-all" pid="' + pid + '"><div class="close-btn-container"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span></div></div>');

        $(".close-btn-container").click(function() {
            $(this).parents(".product-detail-container").slideUp(1000, function() {
                $(this).remove();
            });
        });

        var container = $(".product-detail-container:first");
        container.waiting();
        $('html, body').animate({
            scrollTop: container.offset().top - 20
        }, 700);
        container.animate({
            "height": "600px"
        }, 700, function() {
            $.get(base_url+'index.php/product/detail/' + pid + '/true', function(data) {
                container.append(data);
				container.css('height', 'auto');
                container.waiting('done');
            });
        });
    });
    
    
});