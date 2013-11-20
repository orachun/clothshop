<div class="customer-list">
	<?php foreach($customers as $c):?>
	<div class="customer-container item-container">
		<div>ID: <?php echo $c['customer_id'];?></div>
		<div>Name: <?php echo $c['fullname'];?></div>
		<div>Tel: <?php echo $c['tel'];?></div>
		<div>Email: <?php echo $c['email'];?></div>
		<div>Registered: <?php echo $c['registered_date'];?></div>
	</div>
	<?php endforeach;?>
</div>