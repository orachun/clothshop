<?php echo doctype(); ?>
<html>

    <!------------------------------HEADER----------------------------------------->
    <head>
        <meta http-equiv="content-Type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico?dummy=dummy"> 
        <script type="text/javascript">
			base_url = "<?php echo base_url(); ?>";
<?php
foreach (___config() as $k => $v)
{
	echo $k . '=' . '"' . $v . '";';
}
?>
        </script>  
        <title>Prittila: pre-order ชุดสไตล์เกาหลีน่ารักๆ - <?php echo $title ?></title>
		<?php echo link_tag(base_url() . 'css/custom-theme/jquery-ui-1.10.3.custom.min.css'); ?>

        <script src="<?php echo base_url(); ?>js/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
        <script src="<?php echo base_url(); ?>js/additional-methods.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.pnotify.js"></script>
        <script src="<?php echo base_url(); ?>libs/jquery.waiting/jquery.waiting.js"></script>
        <script src="<?php echo base_url(); ?>js/thumb_slider.js"></script>
        <script src="<?php echo base_url(); ?>libs/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>js/template.js"></script>
        <script src="<?php echo base_url(); ?>js/upload.js"></script>
        <script src="<?php echo base_url(); ?>js/product_grid_item.js"></script>

		<?php echo link_tag(base_url() . 'css/template.css'); ?>
		<?php echo link_tag(base_url() . 'css/right-tab.css'); ?>
		<?php echo link_tag(base_url() . 'css/form.css'); ?>
		<?php echo link_tag(base_url() . 'css/jquery.pnotify.default.css'); ?>
		<?php echo link_tag(base_url() . 'libs/jquery.waiting/waiting.css'); ?>
		<?php echo link_tag(base_url() . 'css/thumb_slider.css'); ?>


        <script src="<?php echo base_url(); ?>libs/bxslider/jquery.bxslider.min.js"></script>
        <link href="<?php echo base_url(); ?>libs/bxslider/jquery.bxslider.css" rel="stylesheet" />


		<?php
		if (isset($_js)):
			foreach ($_js as $j):
				?>
				<script src="<?php echo base_url() . 'js/' . $j . '.js'; ?>" type="text/javascript"></script>
				<?php
			endforeach;
		endif;
		?>
		<?php
		if (isset($_css)):
			foreach ($_css as $c):
				?>
				<link href="<?php echo base_url() . 'css/' . $c . '.css'; ?>" type="text/css" rel="stylesheet" />
				<?php
			endforeach;
		endif;
		?>



    </head>
    <!------------------------------END HEADER----------------------------------------->

    <body>
        <!-------------------------------BODY------------------------------------------>

        <div id="topbar">
            <div id="logo-container">
                <a href="<?php echo base_url() ?>index.php" title="หน้าแรก">
					*PRITTILA*
                </a>
            </div>
            <div id="search-tools" class="ui-corner-right">
                <select id="product-cat" class="button ui-corner-all">
                    <option value="-1">หมวดหมู่สินค้า</option>
                </select>
                <input id="search-box" class="ui-corner-all" type="text"/><span id="search-btn" class="button ui-corner-all">ค้นหา</span>
                <script type="text/javascript">
					$.get(base_url + 'index.php/product/category_options', function(data) {
						$('#topbar #product-cat').append(data);
						//                    $('#topbar #product-cat').ddslick();
					});
                </script>
            </div>
        </div>


        <div id="body">
            <div id="content">
				<?php echo $contents; ?>
            </div>
        </div>
        <div id="footer">
			<?php if (!empty($footer)) echo $footer; ?>
        </div>
        <!-------------------------------END BODY------------------------------------------>


        <!-------------------------------Right Tabs------------------------------------------>
        <div class="user-tab right-tab">
            <div class="handle ui-corner-left button" title="บัญชีลูกค้า">
                <img src="<?php echo base_url(); ?>images/user.png"/>
                <br/>Account
            </div>
            <div class="right-tab-content-container ui-corner-left">
                <div class="right-tab-content" url="<?php echo base_url(); ?>index.php/user/tab_content">

                </div>
            </div>
        </div>
        <div class="shopping-bag-summary-tab right-tab">
            <div class="handle ui-corner-left button" title="สินค้าที่เลือก">
                <img src="<?php echo base_url(); ?>images/shopping-bag.png"/>
                <br/>Order
            </div>
            <div class="right-tab-content-container ui-corner-left">
                <div class="right-tab-content" url="<?php echo base_url(); ?>index.php/shopping_bag/tab_content">

                </div>
            </div>
        </div>
        <div class="buy-info-tab right-tab">
            <div class="handle ui-corner-left button" title="วิธีการสั่งซื้อและชำระเงิน">
                <img src="<?php echo base_url(); ?>images/info.png"/>
                <br/>Buy Info
            </div>
            <div class="right-tab-content-container ui-corner-left">
                <div class="right-tab-content">
                    <h1>วิธีการสั่งซื้อและชำระเงิน</h1>
                    <a href="<?php echo base_url()?>index.php/page/content/conditions" target="_blank"><span class="button ui-corner-all">ข้อตกลงและเงื่อนไขการซื้อสินค้า</span></a>
                    <a href="<?php echo base_url()?>index.php/page/content/order_info" target="_blank"><span class="button ui-corner-all">วิธีการสั่งซื้อและชำระเงิน</span></a>
                    <a href="<?php echo base_url()?>index.php/page/content/payment_info" target="_blank"><span class="button ui-corner-all">รายละเอียดการชำระเงิน</span></a>
                </div>
            </div>
        </div>
        <div class="payment-transfer-tab right-tab">
            <div class="handle ui-corner-left button" title="แจ้งชำระเงิน">
                <img src="<?php echo base_url(); ?>images/cash.png"/>
                <br/>Payment
            </div>
            <div class="right-tab-content-container ui-corner-left">
                <div class="right-tab-content">
                    <h1>แจ้งชำระเงิน</h1>
                    <form class="payment-inform-form">
                        <div><label class="label">เลขที่ใบสั่งซื้อ</label><input name="order-id" type="text"/></div>
                        <div><label class="label">วันที่ชำระ</label>
                            <select name="paid_day">
								<?php for ($i = 1; $i <= 31; $i++)
									echo '<option vlaue="' . $i . '">' . $i . '</option>'; ?>
                            </select>/
                            <select name="paid_month">
<?php for ($i = 1; $i <= 12; $i++)
	echo '<option vlaue="' . $i . '">' . $i . '</option>'; ?>
                            </select>/
                            <select name="paid_year">
<?php for ($i = date('Y') + 542; $i <= date('Y') + 543; $i++)
	echo '<option vlaue="' . $i . '">' . $i . '</option>'; ?>
                            </select>
                        </div>
                        <div>
							<label class="label">เวลาที่ชำระ</label>
                            <select name="paid_hr">
								<?php for ($i = 0; $i <= 23; $i++)
									echo '<option vlaue="' . $i . '">' . $i . '</option>'; ?>
                            </select>:
                            <select name="paid_min">
<?php for ($i = 0; $i <= 59; $i++)
	echo '<option vlaue="' . $i . '">' . $i . '</option>'; ?>
                            </select> น.
                        </div>
                        <div>
							<label class="label">จำนวนเงิน</label>
							<input name="paid_amount" type="text"/>
						</div>
                        <input type="hidden" name="name" value=""/>
                        <div class="uploader"></div>
                        <span class="button ui-corner-all payment-inform-btn">แจ้งชำระเงิน</span>
                    </form>
                    <script>
						$('.payment-transfer-tab .payment-inform-form select[name="paid_day"]').val(<?php echo date('d'); ?>);
						$('.payment-transfer-tab .payment-inform-form select[name="paid_month"]').val(<?php echo date('m'); ?>);
						$('.payment-transfer-tab .payment-inform-form select[name="paid_year"]').val(<?php echo date('Y') + 543; ?>);
						$('.payment-transfer-tab .payment-inform-form select[name="paid_hr"]').val(<?php echo date('H'); ?>);
						$('.payment-transfer-tab .payment-inform-form select[name="paid_min"]').val(<?php echo date('i'); ?>);
						ajax_upload_form('.payment-transfer-tab .payment-inform-form .uploader', '.payment-transfer-tab .payment-inform-form input[name="name"]', 'เลือกไฟล์สลิปโอนเงิน');

						$('.payment-transfer-tab .payment-inform-form .payment-inform-btn').click(function() {
							$('.payment-transfer-tab').waiting();
							$.post(base_url + 'index.php/order/payment_inform',
									$('.payment-transfer-tab .payment-inform-form').serialize(), function(data) {
								if (data == 'ok')
								{
									notify('success', 'แจ้งชำระเงิน', 'แจ้งชำระเงินเรียบร้อยค่ะ');
								}
								else
								{
									notify('error', 'ไม่สามารถแจ้งชำระเงินได้', data);
								}
								$('.payment-transfer-tab').waiting('done');
							});
						});
                    </script>
                </div>
            </div>
        </div>
        <div class="contact-us-tab right-tab">
            <div class="handle ui-corner-left button" title="ติดต่อเรา">
                <img src="<?php echo base_url(); ?>images/contact-us.png"/>
                <br/>Contact
            </div>
            <div class="right-tab-content-container ui-corner-left">
                <div class="right-tab-content" url="<?php echo base_url(); ?>index.php/others/contact_us_form">

                </div>
            </div>
        </div>
        <!-------------------------------END Right Tabs------------------------------------------>


        <!-------------------------------Hidden Modal------------------------------------------>
        <div id="order-modal" class="modal-dialog" title="สั่งซื้อสินค้า"></div>
        <!-------------------------------End Hidden Modal------------------------------------------>





        <div class="bottom-bar">
            
            <img class="icon" src="<?php echo base_url(); ?>images/icons/mobile.png"/>: 0123456789
            <img class="icon" src="<?php echo base_url(); ?>images/icons/email.png"/>: a@a.com
            <img class="icon" src="<?php echo base_url(); ?>images/icons/facebook.png"/>: <a href="http://www.facebook.com/page" target="_blank">http://www.facebook.com/page</a>
            <img class="icon" src="<?php echo base_url(); ?>images/icons/line.png"/>: ___aaa
        </div>

        <script type="text/javascript">
//           if (!NREUMQ.f) {
//                NREUMQ.f = function() {
//                    NREUMQ.push(["load", new Date().getTime()]);
//                    var e = document.createElement("script");
//                    e.type = "text/javascript";
//                    e.src = (("http:" === document.location.protocol) ? "http:" : "https:") + "//" + "rpm-images.newrelic.com/42/eum/rum.js";
//                    document.body.appendChild(e);
//                    if (NREUMQ.a)
//                        NREUMQ.a();
//                };
//                NREUMQ.a = window.onload;
//                window.onload = NREUMQ.f;
//            }
//            ;
//            NREUMQ.push(["nrfj", "beacon-3.newrelic.com", "eb488e72a1", "2281554", "NgEEZBYHDUFWVk0KWg9LJUUXEgxfGFZWB1AIAwhZEAMRHUJGXBEYBhEPVAE=", 0, 26, new Date().getTime(), "", "", "", "", ""]);
        </script>
    </body>
</html>

