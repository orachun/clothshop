<div class="store-order">
    <?php foreach($orders as $c)
    {
        echo '<div>
            <button class="del_btn" sid="'.$c->store_order_id.'">Del</button> 
            <button class="open_btn" sid="'.$c->store_order_id.'">Set Open</button> 
            <button class="close_btn" sid="'.$c->store_order_id.'">Set Close</button> 
            <button class="deliver_btn" sid="'.$c->store_order_id.'">Set Deliver</button> 
            <button class="future_btn" sid="'.$c->store_order_id.'">Set Future</button> 
            '.$c->store_order_id.': '.$c->close_date.'('.$c->status.')'.'</div>';
    }
    ?>
    <div class="add">
        Close Date: <input name="date"/> <button class="add_btn">Add</button>
    </div>
</div>

<script type="text/javascript">
    $('.store-order .add_btn').click(function(){
        var d = $('.store-order .add input[name="date"]').val();
        $.post(base_url+'index.php/admin/add_store_order', {
            'date': d
        }, function(){
            $('.store-order').parent().load(base_url+'index.php/admin/store_order');
        });
    });
    $('.store-order .del_btn').click(function(){
        var sid = $(this).attr('sid');
        $.post(base_url+'index.php/admin/del_store_order', {
            'sid': sid
        }, function(){
            $('.store-order').parent().load(base_url+'index.php/admin/store_order');
        });
    });
    $('.store-order .open_btn').click(function(){
        var sid = $(this).attr('sid');
        $.post(base_url+'index.php/admin/set_store_order_status', {
            'sid': sid,
            'status': 'O'
        }, function(){
            $('.store-order').parent().load(base_url+'index.php/admin/store_order');
        });
    });
    $('.store-order .close_btn').click(function(){
        var sid = $(this).attr('sid');
        $.post(base_url+'index.php/admin/set_store_order_status', {
            'sid': sid,
            'status': 'C'
        }, function(){
            $('.store-order').parent().load(base_url+'index.php/admin/store_order');
        });
    });
    $('.store-order .deliver_btn').click(function(){
        var sid = $(this).attr('sid');
        $.post(base_url+'index.php/admin/set_store_order_status', {
            'sid': sid,
            'status': 'D'
        }, function(){
            $('.store-order').parent().load(base_url+'index.php/admin/store_order');
        });
    });
    $('.store-order .future_btn').click(function(){
        var sid = $(this).attr('sid');
        $.post(base_url+'index.php/admin/set_store_order_status', {
            'sid': sid,
            'status': 'F'
        }, function(){
            $('.store-order').parent().load(base_url+'index.php/admin/store_order');
        });
    });
</script>