<div class="category">
    <?php foreach($cats as $c)
    {
        echo '<div><button class="del_btn" catname="'.$c->name.'">Del</button> '.$c->name.'</div>';
    }
    ?>
    <div class="add">
        <input name="cat_name"/><button class="add_btn">Add</button>
    </div>
</div>

<script type="text/javascript">
    $('.category .add_btn').click(function(){
        var name = $('.category .add input').val();
        $.post(base_url+'index.php/admin/category_add/'+name, function(){
            $('.category').parent().load(base_url+'index.php/admin/category');
        });
    });
    $('.category .del_btn').click(function(){
        var name = ($(this).attr('catname'));
        $.post(base_url+'index.php/admin/category_del/'+name, function(){
            $('.category').parent().load(base_url+'index.php/admin/category');
        });
    });
</script>