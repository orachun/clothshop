<style>
    .order-info,
    .order-info table
    {
        font-family: Tahoma;
        font-size: 12px;
    }
    .order-info .logo-section
    {
        text-align: center;
    }
    .order-info .logo-section img 
    {
        border-radius: 4px
    }
    .order-info .label
    {
        width: 120px;
        display: inline-block;
    }
    .order-info .section-header
    {
        margin: 15px 0px;
        font-weight: bold;
        width: 150px;
        display: inline-block;
    }
    .order-info .order-info-section,
    .order-info .receiver-info-section
    {
        display: inline-block;
        width: 45%;
        vertical-align: top;
        margin-right: 40px;
    }
    .order-info .order-info-section { margin-right: 10px; }
    .ordered-item-section table, 
    .ordered-item-section table td,
    .ordered-item-section table th
    {
		margin: 0px;
        text-align: center;
    }
	
	.ordered-item-section table, 
    .ordered-item-section table th
	{
        border-bottom: solid 1px lightgray;
	}
	
    .ordered-item-section table {width: 100%;}
    .ordered-item-section table .name
    {
        text-align: left;
    }
    .ordered-item-section table .qty,
    .ordered-item-section table .unit-price,
    .ordered-item-section table .sub-total
    {
        text-align: right;
    }
</style>

<div class="order-info">
    <div class="logo-section">
        <img src="<?php echo base_url();?>images/banner.png" height="40"/>
    </div>
    <div class="order-info-section">
        <div class="section-header">ข้อมูลการสั่งซื้อ</div>
        <div><label class="label">เลขที่ใบสั่งซื้อ: </label><?php echo $display_id;?></div>
        <div><label class="label">วันที่สั่งซื้อ: </label><?php echo $ordered_datetime;?></div>
        <div><label class="label">สถานะ: </label><?php echo order_status($status);?></div>
        <div><label class="label">วันที่จัดส่งสินค้า: </label><?php echo empty($delivered_date)?'-': $delivered_date;?></div>
        <div><label class="label">เลขพัสดุ: </label><?php echo empty($tracking_no)?'-': $tracking_no;?></div>
    </div>
    <div class="receiver-info-section">
        <div class="section-header">ข้อมูลผู้รับสินค้า</div>
        <div><label class="label">ชื้อผู้รับ: </label><?php echo $receiver_name;?></div>
        <div><label class="label">ที่อยู่ผู้รับ: </label><?php echo $delivery_addr;?></div>
        <div><label class="label">โทร.: </label><?php echo $tel;?></div>
        <div><label class="label">อีเมล์: </label><?php echo $email;?></div>
    </div>
    <div class="ordered-item-section">
        <div class="section-header">รายการสินค้า</div>
        <?php echo $items;?>
        <span class="section-header">รวม: </span>
        <?php echo number_format($total_before_discount, 2);?> บาท
    </div>
    <div class="selected-coupon-section">
        <span class="section-header">คูปองส่วนลด: </span>
        <div class="coupon-detail">
            <?php echo $coupon['name']; ?>: <?php echo $coupon['desc'];?><br/>
            ส่วนลด <?php echo number_format($coupon['discount'], 2); ?> บาท
            คงเหลือ <?php echo number_format($coupon['amount_remain'], 2); ?> บาท<br/>
        </div>
    </div>
    <div class="selected-deliver-section">
        <span class="section-header">วิธีการจัดส่งสินค้า: </span>
        <span>
            <?php echo $delivering['name']; ?> ค่าจัดส่งทั้งหมด <?php echo sprintf("%.2f", $delivering['cost']); ?> บาท (ค่าจัดส่งชิ้นละ <?php echo number_format($delivering['unit_cost'],2); ?> บาท 
                <?php
                if ($delivering['free_threshold'] < 100)
                {
                    echo 'สั่งซื้อสินค้า ' . $delivering['free_threshold'] . ' ชิ้นขึ้นไป ส่งฟรี!';
                }
                ?>
        </span>
    </div>
    <div class="net-total-section">
        <span class="section-header">รวมทั้งสิ้น: </span>
        <?php echo number_format($net_total, 2);?> บาท
    </div>
	
	<div>สามารถดูได้ที่ <a href="<?php echo base_url().'index.php/order/display/'.$order_id;?>" target="_blank"><?php echo base_url().'index.php/order/display/'.$order_id;?></a></div>
</div>
