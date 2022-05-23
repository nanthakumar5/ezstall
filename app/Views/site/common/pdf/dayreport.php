<style>
table{
	width : 100%;
}
table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
}

table tr th, 
table tr td {
	padding : 10px;
	text-align : left;
}

.sub_heading{
	margin-bottom : 15px;
	font-size : 22px;
}
</style>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Day Report</title>
	</head>
	<body>
	    <div> 
	        <h1>Day Report!</h1>
	        <div>	        	
				<h4 class="sub_heading">Arriving <?php echo formatdate(date('Y-m-d'), 1);?></h4>
				<table>
				  <thead>
						<tr>
							<th width="40%">Horse Owner</th>
							<th width="30%">Stalls Reserved</th>
							<th width="30%">Contact Phone Number</th>
						</tr>
				  </thead>
				  <tbody>
						<?php if (!empty(array_filter($arriving))) { ?>
							<?php foreach ($arriving as $data) { ?>
								<tr>
									<td><?php echo $data['firstname'].' '.$data['lastname'];?></td>
									<td><?php echo implode(', ', array_column($data['barnstall'], 'stallname')); ?></td>
									<td><?php echo $data['mobile'];?></td>		
								</tr>
							<?php } ?>
						<?php }else{ ?>
							<tr><td colspan="3">No Arriving Today</td></tr>
						<?php } ?>
				  </tbody>
				</table>
				
				<h4 class="sub_heading">Outgoing <?php echo formatdate(date('Y-m-d'), 1);?></h4>
				<table>
					<thead>
						<tr>
							<th width="40%">Horse Owner</th>
							<th width="30%">Stalls Reserved</th>
							<th width="30%">Contact Phone Number</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty(array_filter($outgoing))) { ?>
							<?php foreach ($outgoing as $data) { ?>
								<tr>
									<td><?php echo $data['firstname'].' '.$data['lastname'];?></td>
									<td><?php echo implode(', ', array_column($data['barnstall'], 'stallname')); ?></td>
									<td><?php echo $data['mobile'];?></td>		
								</tr>
							<?php } ?>
						<?php }else{ ?>
							<tr><td colspan="3">No Outgoing Found</td></tr>
						<?php } ?>
					</tbody>
				</table>
	        </div>
	    </div>
	</body>
</html>