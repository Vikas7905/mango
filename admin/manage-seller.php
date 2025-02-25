<?php
//
// $jwt="123";
// $request_headers = [
//   'Authorization:' . $jwt
// ];
include "../constant.php";
$url = $URL ."seller/read_seller.php";
$data = array();
// //print_r($data);
$postdata = json_encode($data);
$client = curl_init();
curl_setopt( $client, CURLOPT_URL,$url);
//curl_setopt( $client, CURLOPT_HTTPHEADER,  $request_headers);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Manage seller</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	</head>

	<body>
		<?php include('include/header.php'); ?>

		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php include('include/sidebar.php'); ?>
					<div class="span9">
						<div class="content">

							<div class="module">
								<div class="module-head">
									<h3>Manage seller</h3>
								</div>
								<div class="module-body table">
									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>

									<br />


									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Seller Name</th>
												<th>Seller Id</th>
												<th>Password</th>
												<th>Shop Owner Photo</th>
												<th>Shop Title</th>
												<th>Shop Photo</th>
												<th>Contact no</th>
												<th>Seller Address </th>
												<!-- <th>Billing Address/City/State/Pincode </th> -->
												<th>Reg. Date </th>
												<th>Action </th>

											</tr>
										</thead>
										<tbody>

			<?php
                // print_r($result);
				$cnt=0;
                // print_r($result['records']);
                for($i=0; $i<sizeof($result->records);$i++)
                { //print_r($result->records[$i]);
                ?>
	<tr>
													<td><?php echo htmlentities($cnt); ?></td>
													<td><?php echo $result->records[$i]->sellerName;?></td>
													<td><?php echo $result->records[$i]->id;?></td>
													<td><?php echo $result->records[$i]->password;?></td>
													<td><img src="img/seller/<?php echo $result->records[$i]->pan ."/".$result->records[$i]->pan.".png";?>"></td>
													<td><?php echo $result->records[$i]->counterName;?></td>
													<td><img src="img/seller/<?php echo $result->records[$i]->pan ."/".$result->records[$i]->pan."_counter.png";?>"></td>
													<td> <?php echo $result->records[$i]->phoneNo;?></td>
													<td><?php echo $result->records[$i]->address;?></td>
													<td><?php echo $result->records[$i]->createdOn;?></td>
													<td>
														<form class="form-horizontal row-fluid"  action="action/sellerDelete_post.php" name="Category" method="post" enctype="multipart/form-data">
															<input type="hidden" name="id" value="<?php echo $result->records[$i]->id ?>">
															<button type="submit" class="icon-remove-sign"></button>
															
														</form>
														<form class="form-horizontal row-fluid"  action="edit-seller.php" name="update" method="post" enctype="multipart/form-data">
															<input type="hidden" name="id" value="<?php echo $result->records[$i]->id ?>">
															<button type="submit" class="icon-edit"></button>
														</form>
													</td>	

												<?php $cnt = $cnt + 1;
											} ?>

									</table>
								</div>
							</div>



						</div><!--/.content-->
					</div><!--/.span9-->
				</div>
			</div><!--/.container-->
		</div><!--/.wrapper-->

		<?php include('include/footer.php'); ?>

		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
		<script src="scripts/datatables/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function() {
				$('.datatable-1').dataTable();
				$('.dataTables_paginate').addClass("btn-group datatable-pagination");
				$('.dataTables_paginate > a').wrapInner('<span />');
				$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
				$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
			});
		</script>
	</body>