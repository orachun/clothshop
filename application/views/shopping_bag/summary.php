<div class="shopping-bag-summary">
	<h1>สินค้าที่เลือก</h1>
<div class="total">
    <a href="<?php echo base_url();?>index.php/shopping_bag/order_review" class="button order-btn ui-corner-all" target="_blank">ส่งคำสั่งซื้อสินค้า</a><br/>
    รวม <?php echo number_format($this->cart->total(),2); ?> บาท
</div>

<?php foreach ($this->cart->contents() as $items): ?>
	<div class="selected-item" rowid="<?php echo $items['rowid']?>">
		<img src="<?php $options = $this->cart->product_options($items['rowid']); echo $options['thumb'];?>"/> 
		<div class="detail">
            <a href="<?php echo base_url().'index.php/product/detail/'.$options['pid'];?>" target="_blank"><?php echo $options['name'];?></a><br/>
            <label class="label">ขนาด</label> <?php echo $options['size'];?> 
            <label class="label">สี</label> <?php echo th_color($options['color']);?><br/>
            <label class="label">จำนวน</label> <input id="qty" type="text" name="qty" value="<?php echo $items['qty'];?>"/> x <?php echo $this->cart->format_number($items['price']);?> บาท<br/>
            <button class="btn edit-btn" title="แก้ไขจำนวน"></button>
            <button class="btn del-btn" title="ลบ"></button>
        </div>
	</div>
<?php endforeach;?>
<div class="total">
    <a href="<?php echo base_url();?>index.php/shopping_bag/order_review" class="button order-btn ui-corner-all" target="_blank">ส่งคำสั่งซื้อสินค้า</a><br/>
    รวม <?php echo number_format($this->cart->total(),2); ?> บาท
</div>
</div>

<script type="text/javascript">
    $( ".shopping-bag-summary .del-btn" ).button({
      icons: {
        primary: "ui-icon-closethick"
      },
      text: false
    })
    $( ".shopping-bag-summary .edit-btn" ).button({
      icons: {
        primary: "ui-icon-pencil"
      },
      text: false
    })
    
    $( ".shopping-bag-summary .del-btn" ).click(function(){
        $( ".shopping-bag-summary").parent().waiting();
        var rowid = $(this).parents(".selected-item").attr('rowid');
        $.post(base_url+'index.php/shopping_bag/update_qty/'+rowid+'/0', function(e){
            reloadTab($('.shopping-bag-summary-tab'));
            $( ".shopping-bag-summary").parent().waiting('done');
            notify('success','ลบสินค้า', 'ลบสินค้าที่เลือกเรียบร้อยค่ะ');
        });
    });
    $( ".shopping-bag-summary .edit-btn" ).click(function(){
        $( ".shopping-bag-summary").parent().waiting();
        var rowid = $(this).parents(".selected-item").attr('rowid');
        var qty = $(this).parents(".selected-item").find('#qty').val();
        $.post(base_url+'index.php/shopping_bag/update_qty/'+rowid+'/'+qty, function(e){
            reloadTab($('.shopping-bag-summary-tab'));
            $( ".shopping-bag-summary").parent().waiting('done');
            notify('success','แก้ไขสินค้า', 'แก้ไขจำนวนสินค้าที่เลือกเรียบร้อยค่ะ');
        });
    });
    
//    $(".shopping-bag-summary .order-btn").click(function(e){
//        e.preventDefault();
//        $(".shopping-bag-summary").parent().waiting({fixed:true});
//        $( "#order-modal" ).load(base_url+'index.php/shopping_bag/order_review/ajax', function(){
//            $('#order-modal').dialog( "option", "position", { my: "center", at: "center", of: window } );
//            $( "#order-modal" ).dialog( "open" );
//            closeTab($('.opening-tab'));
//            $(".shopping-bag-summary").parent().waiting('done');
//        });
//    });
    
    themeButton('.shopping-bag-summary');
</script>