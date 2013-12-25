<?php echo doctype();?>
<html>
    <head>
        <meta http-equiv="content-Type" content="text/html; charset=utf-8">
        <style>
            body { font-size: 12px;}
			.item-container
			{
				margin: 0px 10px 10px 0px;
				border: solid 1px lightgray;
				padding: 5px;
				display: inline-block;
				vertical-align: top;
			}
			.item-container:hover
			{
				border-color: gray;
			}
			.disabled
			{
				background-color: lightgray;
				color: #999;
			}
			
			
			.admin-table
			{
				border-spacing:0;
				border-collapse:collapse;
				border: dashed 1px lightgray;
			}
			.admin-table thead
			{
				background-color: #C1E6E5;
			}
			.admin-table th,
			.admin-table td
			{
				text-align: center;
				padding: 5px 10px;
			}
			.admin-table tr.even
			{
				background-color: #ddd;
			}
			.admin-table tr.odd
			{
				background-color: #eee;
			}
			.admin-table tr:hover
			{
				background-color: #c8def4;
			}
			
        </style>
        <?php echo link_tag(base_url().'css/smoothness/jquery-ui-1.10.3.custom.css');?>
        <?php echo link_tag(base_url().'libs/jquery.waiting/waiting.css');?>
        <script src="<?php echo base_url(); ?>js/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.js"></script>
        <script src="<?php echo base_url();?>libs/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>js/upload.js"></script>
        <script src="<?php echo base_url(); ?>libs/jquery.waiting/jquery.waiting.js"></script>
        <script src="<?php echo base_url(); ?>libs/tinymce/tinymce.min.js"></script>
        <script src="<?php echo base_url(); ?>js/admin.js"></script>
        <script src="<?php echo base_url(); ?>js/other_functions.js"></script>
        <script type="text/javascript">
            base_url = '<?php echo base_url();?>';
            $(function(){
                $('#tabs').tabs();
            });
        </script>
    </head>
    <body>
		<?php fb_load_js_sdk(true);?>
		<a href="<?php echo base_url();?>">Home</a>
        <div id="tabs">
            <ul>
              <li><a href="<?php echo base_url(); ?>index.php/admin/supplier">Suppliers</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/category">Category</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/products">Product List</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/add_product_form">Add Product</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/store_order">Store Order</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/store_order_products">Store Order Products</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/delivering">Delivering</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/payment_checking">Customer Orders</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/slideshow">Main Slideshow</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/page">Page</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/coupon_list">Discount Coupons</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/customer">Customers</a></li>
            </ul>
        </div>
    </body>
</html>