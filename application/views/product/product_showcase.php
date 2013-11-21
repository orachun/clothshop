<div class="product-showcase-tabs">
    <div class="showcase-title ui-state-active ui-corner-all">
		<span class="tab-eng-title"><?php echo $title_en; ?></span>
		<?php echo $title_th; ?>
	</div>
    <div class="showcase-content" id="most-viewed-tab">
		<div class="product-showcase" target=".<?php echo $name; ?>-detail-placeholder">
			<?php
			foreach ($products as $p)
			{
				echo $p;
			}
			?>
		</div>
		<div class="<?php echo $name; ?>-detail-placeholder"></div>
	</div>
</div>

<script type="text/javascrpit">
	$(function(){
		slide(".product-showcase", ".product-grid-item", items_per_row, 5000, 800);
	});
</script>