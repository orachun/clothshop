<div class="product-grid-item" pid="<?php echo $product_id;?>" title="<?php echo $name;?>">
	<a href="<?php echo base_url().'index.php/product/detail/'.$product_id;?>" target="_blank">
		<img src="<?php echo $img;?>"/>
<!--		<div class="pname"><?php echo $name;?></div>-->
		<div class="pprice ui-corner-top"><?php echo number_format($unit_price, 0);?>฿</div>
	</a>
</div>
