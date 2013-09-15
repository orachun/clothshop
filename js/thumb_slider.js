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


function gallery(container_selector, img_selector)
{
	$(container_selector).each(function(){
		var container = $(this);
		if(container.hasClass('gallery-inited')) return;
		container.append('<div class="gallery-controller"><span class="prev-btn"/><span class="next-btn"/></div>');
		container.append('<div class="gallery-viewport ui-corner-all"><div style="width: inherit; height: interit;display: table-cell;vertical-align: middle; text-align: center;"/></div>');
		container.append('<div class="gallery-thumb-list"></div>');
		var viewport = container.find('.gallery-viewport > div');
		var thumb_list = container.find('.gallery-thumb-list');
		container.find(img_selector).each(function(i, e){
			
			if($(e).width()>$(e).height())
			{
				$(e).addClass('image-wide');
			}
			else
			{
				$(e).addClass('image-high');
			}
			var img = $(e).clone();
			$(img).addClass('gallery-image');
			$(img).addClass('gallery-image-'+i);
			if($(img).width()>$(img).height())
			{
				$(img).addClass('image-wide');
			}
			else
			{
				$(img).addClass('image-high');
			}
			viewport.append(img);
			thumb_list.append(e);
			$(e).addClass('gallery-thumb');
			$(e).attr('forindex', i);
		});
		thumb_list.find('.gallery-thumb').wrap('<div style="display:inline-block;"><div class="gallery-thumb-container ui-corner-all"/></div>')
		viewport.find('.gallery-image').hide(0);
		viewport.find('.gallery-image-0').addClass('gallery-current-image');
		viewport.find('.gallery-image-0').show(0);
		thumb_list.find('.gallery-thumb-container:first').addClass('gallery-current-thumb');
		var show_image = function(index)
		{
			var current = viewport.find('.gallery-current-image');
			var img = viewport.find('.gallery-image-'+index);
			current.removeClass('gallery-current-image');
			var current_thumb = thumb_list.find('.gallery-current-thumb');
			current_thumb.removeClass('gallery-current-thumb');
			var thumb = thumb_list.find('.gallery-thumb[forindex="'+index+'"]');
			thumb.parent().addClass('gallery-current-thumb');
			current.hide('fade', 200, function(){
				img.addClass('gallery-current-image');
				img.show('fade', 200);
			});
		};
		thumb_list.find('.gallery-thumb-container').click(function(){
			var index = $(this).find('.gallery-thumb').attr('forindex');
			show_image(index);
		});
		container.find('.gallery-controller').hide(0);
		container.find('.gallery-viewport, .gallery-controller').hover(function(){
			container.find('.gallery-controller').show(0);
		}, function(){
			container.find('.gallery-controller').hide(0);
		});
		var controller = container.find('.gallery-controller');
		var total_images = thumb_list.find('.gallery-thumb').length;
		controller.find('.prev-btn').click(function(){
			var current_index = parseInt(thumb_list.find('.gallery-current-thumb .gallery-thumb').attr('forindex'));
			var index = (total_images+current_index-1)%total_images;
			show_image(index);
		});
		controller.find('.next-btn').click(function(){
			var current_index = parseInt(thumb_list.find('.gallery-current-thumb .gallery-thumb').attr('forindex'));
			var index = (current_index+1)%total_images;
			show_image(index);
		});
		
		container.addClass('gallery-inited');	
	});
}