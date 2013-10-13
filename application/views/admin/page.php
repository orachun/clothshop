<style>
    .page-list .edit-container, .page-list .add-page
    {
        margin: 20px;
        border: solid 1px gray;
        border-radius: 4px;
        padding: 20px;
    }
</style>
<div class="page-list">
    <?php foreach($pages as $p):?>
    <div class="page-container" pid="<?php echo $p['id'];?>">
        <button class="del-page" pid="<?php echo $p['id'];?>">Del</button>
        <a href="<?php echo base_url().'index.php/page/content/'.$p['link_name'];?>" target="_blank"><?php echo $p['name'];?></a>
        <button class="edit-btn">Edit</button>
        <form class="edit-container">
            <input type="hidden" name="id" value="<?php echo $p['id'];?>"/>
            Name: <input type="text" name="name" value="<?php echo $p['name'];?>"/><br/>
            Link: <input type="text" name="link_name" value="<?php echo $p['link_name'];?>"/><br/>
            <textarea name="content" class="page-content"><?php echo $p['content'];?></textarea><br/>
            <button class="save_page">Save</button>
        </form>
    </div>
    <?php endforeach;?>
    <br/><br/><br/>
    <form class="add-page">
        Name: <input type="text" name="name"/><br/>
        Link: <input type="text" name="link_name"/><br/>
        <textarea id="new-page-content" name="content"></textarea><br/>
		<a href="http://www.picdee.com/" target="_blank">Upload Image</a><br/>
        <input type="submit" value="Add"/>
    </form>
</div>


<script>
    $(function(){
        $('.page-list .edit-container').hide();
        $('.page-list .edit-btn').click(function(){
            if($(this).html() == 'Edit')
            {
                $(this).parent().find('.edit-container').show();
                $(this).html('Hide');
				var id = $(this).parents(".page-container").attr("pid");
				initEditor('.page-list .page-container[pid="'+id+'"] .page-content');
            }
            else
            {
                $(this).parent().find('.edit-container').hide();
                $(this).html('Edit');
            }
        });
        
        $('.page-list .add-page').submit(function(){
            $('.page-list').waiting();
//			$('.page-list .add-page #new-page-content').val(tinyMCE.get('new-page-content').getContent());
            $.post(base_url+'index.php/admin/add_page', $(this).serialize(), function(){
                $('.page-list').parent().load(base_url+'index.php/admin/page');
            });
            return false;
        });
        $('.page-list .del-page').click(function(){
            var btn = $(this);
            $.post(base_url+'index.php/admin/del_page', {id:$(this).attr('pid')}, function(){
                btn.parent().remove();
            });
        });
		
		initEditor('.page-list .add-page #new-page-content');
    });
</script>