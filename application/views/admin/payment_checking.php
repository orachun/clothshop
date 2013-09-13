<div class="payment-checking">
    <?php foreach ($orders as $o):?>
    <div><a href="<?php echo base_url().'index.php/order/display/'.$o['order_id'];?>" target="_blank"><?php echo $o['display_id'];?></a> Status: <?php echo $o['status'];?>
    <?php if($o['status'] == 'P'):?>
        <button class="checked-btn" orderid ="<?php echo $o['order_id'];?>">Checked</button>
    <?php endif;?>
    <?php if($o['status'] == 'C'):?>
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
            $.post(base_url+'index.php/admin/order_set_delivered', {order_id: $(this).attr('orderid')}, function(){
                $('.payment-checking').parent().load(base_url+'index.php/admin/payment_checking');
            });
        });
    });
</script>