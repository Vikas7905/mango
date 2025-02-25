<?php
include('include/header.php');
session_start();
include('include/config.php');
//print_r($_SESSION);
if (strlen($_SESSION['alogin']) == 0) {
	 //header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());
	include "../constant.php";
	$url = $URL . "orderdetails/readTodayOrderBySeller.php";
	$date = date('Y-m-d');
	$sellerId = $_POST['id'];
	$data = array("sellerId"=>$sellerId);
	// print_r($data);
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
		<title>Admin| Todays Orders</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<script language="javascript" type="text/javascript">
			var popUpWin = 0;

			function popUpWindow(URLStr, left, top, width, height) {
				if (popUpWin) {
					if (!popUpWin.closed) popUpWin.close();
				}
				popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
			}
		</script>
	</head>

	<body>

		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php include('include/sidebar.php'); ?>
					<div class="span9">
						<div class="content">

							<div class="module">
								<div class="module-head">
									<h3>Todays Orders</h3>
								</div>
								<div class="module-body table">
									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>

									<br />


									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display table-responsive">
										<thead>
											<tr>
											<tr>
												<th>#</th>
												<th>Order_id</th>
												<th>sellerId</th>
												<th>Delivery Id</th>
												<th width="50">User Id</th>
												<th>Total Quantity</th>
												<th>Total </th>
												<th>Address</th>
												<th>Order Status</th>
												<th>Order Date</th>
											</tr>


											</tr>
										</thead>

										<tbody>
											<?php
											
											$cnt = 0;
											
											for($i=0; $i<sizeof($result->records); $i++){
												$incdate = $result->records[$i]->createdOn;
												$dateObj = new DateTime($incdate);
												$formattedDate = $dateObj->format('Y-m-d');
												if($formattedDate==$date){
											?>
												<tr>
													<td><?php echo htmlentities($cnt); ?></td>
													<td><?php echo $result->records[$i]->orderId; ?></td>
													<td><?php echo $result->records[$i]->sellerId; ?></td>
													<td><?php echo $result->records[$i]->deliveryId; ?></td>
													<td><?php echo $result->records[$i]->userId; ?></td>
													<td><?php echo $result->records[$i]->totalQuantity; ?></td>
													<td><?php echo $result->records[$i]->total; ?></td>
													<td><?php echo $result->records[$i]->deliveryAddress; ?></td>
													<td><?php echo $result->records[$i]->status; ?></td>
													<td><?php echo $result->records[$i]->createdOn; ?></td>
													
												</tr>

											
											<?php
											 }} $cnt = $cnt + 1;
											?>
										</tbody>
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
<?php }?>