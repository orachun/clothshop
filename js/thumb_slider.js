function slide(container_selector, thumb_selector, items_per_row, delay, animation_duration)
{
    $(container_selector).each(function(index, ele){
        var container = $(ele);
        if(container.hasClass('thumb-slider-inited'))
        {
            return;
        }
        var total_thumbs = container.find(thumb_selector).length;
        var total_rows = Math.ceil(total_thumbs/items_per_row);
        container.append('<div class="thumb-slider"></div>');
        var thumb_slider = container.find('.thumb-slider');
        thumb_slider.append('<ul></ul>');
        for(var i=0;i<total_rows;i++)
        {
            thumb_slider.find('ul').append('<li><a href="#thumb-slider-row-'+(i+1)+'">x</a></li>');
            thumb_slider.append('<div id="thumb-slider-row-'+(i+1)+'"></div>');
            for(var j=0;j<items_per_row && i*items_per_row+j<total_thumbs;j++)
            {
                thumb_slider.find("#thumb-slider-row-"+(i+1)).append($(container.find(thumb_selector)[0]));
                thumb_slider.find("#thumb-slider-row-"+(i+1)).append(' ');
            }
        }

        thumb_slider.tabs({
            show: { effect: "fade", duration: animation_duration/2 },
            hide: { effect: "fade", duration: animation_duration/2 },
            create: function( event, ui ) {
                var id = setInterval(function(){
                    var next = (thumb_slider.tabs( "option", "active" )+1)%total_rows;
                    thumb_slider.tabs( "option", "active", next);
                }, delay);
                thumb_slider.hover(function(){
                    clearInterval(id);
                }, function(){
                    id = setInterval(function(){
                        var next = (thumb_slider.tabs( "option", "active" )+1)%total_rows;
                        thumb_slider.tabs( "option", "active", next);
                    }, delay);
                });
            },
            beforeActivate: function(event, ui) {
                $(this).css('height', $(this).height());
                $(this).css('overflow', 'hidden');
            },
            activate: function(event, ui) {
                $(this).css('height', 'auto');
                $(this).css('overflow', 'visible');
            }
        });
        
        container.addClass('thumb-slider-inited');
    });
}