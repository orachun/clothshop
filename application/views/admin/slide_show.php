<div class="slide-show-list">
    <?php foreach($slides as $s):?>
    <div>
        <button class="del-slide" id="<?php echo $s['slide_id'];?>">Del</button>
        <?php echo $s['img'];?>: <?php echo base_url().$s['link'];?>
    </div>
    <?php endforeach;?>
    
    <form class="add-slide">
        Link: <?php echo base_url();?><input type="text" name="link" size="50"/>
        <input type="hidden" name="img-name"/>
        <div class="img-upload"></div>
        <input type="button" class="add-slide-btn" value="Add"/>
    </form>
</div>

<script>
$(function(){
    ajax_upload_form('.slide-show-list .img-upload', '.slide-show-list .add-slide input[name="img-name"]', '<input type="button" value="Upload Img"/>');
    $('.slide-show-list .add-slide .add-slide-btn').click(function(){
        $.post(base_url+'index.php/admin/add_slideshow', $('.slide-show-list .add-slide').serialize(),
            function(data){
                $('.slide-show-list').parent().load(base_url+'index.php/admin/slideshow');
            });
    });
    $('.slide-show-list .del-slide').click(function(){
        $.post(base_url+'index.php/admin/del_slideshow', {'slide-id': $(this).attr('id')}, function(){
            $('.slide-show-list').parent().load(base_url+'index.php/admin/slideshow');
        });
    });
});    
</script>