<div class="product-detail product-detail-<?php echo $product_id; ?>">
    <div class="product-detail-gallery">
        <ul class="imagegallery">
            <?php for ($i = 0; $i < count($images); $i++): ?>
                <li><img height="460" class="ui-corner-all" src="<?php echo $images[$i]; ?>"/></li>
            <?php endfor; ?>
        </ul>
        <div id="bx-pager">
            <?php for ($i = 0; $i < count($images); $i++): ?>
                <a class="ui-corner-all" data-slide-index="<?php echo $i;?>" href=""><img width="50" src="<?php echo $images[$i]; ?>" /></a>
            <?php endfor; ?>
        </div>
    </div>
    <div class="product-detail-content">
        <div class="pname"><a href="<?php echo base_url();?>index.php/product/detail/<?php echo $product_id;?>" target="_blank"><?php echo $name; ?></a></div>
        
        <div>
            รหัส <span class="pcode"><?php echo $display_id; ?></span>
            ราคา <span class="pprize"><?php echo number_format($unit_price,2); ?> บาท</span>
        </div>

        <form class="buy-form ui-corner-all">
            <input type="hidden" name="pid" value="<?php echo $product_id; ?>"/>
            <input type="hidden" name="price" value="<?php echo $unit_price; ?>"/>
            <input type="hidden" name="name" value="<?php echo $name; ?>"/>
            <input type="hidden" name="thumb" value="<?php echo $thumb; ?>"/>


            <div class="form-item form-item-color"><label class="label">สี</label>
                <?php
                foreach ($avail_colors as $c)
                {
                    $id = 'color-'.$c;
                    echo '<input type="radio" id="'.$id.'" name="color"  value="' . $c . '"  /><label for="'.$id.'">' . th_color($c) . '</label>';
                }
                ?>
            </div>
            <div class="form-item form-item-size"><label class="label">ขนาด</label>
                <?php
                foreach ($avail_sizes as $s)
                {
                    $id = 'size-'.$s;
                    echo '<input type="radio" id="'.$id.'" name="size"  value="' . $s . '" /><label for="'.$id.'">' . $s . '</label>';
                }
                ?>
            </div>
            
            <div class="form-item form-item-quantity"><label class="label">จำนวน</label>
                <?php
                for ($i = 1; $i <= 3; $i++)
                {
                    $id = 'qty-'.$i;
                    echo '<input type="radio" id="'.$id.'" name="qty"  value="' . $i . '" /><label for="'.$id.'">' . $i . '</label>';
                    //echo '<label class="radio-item"><input name="qty" type="radio" value="' . $i . '"/>' . $i . '</label>';
                }
                ?>
                
                <input id="qty-custom" name="qty" type="radio" value="4"/>
                <label for="qty-custom">
                    <input class="quantity" id="custom-quantity" type="text" name="quantity" value="4" />
                </label>
                &nbsp;&nbsp;ชิ้น
            </div>
            <div class="form-item form-item-buy-btn ui-corner-all button"><img src="<?php echo base_url(); ?>images/shopping-bag.png">ซื้อ</div>
        </form>
        <div class="pdesc"><?php echo $desc; ?></div>
        
        
        
    </div>
</div>
<div class="product-img-list">
<?php
if ($ajax == 'false'):
    for ($i = 0; $i < count($images); $i++):
        ?> 
        <img class="ui-corner-all" src="<?php echo $images[$i]; ?>"/><br/>
        <?php
    endfor;
endif;
?>
</div>

<script type="text/javascript">
    $(function() {
//        $('.product-detail-<?php echo $product_id; ?> .product-detail-gallery .image-gallery').PikaChoose(
//                {
//                    transition: [1],
//                    carousel: true,
//                    autoPlay: false,
//                    showCaption: false,
//                    carouselOptions: {wrap: 'circular'},
//                    thumbOpacity: 1.0
//                }
//        );
        $('.product-detail .product-detail-gallery .imagegallery').bxSlider({
            pagerCustom: '#bx-pager'
         });
         

//        $('.product-detail .form-item-buy-btn').click(function() {
//            if (!$(".opening-tab").is(".shopping-bag-summary-tab"))
//            {
//                closeTab($(".opening-tab"));
//            }
//            openTab($(".shopping-bag-summary-tab"));
//        });

        $('.product-detail .buy-form .form-item-color input[type="radio"]:first').prop('checked', true);
        $('.product-detail .buy-form .form-item-size input[type="radio"]:first').prop('checked', true);
        $('.product-detail .buy-form .form-item-quantity input[type="radio"]:first').prop('checked', true);
        $('.product-detail .form-item-buy-btn').click(function() {
            $('.product-detail').waiting();
            $.post('<?php echo base_url() ?>index.php/shopping_bag/add',
                    $('.product-detail .buy-form').serialize(),
                    function(data) {
                        $('.product-detail').waiting('done');
                            notify('success', 'เพิ่มสินค้าเรียบร้อย', 'เพิ่มรายการสินค้าเรียบร้อยแล้วค่ะ สามารถเลือกซื้อสินค้าอื่นๆเพิ่มเติมได้เลยนะคะ หรือตรวจสอบรายการได้ที่เมนู Order ด้านขวานะคะ');
                    }
            );
        });
        
        
    
    themeButton('.product-detail');
    $('.product-detail .form-item-size').buttonset();
    $('.product-detail .form-item-color').buttonset();
    $('.product-detail .form-item-quantity').buttonset();
    $('.product-detail .form-item-quantity #custom-quantity').spinner({
        min:1,
        change: function( event, ui ) {
            var spinner = $('.product-detail .form-item-quantity #custom-quantity');
            var val = spinner.spinner('value');
            if(val < 1)
            {
                val = 1;
                spinner.spinner('value', 1);
            }
            $('.product-detail .form-item-quantity #qty-custom').attr('value', val);
        }
    });
    });
</script>
