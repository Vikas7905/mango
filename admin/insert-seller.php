<?php 
include "../constant.php";
$url = $URL . "seller/read_sellermaxid.php";
//$url="http://localhost/shivammangoshopapi/api/src/category/readCategory.php";
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
$nextId=$result->records[0]->id+1;
//print_r($nextId);
?>
	<!DOC
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Insert seller</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>

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
									<h3>Add seller</h3>
								</div>
								<div class="module-body">

										<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>We wll done!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>


									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>

									<br />

									<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data" action="action/insertSellerPost.php">
							
									<div class="control-group">
											<label class="control-label" for="basicinput">seller Name</label>
											<div class="controls">
												<input type="text" name="sellerName" placeholder="seller name" class="span8 tip" required>
										</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Shop Title</label>
											<div class="controls">
												<input type="text" name="counterName" placeholder="Counter Name" class="span8 tip" required>
										</div>
										</div>
										
									
										<div class="control-group">
											<label class="control-label" for="basicinput">phone No</label>
											<div class="controls">
												<input type="text" name="phoneNo" placeholder="Phone No" class="span8 tip" required>
										</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Email Id</label>
											<div class="controls">
												<input type="text" name="email" placeholder="Enter Email Id" class="span8 tip">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Deposit Amount</label>
											<div class="controls">
												<input type="text" name="depositAmount" value="500" placeholder="Deposit Amount" class="span8 tip" readonly>
										</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Password</label>
											<div class="controls">
												<input type="text" name="password" value="<?php echo rand() ?>" placeholder="password" class="span8 tip" readonly>
										</div>
										</div>
									<div class="control-group">
											<label class="control-label" for="basicinput">Reg Fee</label>
											<div class="controls">
												<input type="text" name="regFee" placeholder="Reg Fee" value="50" class="span8 tip" readonly>
										</div>
										</div>
									
									
										<div class="control-group">
											<label class="control-label" for="basicinput">Gst</label>
											<div class="controls">
												<input type="text" name="gst" placeholder="Enter GST NO" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Aadhar</label>
											<div class="controls">
												<input type="text" name="aadhar" placeholder="Adhar no" class="span8 tip" required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Pan</label>
											<div class="controls">
												<input type="text" name="pan" placeholder="pan Card" class="span8 tip" required>
											</div>
										</div>
										
										
										<div class="control-group">
											<label class="control-label" for="basicinput">Owner Image</label>
											<div class="controls">
												<input type="file" name="upload" placeholder="counter Image" class="span8 tip" required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Shop Image</label>
											<div class="controls">
												<input type="file" name="shopupload" placeholder="shop Image" class="span8 tip" required>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Insert</button>
											</div>
										</div>
									</form>
								</div>
							</div>

						</div><!--/.content-->
					</div><!--/.span9-->
				</div>
			</div><!--/.container-->
		</div><!--/.wrapper-->
		<div id="blank_size_field" style="display: none;">
			<div class="flex-grow-1 pr-3">
				<div class="form-group">
					<input type="text" class="span8 tip" name="size[]" id="size" placeholder="Enter Product Size" />
					<button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeSize(this)">
						<!-- <i class="fa fa-minus"></i> -->
						 Remove
					</button>
				</div>
			</div>
		</div>
		<div id="blank_color_field" style="display: none;">
			<div class="flex-grow-1 pr-3">
				<div class="form-group">
					<input type="text" class="span8 tip" name="color[]" id="color" placeholder="Enter Product Color" />
					<button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeColor(this)">
						<!-- <i class="fa fa-minus"></i> -->
						 Remove
					</button>
				</div>
			</div>
		</div>
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
