<div class="delivering">
    <?php foreach($deliverings as $c)
    {
        echo '<div class="item-container">'
                .$c->name 
                .'<br/> Unit Cost: '.$c->unit_cost
                .'<br/> Free Threshold: '. $c->free_threshold
                .'<br/> Discarded: '. $c->is_discarded
                .'<br/> <button class="del_btn" did="'.$c->delivery_type_id.'">Discard</button> </div>';
    }
    ?>
    <form class="add">
        Name: <input name="name"/> 
        Unit cost: <input name="unit_cost"/> 
        Free threshold: <input name="free_threshold"/>
        <input type="button" class="add_btn" value="Add">
    </form>
</div>

<script type="text/javascript">
    $('.delivering .add_btn').click(function(){
        $.post(base_url+'index.php/admin/add_delivery', $('.delivering .add').serialize(), function(){
            $('.delivering').parent().load(base_url+'index.php/admin/delivering');
        });
    });
    $('.delivering .del_btn').click(function(){
        if(confirm("Can't be undone! Discard?"))
		{
			var did = $(this).attr('did');
			$.post(base_url+'index.php/admin/discard_delivery', {
				'id': did
			}, function(){
				$('.delivering').parent().load(base_url+'index.php/admin/delivering');
			});
		}
    });
</script>