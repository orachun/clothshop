<div class="customer-list">
	<table class="admin-table">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Tel</th>
			<th>Email</th>
			<th>Registered Date</th>
		</thead>
		<tbody>
			<?php foreach($customers as $i=>$c):?>
			<tr class="<?php echo $i%2==0?'odd':'even';?>">
				<td><?php echo $c['customer_id'];?></td>
				<td><?php echo $c['fullname'];?></td>
				<td><?php echo $c['tel'];?></td>
				<td><?php echo $c['email'];?></td>
				<td><?php echo $c['registered_date'];?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>