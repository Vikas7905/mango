<?php
include "../constant.php";
$url = $URL . "category/readCategory.php";
$data = array();
//print_r($data);
$postdata = json_encode($data);
$client = curl_init();
curl_setopt( $client, CURLOPT_URL,$url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);

$url = $URL . "subcategory/readsubcategoryAll.php";
$data = array();
// //print_r($data);
$postdata = json_encode($data);
$client = curl_init();
curl_setopt( $client, CURLOPT_URL,$url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$resultsub = json_decode($response);
//print_r($result);
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Sub Category</title>
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
		<?php include('include/header.php'); ?>

		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php include('include/sidebar.php'); ?>
					<div class="span9">
						<div class="content">

							<div class="module">
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

									<form class="form-horizontal row-fluid" name="subcategory" method="post" enctype="multipart/form-data" action="action/subcategory_post.php">

									<div class="control-group">
											<label class="control-label" for="basicinput">Category</label>
											<div class="controls">
												<select name="categoriesId" class="span8 tip" onChange="getSubcat(this.value);" >
													<option value="">Select Category</option>
													
													<?php
                // print_r($result);
				$cnt=0;
                // print_r($result['records']);
                for($i=0; $i<sizeof($result->records);$i++)
                { //print_r($result->records[$i]);
                ?>	
				
													
														<option value="<?php echo $result->records[$i]->id;?>"> <?php echo $result->records[$i]->name;?></option>
														
													<?php } ?>
												</select>
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="basicinput">Sub Category Name</label>
											<div class="controls">
												<input type="text" placeholder="Enter Sub Category Name" name="subcategory" class="span8 tip" required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Description</label>
											<div class="controls">
												<input type="text" placeholder="Enter SubCategory Name" name="description" class="span8 tip" required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Sub Category Image</label>
											<div class="controls">
												<input type="file" placeholder="Choose SubCategory Image" name="subcategoriesImage" class="span8 tip" required>
											</div>
										</div>



										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Create</button>
											</div>
										</div>
									</form>
								</div>
							</div>


							<div class="module">
								<div class="module-head">
									<h3>Sub Category</h3>
								</div>
								<div class="module-body table">
									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Category</th>
												<th>Sub Category</th>
												<th>Sub Category Image</th>
												<th>Creation date</th>
												<th>Last Updated</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>

										<?php
                // print_r($result);
				$cnt=0;
                // print_r($result['records']);
                for($i=0; $i<sizeof($resultsub->records);$i++)
                { //print_r($result->records[$i]);
                ?>	
												<tr>
												<td><?php echo htmlentities($cnt); ?></td>
												<td><?php echo $resultsub->records[$i]->parentId;?></td>
												<td><?php echo $resultsub->records[$i]->name;?></td>
												<td><img src="img/subcategory/<?php echo $resultsub->records[$i]->id ."/".$resultsub->records[$i]->id.".png";?>"></td>
												<td><?php echo $resultsub->records[$i]->createdOn;?></td>
												<td><?php echo $resultsub->records[$i]->updatedOn;?></td>
													<td>
														<form class="form-horizontal row-fluid"  action="action/subcategoryDelete_post.php" name="Category" method="post" enctype="multipart/form-data">
															<input type="hidden" name="id" value="<?php echo $resultsub->records[$i]->id ?>">
															
															<button type="submit" class="icon-remove-sign"></button>
														</form>
														<form class="form-horizontal row-fluid"  action="edit-subcategory.php" name="Category" method="post" enctype="multipart/form-data">
															<input type="hidden" name="id" value="<?php echo $resultsub->records[$i]->id ?>">
															<button type="submit" class="icon-edit"></button>
														</form>
													</td>
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
