<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Day Report</title>
</head>
	<body>
	    <div id="container">
	        <h1>Day Report!</h1>
	        <div id="body">
	        	<?php if (!empty(array_filter($arriving))) { ?>
					<h4>Arriving <?php echo formatdate(array_unique(array_column($arriving, 'check_in'))[0], 1);?></h4>
		        	<table class="table table-bordered" style="border:1px solid black;">
					  <thead>
						    <tr>
								<th>Horse Owner</th>
								<th>Stalls Reserved</th>
								<th>Contact Phone Number</th>
						    </tr>
					  </thead>
					  <tbody>
					  		<?php foreach ($arriving as $arrivinguser) { ?>
					    		<tr>
								  	<td><?php echo $arrivinguser['firstname'].$arrivinguser['lastname'];?></td>
						  				<?php foreach ($arrivinguser['barnstall'] as $stalldata) { ?>
							  				<td><?php echo $stalldata['stallname'];?></td>
						  				<?php } ?>
								  	<td><?php echo $arrivinguser['mobile'];?></td>		
							    </tr>
					    	<?php } ?>
					  </tbody>
					</table>
				 <?php } else{
							echo 'No Records Found';
					   } ?>
				 <?php if (!empty(array_filter($outgoing))) { ?>
					<h4>Outgoing <?php echo formatdate(array_unique(array_column($outgoing, 'check_out'))[0], 1);?></h4>
	        		<table class="table table-bordered" style="border:1px solid black;">
					   	<thead>
					     	<tr>
								<th>Horse Owner</th>
								<th>Stalls Reserved</th>
								<th>Contact Phone Number</th>
						    </tr>
					  	</thead>
					  	<tbody>
					  		<?php foreach ($outgoing as $arrivinguser) { ?>
					    		<tr>
								  	<td><?php echo $arrivinguser['firstname'].$arrivinguser['lastname'];?></td>
						  				<?php foreach ($arrivinguser['barnstall'] as $stalldata) {?>
								  			<td><?php echo $stalldata['stallname'];?></td>
						  				<?php } ?>
								  	<td><?php echo $arrivinguser['mobile'];?></td>		
							    </tr>
					    	<?php } ?>
					  	</tbody>
					</table>
					<?php }
					else{
						echo 'No Records Found';
					} ?>
	        </div>
	    </div>
	</body>
</html>