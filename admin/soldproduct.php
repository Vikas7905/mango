<?php
ob_start();
include('include/header.php');
include('include/config.php');
session_start();
// print_r($_SESSION);
if (strlen($_SESSION['alogin']) == 0) {
	  header('location:index.php');
} else {
    include "../constant.php";
	$url = $URL . "orderdetails/readSoldOrder.php";
	$data = array();
	$postdata = json_encode($data);
	$client = curl_init();
	curl_setopt( $client, CURLOPT_URL,$url);
	//curl_setopt( $client, CURLOPT_HTTPHEADER,  $request_headers);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($client, CURLOPT_POST, 5);
	curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
	$response = curl_exec($client);
	// print_r($response);
	$result = json_decode($response);
	//print_r($result);
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Pending Orders</title>
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
												<th>Order Date</th>
											</tr>


											</tr>
										</thead>

										<tbody>
											<?php
											// $f1 = "00:00:00";
											// $from = date('Y-m-d') . " " . $f1;
											// $t1 = "23:59:59";
											// $to = date('Y-m-d') . " " . $t1;
											// $query1 = mysqli_query($con, "select users.name as username,users.email as useremail,users.contactno as usercontact,address.shippingAddress as shippingaddress,address.shippingCity as shippingcity,address.shippingState as shippingstate,address.shippingPincode as shippingpincode,address.mobile_no as mobile_no,address.billingAddress as billingaddress,address.billingCity as billingcity,address.billingState as billingstate,address.billingPincode as billingpincode,products.productName as productname,products.shippingCharge as shippingcharge,orders.order_id as order_id, orders.quantity as quantity,orders.size as size,orders.color as color,orders.GSTN as gstn,orders.orderStatus as orderstatus,orders.orderDate as orderdate,orders.paymentMethod as paymentMethod,products.productPrice as productprice, products.skuId as skuid, orders.id as id  from orders join users on  orders.userId=users.id join address on orders.address=address.id join products on products.id=orders.productId where orders.orderDate Between '$from' and '$to'");
											$cnt = 0;
											// while ($row = mysqli_fetch_array($query1)) {
											for($i=0; $i<sizeof($result->records); $i++){
											//print_r($result->records);
											?>
												<tr>
													<td><?php echo htmlentities($cnt); ?></td>
													<td><?php echo $result->records[$i]->orderId; ?></td>
													<td><?php echo $result->records[$i]->sellerId ?></td>
													<td><?php echo $result->records[$i]->deliveryId ?></td>
													<td><?php echo $result->records[$i]->userId ?></td>
													<td><?php echo $result->records[$i]->totalQuantity ?></td>
													<td><?php echo $result->records[$i]->total ?></td>
													<td><?php echo $result->records[$i]->deliveryAddress ?></td>
													<td><?php echo $result->records[$i]->createdOn ?></td>
													
												</tr>

											<?php $cnt = $cnt + 1;
											} ?>
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