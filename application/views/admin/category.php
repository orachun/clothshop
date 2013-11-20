<div class="category">
    <?php foreach($cats as $c):?>
		<div class="item-container">
			<?php echo $c->name;?>
			<button class="del_btn" catname="<?php echo $c->name;?>">Del</button>
		</div>
    <?php endforeach; ?>
    <div class="add">
        <input name="cat_name"/><button class="add_btn">Add</button>
    </div>
</div>

<script type="text/javascript">
    $('.category .add_btn').click(function(){
        var name = $('.category .add input').val();
        $.post(base_url+'index.php/admin/category_add/'+name, function(){
            $('.category').parent().load(base_url+'index.php/admin/category');
        });
    });
    $('.category .del_btn').click(function(){
        var name = ($(this).attr('catname'));
		if(confirm("Delete category "+name+"?"))
		{
			$.post(base_url+'index.php/admin/category_del/'+name, function(){
				$('.category').parent().load(base_url+'index.php/admin/category');
			});
		}
    });
</script>