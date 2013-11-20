<div class="coupon-list">
	<?php foreach($coupons as $c):?>
	<div class="coupon item-container" cid="<?php echo $c['coupon_id'];?>">
		<div>Name: <?php echo $c['name'];?> (<?php echo $c['status'];?>)</div>
		<div>Desc: <?php echo $c['desc'];?></div>
		<div>Discount type: <?php echo $c['discount_type'];?></div>
		<div>Amount: <?php echo $c['amount'];?> Baht</div>
		<div>Amount threshold: <?php echo $c['amount_threshold'];?> Baht</div>
		<div>Valid days: <?php echo $c['valid_day'];?></div>
		<?php if($c['status'] == 'A'):?>
			<button class="set-status-btn" status="I">Deactivate</button>
		<?php else:?>
			<button class="set-status-btn" status="A">Activate</button>
		<?php endif;?>
	</div>
	<?php endforeach;?>
	
	<form class="add-coupon-form item-container">
		<div>Name: <input type="text" name="name"/></div>
		<div>Desc: <br/><textarea name="desc" style="width: 50%; height: 100px;"></textarea></div>
		<div>Discount type: 
			<select name="discount_type">
				<option value="P">Percentage</option>
				<option value="F">Fixed amount</option>
			</select>
			Amount (Baht): <input type="text" name="amount"/>
			Amount threshold (Baht): <input type="text" name="amount_threshold"/>
		<div>Valid days: <input type="text" name="valid_day"/></div>
		</div>
		<input type="submit"/>
	</form>
</div>

<script type="text/javascript">
	var reload = function()
	{
		$('.coupon-list').parent().load(base_url+'index.php/admin/coupon_list');
	};
	$(function(){

		$('.coupon-list .add-coupon-form').submit(function(){
			$('.coupon-list').waiting();
			$.post(base_url+'index.php/admin/add_coupon', $(this).serialize(), reload);
			return false;
		});

		$('.coupon-list .set-status-btn').click(function(){
			var statusText = $(this).html();
			if(confirm(statusText + " the coupon?"))
			{
				var id = $(this).parent().attr('cid');
				var status = $(this).attr('status');
				$('.coupon-list').waiting();
				$.post(base_url+'index.php/admin/set_coupon_status', 
					{'coupon_id':id, 'status':status}, 
					reload);
			}
		});
	});
</script>