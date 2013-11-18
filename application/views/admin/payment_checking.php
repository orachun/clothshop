<div class="payment-checking">
    <?php foreach ($orders as $o):?>
    <div><a href="<?php echo base_url().'index.php/order/display/'.$o['order_id'];?>" target="_blank"><?php echo $o['display_id'];?></a> Status: <?php echo $o['status'];?>
    <?php if($o['status'] == 'P'):?>
		Amount: <?php echo $o['payment']['amount'];?>
		Informed Date: <?php echo $o['payment']['inform_date'];?>
		Paid Date: <?php echo $o['payment']['paid_date'];?>
        <button class="checked-btn" orderid ="<?php echo $o['order_id'];?>">Checked</button>
    <?php endif;?>
    <?php if($o['status'] == 'C'):?>
		<input type="text" class="tracking-no" placeholder="tracking number"/>
		<input type="text" class="delivered-date" placeholder="delivered date (yyyy-mm-dd)" />
        <button class="delivered-btn" orderid ="<?php echo $o['order_id'];?>">Delivered</button>
    <?php endif;?>
    </div>
    <?php endforeach;?>
</div>

<script>
    $(function(){
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