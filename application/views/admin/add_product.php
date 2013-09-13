<style>
    .add-product textarea{width: 80%; height: 130px; display: block;}
</style>

<div class="add-product">
    <form>
        Name: <input type="text" name="name"/><br/>
        Desc: <textarea name="desc"></textarea><br/>
        Cost Unit price: <input type="text" name="cost"/> 
        Selling Unit price: <input type="text" name="unit_price"/> 
        Category:
        <select name="cat_id">
        <?php foreach($cats as $c):?>
        <option value="<?php echo $c->product_cat_id;?>"><?php echo $c->name;?></option>
        <?php endforeach;?>
        </select>
        <div>Size</div>
        <label><input name="size" type="checkbox" value="R"/>Regular</label>
        <label><input name="size" type="checkbox" value="S"/>S</label>
        <label><input name="size" type="checkbox" value="M"/>M</label>
        <label><input name="size" type="checkbox" value="L"/>L</label>
        <label><input name="size" type="checkbox" value="XL"/>XL</label>
        <label><input name="size" type="checkbox" value="XXL"/>XXL</label>
        <div>Color</div>
        <label><input name="color" type="checkbox" value="red"/>แดง</label>
        <label><input name="color" type="checkbox" value="green"/>เขียว</label>
        <label><input name="color" type="checkbox" value="blue"/>น้ำเงิน</label>
        <label><input name="color" type="checkbox" value="lightblue"/>ฟ้า</label>
        <label><input name="color" type="checkbox" value="orange"/>ส้ม</label>
        <label><input name="color" type="checkbox" value="purple"/>ม่วง</label>
        <label><input name="color" type="checkbox" value="white"/>ขาว</label>
        <label><input name="color" type="checkbox" value="black"/>ดำ</label>
        <label><input name="color" type="checkbox" value="gray"/>เทา</label>
        <label><input name="color" type="checkbox" value="pink"/>ชมพู</label>
        <label><input name="color" type="checkbox" value="brown"/>น้ำตาล</label>
        <div>Supplier</div>
        <select name="supplier">
            <?php foreach($suppliers as $c):?>
            <option value="<?php echo $c->supplier_id;?>"><?php echo $c->name;?></option>
            <?php endforeach;?>
        </select>
        Product Code: <input type="text" name="supplier_product_code"/><br/>
        Image URLs: <textarea name="imgs"></textarea><br/>
        <div><input class="submit-btn" type="button" value="Submit"/></div>
    </form>
</div>

<script type="text/javascript">
    $('.add-product .submit-btn').click(function(){
        
        var size = '';
        $('.add-product input[name="size"]:checked').each(function(index, element){
            size += $(element).val()+";";
        });
        var color = '';
        $('.add-product input[name="color"]:checked').each(function(index, element){
            color += $(element).val()+";";
        });
        $.post(base_url+'index.php/admin/add_product_submit', $('.add-product form').serialize()+"&color="+color+"&size="+size, function(data){
            $('.add-product').parent().load(base_url+'index.php/admin/add_product_form');
        });
    });
</script>