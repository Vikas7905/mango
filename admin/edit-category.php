<?php
include "../constant.php";
$id=($_POST["id"]);
$url = $URL . "category/readCategorybyId.php";
$data = array("id" => $id);
//print_r($data);
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
		<title>Admin| Category</title>
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
									<h3>Category</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>
									<br />
									<form class="form-horizontal row-fluid" name="Category" method="post" enctype="multipart/form-data" action="action/categoryUpdated_post.php">
										<?php
										for($i=0; $i<sizeof($result->records);$i++)
										{ //print_r($result->records[$i]);
										?>	
																<div class="control-group">
												<label class="control-label" for="basicinput">Category Name</label>
												<div class="controls">
													<input type="text"  name="name" value="<?php echo $result->records[$i]->name;?>" class="span8 tip" required>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="basicinput">Commision</label>
												<div class="controls">
													<input type="text"  name="commision" value="<?php echo $result->records[$i]->commision;?>" class="span8 tip" required>
													<input type="hidden"  name="id" value="<?php echo $result->records[$i]->id;?>" class="span8 tip">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="basicinput">SGST</label>
												<div class="controls">
													<input type="text"  name="sgst" value="<?php echo $result->records[$i]->sgst;?>" class="span8 tip" required>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="basicinput">CGST</label>
												<div class="controls">
													<input type="text"  name="cgst" value="<?php echo $result->records[$i]->cgst;?>" class="span8 tip" required>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="basicinput">Description</label>
												<div class="controls">
													<input type="text"  name="description" value="<?php echo $result->records[$i]->description;?>" class="span8 tip" required>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="basicinput">Existing Image</label>
												<div class="controls">
												<img src="img/category/<?php echo $result->records[$i]->id ."/".$result->records[$i]->id.".png";?>" width="150px" height="150px">
												</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Image</label>
											<div class="controls">
												<input type="file" class="span8" name="image">
											</div>
										</div>
                                         <?php 
										}?>										

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Update</button>
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