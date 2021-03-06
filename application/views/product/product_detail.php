<div class="product-detail product-detail-<?php echo $product_id; ?>">
    <div class="product-detail-gallery">

		<?php for ($i = 0; $i < count($images); $i++): ?>
			<img src="<?php echo $images[$i]; ?>" />
		<?php endfor; ?>

    </div>
    <div class="product-detail-content">
        <div class="pname"><a href="<?php echo base_url(); ?>index.php/product/detail/<?php echo $product_id; ?>" target="_blank"><?php echo $name; ?></a></div>

        <div>
            รหัส <span class="pcode"><?php echo $display_id; ?></span>
            ราคา <span class="pprize"><?php echo number_format($unit_price, 2); ?> บาท</span>
        </div>

        <form class="buy-form ui-corner-all">
            <input type="hidden" name="pid" value="<?php echo $product_id; ?>"/>
            <input type="hidden" name="price" value="<?php echo $unit_price; ?>"/>
            <input type="hidden" name="name" value="<?php echo $name; ?>"/>
            <input type="hidden" name="thumb" value="<?php echo $thumb; ?>"/>


            <div class="form-item form-item-color"><label class="label">สี</label>
				<?php
				foreach ($avail_colors as $c => $cth)
				{
					$id = 'color-' . $c;
					echo '<input type="radio" id="' . $id . '" name="color"  value="' . $c . '"  /><label for="' . $id . '">' . $cth . '</label>';
				}
				?>
            </div>
            <div class="form-item form-item-size"><label class="label">ขนาด</label>
				<?php
				foreach ($avail_sizes as $s)
				{
					$id = 'size-' . $s;
					echo '<input type="radio" id="' . $id . '" name="size"  value="' . $s . '" /><label for="' . $id . '">' . $s . '</label>';
				}
				?>
            </div>

            <div class="form-item form-item-quantity"><label class="label">จำนวน</label>
				<?php
				for ($i = 1; $i <= 5; $i++)
				{
					$id = 'qty-' . $i;
					echo '<input type="radio" id="' . $id . '" name="qty"  value="' . $i . '" /><label for="' . $id . '">' . $i . '</label>';
				}
				?>

                &nbsp;&nbsp;ชิ้น
            </div>
            <div class="form-item form-item-buy-btn ui-corner-all button"><img src="<?php echo base_url(); ?>images/shopping-bag.png">ซื้อ</div>
        </form>
        <div class="pdesc"><?php echo $desc; ?></div>

		<?php like_btn(base_url().'index.php/product/detail/'.$product_id);?>

		<?php fb_comments(base_url().'index.php/product/detail/'.$product_id);?>
		<?php if($ajax):?>
		<script type="text/javascript">FB.XFBML.parse();</script>
		<?php endif;?>
    </div>
</div>
<div class="product-img-list">
	<?php
	if ($ajax == 'false'):
		for ($i = 0; $i < count($images); $i++):
			?> 
			<img class="ui-corner-all" src="<?php echo $images[$i]; ?>"/><br/>
			<?php
		endfor;
	endif;
	?>
</div>



<script type="text/javascript">
	$(function() {

		gallery('.product-detail .product-detail-gallery', 'img');

		$('.product-detail .buy-form .form-item-color input[type="radio"]:first').prop('checked', true);
		$('.product-detail .buy-form .form-item-size input[type="radio"]:first').prop('checked', true);
		$('.product-detail .buy-form .form-item-quantity input[type="radio"]:first').prop('checked', true);
		$('.product-detail .form-item-buy-btn').click(function() {
			$('.product-detail').waiting();
			$.post('<?php echo base_url() ?>index.php/shopping_bag/add',
					$('.product-detail .buy-form').serialize(),
					function(data) {
						$('.product-detail').waiting('done');
						notify('success', 'เพิ่มสินค้าเรียบร้อย', 'เพิ่มรายการสินค้าเรียบร้อยแล้วค่ะ สามารถเลือกซื้อสินค้าอื่นๆเพิ่มเติมได้เลยนะคะ หรือตรวจสอบรายการได้ที่เมนู Order ด้านขวานะคะ');
					}
			);
		});



		themeButton('.product-detail');
		$('.product-detail .form-item-size').buttonset();
		$('.product-detail .form-item-color').buttonset();
		$('.product-detail .form-item-quantity').buttonset();
//    $('.product-detail .form-item-quantity #custom-quantity').spinner({
//        min:1,
//        change: function( event, ui ) {
//            var spinner = $('.product-detail .form-item-quantity #custom-quantity');
//            var val = spinner.spinner('value');
//            if(val < 1)
//            {
//                val = 1;
//                spinner.spinner('value', 1);
//            }
//            $('.product-detail .form-item-quantity #qty-custom').attr('value', val);
//        }
//    });
	});
</script>
