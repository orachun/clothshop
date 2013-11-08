<?php echo doctype();?>
<html>
    <head>
        <style>
            body { font-size: 12px;}
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
        <script type="text/javascript">
            base_url = '<?php echo base_url();?>';
            $(function(){
                $('#tabs').tabs();
            });
        </script>
    </head>
    <body>
        <div id="tabs">
            <ul>
              <li><a href="<?php echo base_url(); ?>index.php/admin/supplier">Suppliers</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/category">Category</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/add_product_form">Add Product</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/store_order">Store Order</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/delivering">Delivering</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/payment_checking">Payment Checking</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/slideshow">Main Slideshow</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/page">Page</a></li>
            </ul>
        </div>
    </body>
</html>