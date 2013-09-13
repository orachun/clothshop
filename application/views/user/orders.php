<div class="customer-orders">
    <table class="orders-table">
        <thead>
        <th>เลขที่ใบสั่งซื้อ</th>
        <th>วัน-เวลาที่สั่งซื้อ</th>
        <th>ราคาทั้งสิ้น</th>
        <th>สถานะ</th>
        <th>วันที่แจ้งชำระเงิน</th>
        <th>วันที่จัดส่งสินค้า</th>
        <th>หมายเลขพัสดุ</th>
        <th>แจ้งชำระเงิน</th>
        </thead>
    <?php foreach($orders as $o):?>
        <tr>
            <td><a href="<?php echo base_url().'index.php/order/display/'.$o['order_id'];?>" target="_blank"><?php echo $o['display_id'];?></a></td>
            <td><?php echo thai_datetime($o['ordered_datetime'], '<br/>');?></td>
            <td><?php echo number_format($o['net_total'], 2);?></td>
            <td><?php echo order_status($o['status']);?></td>
            <td><?php echo empty($o['paid_date']) ? '-' : thai_datetime($o['paid_date'], '<br/>');?></td>
            <td><?php echo empty($o['delivered_date']) ? '-' : thai_datetime($o['delivered_date']);?></td>
            <td><?php echo empty($o['tracking_no']) ? '-' : $o['tracking_no'];?></td>
            <td>
                <?php if($o['status'] == 'W' || $o['status'] == 'P'):?>
                <span class="button ui-corner-all payment-inform-btn" orderid="<?php echo $o['display_id'];?>">
                    แจ้งชำระเงิน
                </span>
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach;?>
    </table>
</div>

<script type="text/javascript">
    $(function(){
        $('.customer-orders .payment-inform-btn').click(function(){
            $('.payment-transfer-tab input[name="order-id"]').val($(this).attr("orderid"));
            openTab($('.payment-transfer-tab'));
        });
    });
    themeButton('.customer-orders');
</script>