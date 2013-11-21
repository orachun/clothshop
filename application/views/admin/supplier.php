<div class="supplier">
	<table class="admin-table">
		<thead>
			<th>Name</th>
			<th>URL</th>
			<th>Delete</th>
		</thead>
		<tbody>
			<?php foreach ($suppliers as $i=>$c):?>
			<tr class="<?php echo $i%2==0?'odd':'even';?>">
				<td><?php echo $c->name;?></td>
				<td><a href="<?php echo $c->url;?>" target="_blank"><?php echo $c->url;?></a></td>
				<td><button class="del_btn" sid="<?php echo $c->supplier_id;?>">Delete</button></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
    
    <div class="add">
        Name: <input name="name"/> URL: <input name="url"/><button class="add_btn">Add</button>
    </div>
</div>

<script type="text/javascript">
    $('.supplier .add_btn').click(function(){
        var name = $('.supplier .add input[name="name"]').val();
        var url = $('.supplier .add input[name="url"]').val();
        $.post(base_url+'index.php/admin/supplier_add', {
            'name': name,
            'url': url
        }, function(){
            $('.supplier').parent().load(base_url+'index.php/admin/supplier');
        });
    });
    $('.supplier .del_btn').click(function(){
        var sid = $(this).attr('sid');
        $.post(base_url+'index.php/admin/supplier_del', {
            'sid': sid
        }, function(){
            $('.supplier').parent().load(base_url+'index.php/admin/supplier');
        });
    });
</script>