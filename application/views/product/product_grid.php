<style>
    .main-product-grid {margin: 50px 0px 20px;
		border-top: dashed 2px rgba(197, 165, 176, 0.8);}
	
</style>

<?php echo $best_seller; ?>
<?php echo $most_viewed; ?>

<div class="product-grid main-product-grid">
    <div>
        <div class="pager-container"><?php echo $pager;?></div>
        <div class="ordering-container">
            เรียงลำดับ
            <select id="order-by" class="button  ui-corner-all">
                <option value="name">ชื่อสินค้า</option>
                <option value="product_id">วันที่มาใหม่</option>
                <option value="unit_price">ราคา</option>
                <option value="views">จำนวนคนดู</option>
            </select>
            <select id="order-type" class="button ui-corner-all">
                <option value="desc">มากไปน้อย</option>
                <option value="asc">น้อยไปมาก</option>
            </select>
            <span class="button ui-corner-all ordering-btn">GO</span>
        </div>
    </div>
    <div class="product-grid-row">
    <?php
    $i=0;
    foreach ($products as $p)
    {
        echo $p;
        $i++;
        if($i%___config('items_per_row')==0)
        {
            echo '</div><div class="product-grid-row">';
        }
    }
    ?>
    </div>
</div>


<?php echo $random_products;?>

<script type="text/javascript">
    $(function(){
        $('.product-grid #order-by').val('<?php echo $args['sort']; ?>');
        $('.product-grid #order-type').val('<?php echo $args['sort_order']; ?>');

        $('.product-grid .ordering-container .ordering-btn').click(function(){
            var orderyby = $('.product-grid .ordering-container #order-by').val();
            var ordertype = $('.product-grid .ordering-container #order-type').val();
            window.location.href = base_url+'index.php/product/index/<?php echo $args['cat'];?>/'
                    +orderyby+'/'+ordertype+'/<?php echo $args['keyword'];?>';
        });
        themeButton('.product-grid');
    });
</script>
