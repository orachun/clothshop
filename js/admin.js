function initEditor(selector)
{
	if (!$(selector).hasClass("editor-inited"))
	{
		tinymce.init({
			selector: selector,
			plugins: [
				"advlist autolink autosave link image lists charmap hr anchor pagebreak spellchecker",
				"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons template textcolor paste textcolor"
			],
			toolbar1: "forecolor backcolor bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect fontselect fontsizeselect | searchreplace | bullist numlist | outdent indent blockquote | link unlink anchor image media | table | hr removeformat | subscript superscript | charmap emoticons | fullscreen code",
			menubar: false,
			toolbar_items_size: 'small',
			setup: function(editor) {
				editor.on('change', function(e) {
					editor.save();
				});
			}
		});
		$(selector).addClass("editor-inited");
	}
}