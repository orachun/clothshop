function modal(type, content, title)
{
	$('body').waiting();
	var modalID = 'modal-'+Math.random().toString(36).substr(2, 5);
	$('body').append('<div id="'+modalID+'" title="'+title+'"></div>');
	var modal = $('#'+modalID);
	var modal_settings = {
		modal:true, 
		close: function( event, ui ) {modal.remove();},
		width: 750
	}
	if(type == 'url')
	{
		modal.load(content, function(){
			modal.dialog(modal_settings);
			$('body').waiting('done');
		});
	}
	else
	{
		modal.html(content);
		modal.dialog(modal_settings);
		$('body').waiting('done');
	}
}