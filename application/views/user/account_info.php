<style>
    .account-info
    {
        text-align: center;
    }
    .account-info .coupon-icon
    {
        height: 30px;
        vertical-align: middle;
    }
    .account-info .coupon-icon-container
    {
        width: 100px;
        display: inline-block;
        text-align: center;
        border: solid 1px lightgray;
        background-color: white;
    }
    .account-info .coupon
    {
        margin: 0px 0px 5px 0px;
    }
    
    .account-info .button
    {
        width: 150px;
        text-align: center;
    }
    
    .account-info .section-header
    {
        font-size: 1.1em;
        margin-top: 10px;
    }
</style>
<div class="account-info">
	<h1>ยินดีต้อนรับ<br/>คุณ <?php echo $fullname;?></h1>
    
    <div>
    <a class="button ui-corner-all" href="<?php echo base_url();?>index.php/user/user_area/0" target="_blank">ข้อมูลส่วนตัว</a><br/>
    <a class="button ui-corner-all" href="<?php echo base_url();?>index.php/user/user_area/1" target="_blank">รายละเอียดคูปองส่วนลด</a><br/>
    <a class="button ui-corner-all" href="<?php echo base_url();?>index.php/user/user_area/2" target="_blank">สถานะการสั่งซื้อสินค้า</a><br/>
    <span class="logout-btn button ui-corner-all">ลงชื่อออก</span>

	<div class="section-header">คูปองส่วนลดที่มีอยู่</div>

	<?php if (count($coupons) > 0):
		foreach ($coupons as $c):
			?>
			<div class="coupon">
			<?php echo $c['coupon_left']; ?> x <div class="coupon-icon-container ui-corner-all"  title="<?php echo $c['summary']; ?>"><img class="coupon-icon ui-corner-all" src="<?php echo $c['icon']; ?>"/></div>
			</div>
		<?php endforeach;
	else:
		?>
		<div>ไม่มีคูปองที่ใช้ได้</div>
	<?php endif; ?>
    </div>
    
</div>

<script type="text/javascript">
    $('.account-info .logout-btn').click(function(){ 
        $('.account-info').parent().waiting();
        $.post('<?php echo base_url();?>index.php/user/logout', 
			function (data) {
                reloadTab($('.user-tab'));
                $('.user-tab').trigger('onlogout');
                
                $('.account-info').parent().waiting('done');
                notify('success', 'ออกจากระบบ', 'ออกจากระบบเรียบร้อยค่ะ');
            }
        );
    });
    themeButton('.account-info');
</script>