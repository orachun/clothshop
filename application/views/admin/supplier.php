<div class="supplier">
    <?php foreach($suppliers as $c)
    {
        echo '<div><button class="del_btn" sid="'.$c->supplier_id.'">Del</button> '
                .$c->name.': <a href="'.$c->url.'" target="_blank">'.$c->url.'</a>'
                .'</div>';
    }
    ?>
    <div class="add">
        Name: <input name="name"/> URL: <input name="url"/><button class="add_btn">Add</button>
    </div>
</div>

<script type="text/javascript">
    $('.supplier .add_btn').click(function(){
        var name = $('.supplier .add input[name="name"]').val();
        var url = $('.supplier .add input[name="url"]').val();
        $.post(base_url+'index.php/admin/supplier_add', {
            'name': name,
            'url': url
        }, function(){
            $('.supplier').parent().load(base_url+'index.php/admin/supplier');
        });
    });
    $('.supplier .del_btn').click(function(){
        var sid = $(this).attr('sid');
        $.post(base_url+'index.php/admin/supplier_del', {
            'sid': sid
        }, function(){
            $('.supplier').parent().load(base_url+'index.php/admin/supplier');
        });
    });
</script>