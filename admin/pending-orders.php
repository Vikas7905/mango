<?php
include('include/header.php');
include "../constant.php";
// $urlreadOrderDetails = $URL . "orderdetails/readOrderDetails.php";
$urlreadOrderDetails = $URL . "orderdetails/readPending.php";
$data = array();
//print_r($data);
$postdata = json_encode($data);
$client = curl_init();
curl_setopt( $client, CURLOPT_URL,$urlreadOrderDetails);
//curl_setopt( $client, CURLOPT_HTTPHEADER,  $request_headers);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$readOrderDetailsResponse = curl_exec($client);
// print_r($readOrderDetailsResponse);
$resultOrderDetails = json_decode($readOrderDetailsResponse);
//print_r($resultOrderDetails);
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Seller| Pending Orders</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<script>
			function getSubcat(val) {
				//alert(val);
				var dataPost = {
					"cat_id": val};var dataString = JSON.stringify(dataPost);
				$.ajax({
					type: "POST",
					url: "../api/src/subcategory/readsubcategory.php",
					data: {
                          cat_id: dataString
					},
					success: function(data) 
					{
					
						 $('#subcategories').html('');
						$('#subcategories').append('<option>' +"Sub Categories" + '</option>');
						 $.each(data.records, function (i, value) {
						  
                $('#subcategories').append('<option id=' + (value.categoryid) + '>' + (value.subcategoryName) + '</option>');
            });
					},
					error: function(data)
					{
					       $('#subcategories').html('');
					     $('#subcategories').append('<option>' + "No records found !!" + '</option>');
					
		
					}
				});
			}

			function selectCountry(val) {
				$("#search-box").val(val);
				$("#suggesstion-box").hide();
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

							<!-- <div class="module">
								<div class="module-head">
									<h3>Sub Category</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>


									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data  4g-dismiss="alert">×</button>
											<strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>

									<br />

								</div>
							</div> -->


							<div class="module">
								<div class="module-head">
									<h3>Pending Orders</h3>
								</div>
								<div class="module-body table">
									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Order Id</th>
												<th>Delivery Id</th>
												<th>Payment Id</th>
												<th>Total</th>
												<th>SGST</th>
												<th>CGST</th>
												<th>OTP</th>
												<th>STATUS</th>
												<th>Toal Commision</th>
												<th>Created On</th>
												<th>Created By</th>
											</tr>
										</thead>
										<tbody>

										<?php
                // print_r($result);
				$cnt=0;
                // print_r($result['records']);
                for($i=0; $i<sizeof($resultOrderDetails->records);$i++)
                { 	// print_r($resultOrderDetails->records[$i]);
                ?>	
												<tr>
												<td><?php echo htmlentities($cnt); ?></td>
												<td>
												<form  action="order_view.php" method="post">	
												<input type="hidden" name="orderId" value="<?php echo $resultOrderDetails->records[$i]->orderId;?>">
												<button type="submit" class="btn btn-success"><?php echo $resultOrderDetails->records[$i]->orderId;?></button>
				                                  </form>
											</td>
												<td><?php echo $resultOrderDetails->records[$i]->deliveryId;?></td>
												<td><?php echo $resultOrderDetails->records[$i]->paymentId;?></td>
												<td><?php echo $resultOrderDetails->records[$i]->total;?></td>
												<td><?php echo $resultOrderDetails->records[$i]->sgst;?></td>
												<td><?php echo $resultOrderDetails->records[$i]->cgst;?></td>
												<td><?php echo $resultOrderDetails->records[$i]->verificationCode;?></td>
												<td><?php echo $resultOrderDetails->records[$i]->status;?></td>
												<td><?php echo $resultOrderDetails->records[$i]->adminCommision;?></td>
												<td><?php echo $resultOrderDetails->records[$i]->createdOn;?></td>
												<td><?php echo $resultOrderDetails->records[$i]->createdBy;?></td>
									
												</tr>
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
