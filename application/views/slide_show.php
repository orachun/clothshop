
<style>
#main-slide-show-container #bx-viewport{height: 300px;}
</style>
<div id="main-slide-show-container">
    <ul id="mainslideshow">
        <?php foreach($slides as $s):?>
		<li><a href="<?php echo base_url().$s['link'];?>"><img class="ui-corner-all" height="300" src="<?php echo base_url().$s['img'];?>"/></a></li>
        <?php endforeach;?>
    </ul>
    
</div>

<script type="text/javascript">
        $('#mainslideshow').bxSlider({
            auto: true
        });
</script>