function ajax_upload_form(container_selector, filename_hidden_field_selector, upload_label, uploaded_callback)
{
    if(uploaded_callback == undefined)
    {
        uploaded_callback = function(){};
    }
    if(upload_label == undefined)
    {
        upload_label = 'เลือกไฟล์';
    }
    var container = $($(container_selector)[0]);
    container.append('<form id="_ajax-upload-form" action="'+base_url+'index.php/others/upload" method="post" enctype="multipart/form-data">'
    +'<input type="file" size="60" name="file">'
    +'<input type="submit" value="Upload">'
    +'</form>');
    container.append('<div id="_ajax-upload-div"><span id="browse-btn" class="button ui-corner-all">'+upload_label+'</span><div><span id="filename"></span> <span id="progress"></span></div></div>')
    var form = container.find('form');
    container.find('#browse-btn').click(function(){
        form.find('input[name="file"]').click();
    });
    form.find('input[name="file"]').change(function(){
        container.find('#_ajax-upload-div #filename').html($(this).val().replace(/^.*[\\\/]/, ''));
        form.submit();
    });
    form.hide(0);
    var options = { 
        beforeSend: function() 
        {
            container.find('#_ajax-upload-div #progress').html("(0%)");
        },
        uploadProgress: function(event, position, total, percentComplete) 
        {
            container.find('#_ajax-upload-div #progress').html('('+percentComplete+'%)');
        },
        success: function() 
        {
            container.find('#_ajax-upload-div #progress').html('(100%)');
        },
        complete: function(response) 
        {
            $(filename_hidden_field_selector).val(response.responseText);
            uploaded_callback();
        },
        error: function()
        {
            container.find('#_ajax-upload-div #progress').html("<font color='red'> ERROR: unable to upload files</font>");
        }
    }; 
    container.find('#_ajax-upload-form').ajaxForm(options);
}