<div class="delivering">
    <?php foreach($deliverings as $c)
    {
        echo '<div><button class="del_btn" did="'.$c->delivery_type_id.'">Discard</button> '
                .$c->name 
                .' Unit Cost: '.$c->unit_cost
                .' Free Threshold: '. $c->free_threshold
                .' Discarded: '. $c->is_discarded
                .'</div>';
    }
    ?>
    <form class="add">
        Name: <input name="name"/> 
        Unit cost: <input name="unit_cost"/> 
        Free threshold: <input name="free_threshold"/>
        <input type="button" class="add_btn" value="Add">
    </form>
</div>

<script type="text/javascript">
    $('.delivering .add_btn').click(function(){
        $.post(base_url+'index.php/admin/add_delivery', $('.delivering .add').serialize(), function(){
            $('.delivering').parent().load(base_url+'index.php/admin/delivering');
        });
    });
    $('.delivering .del_btn').click(function(){
        var did = $(this).attr('did');
        $.post(base_url+'index.php/admin/discard_delivery', {
            'id': did
        }, function(){
            $('.delivering').parent().load(base_url+'index.php/admin/delivering');
        });
    });
</script>