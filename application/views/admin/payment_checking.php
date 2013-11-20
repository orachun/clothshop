<div class="payment-checking">
    <?php foreach ($orders as $o):?>
    <div class="item-container">
		<a href="<?php echo base_url().'index.php/order/display/'.$o['order_id'];?>" target="_blank">
			<?php echo $o['display_id'];?>
		</a>
		<br/>
		Status: <?php echo $o['status'];?><br/>
		<?php if($o['status'] == 'P'):?>
			Amount: <?php echo $o['payment']['amount'];?><br/>
			Informed Date: <?php echo $o['payment']['inform_date'];?><br/>
			Paid Date: <?php echo $o['payment']['paid_date'];?>
			<br/>
			<button class="checked-btn" orderid ="<?php echo $o['order_id'];?>">Checked</button>
		<?php elseif($o['status'] == 'C'):?>
			<input type="text" class="tracking-no" placeholder="tracking number"/><br/>
			<input type="text" class="delivered-date" placeholder="delivered date (yyyy-mm-dd)" />
			<br/>
			<button class="delivered-btn" orderid ="<?php echo $o['order_id'];?>">Delivered</button>
		<?php endif;?>
    </div>
    <?php endforeach;?>
</div>

<script>
    $(function(){
		
		$('.payment-checking .delivered-date').datepicker({ dateFormat: "yy-mm-dd" });
		
        $('.payment-checking .checked-btn').click(function(){
            $.post(base_url+'index.php/admin/order_set_checked', {order_id: $(this).attr('orderid')}, function(){
                $('.payment-checking').parent().load(base_url+'index.php/admin/payment_checking');
            });
        });
        $('.payment-checking .delivered-btn').click(function(){
            $.post(base_url+'index.php/admin/order_set_delivered', {
				order_id: $(this).attr('orderid'), 
				tracking_no:$(this).parent().find(".tracking-no").val(), 
				delivered_date:$(this).parent().find(".delivered-date").val() 
			}, function(){
                $('.payment-checking').parent().load(base_url+'index.php/admin/payment_checking');
            });
        });
    });
</script>