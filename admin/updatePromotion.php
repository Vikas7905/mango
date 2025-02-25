<?php
//
// $jwt="123";
// $request_headers = [
//   'Authorization:' . $jwt
// ];
include "../constant.php";
$url = $URL . "promotion/readpromotion.php";
$id = $_POST['id'];

//$url="http://localhost/shivammangoshopapi/api/src/category/readCategory.php";
$data = array("id"=>$id);
// //print_r($data);
$postdata = json_encode($data);
$client = curl_init();
curl_setopt( $client, CURLOPT_URL,$url);
//curl_setopt( $client, CURLOPT_HTTPHEADER,  $request_headers);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
 print_r($response);
$result = json_decode($response);
// print_r($result);
?>
<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Update Promotion</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>

		<script>
			function getSubcat(val) {
				alert(val);
				var dataPost = {
					"id": val};var dataString = JSON.stringify(dataPost);
					console.log(dataString);
				$.ajax({
					type: "POST",
					url: "../api/src/subcategory/readsubcategory.php",
					data: {
                          dataString
					},
					
					success: function(data) 
					{
						console.log(data);
						 $('#subcategories').html('');
						$('#subcategories').append('<option>' +"Sub Categories" + '</option>');
						 $.each(data.records, function (i, value) {
						  
                $('#subcategories').append('<option id=' + (value.id) + '>' + (value.name) + '</option>');
            });
					},
					error: function(data)
					{
						console.log(data);
					       $('#subcategories').html('');
					     $('#subcategories').append('<option>' + "No records found !!" + '</option>');
					
		
					}
				});
			}

			function selectCountry(val) {
				$("#search-box").val(val);
				$("#suggesstion-box").hide();
			}


			// ***


			function checkInput() {
            var inputField = document.querySelectorAll("input");
            // If input value is empty, set it to readonly
            if (inputField.value.trim() === "") {
                inputField.readOnly = true;
            } else {
                inputField.readOnly = false;
            }
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
									<h3>Update Promotion</h3>
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
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } 
									
									$para = $result->records[0]->para;
									?>
									

									<br />

									<form class="form-horizontal row-fluid" name="updatepromotion" method="post" enctype="multipart/form-data" action="action/updatepromotion.php">

										<div class="control-group">
                                        
											<label class="control-label" for="basicinput">Top Heading</label>
											<div class="controls">
												<input type="text" name="tHeading" placeholder="Enter Top Heading" class="span8 tip" required value="<?php echo $result->records[0]->tHeading ?>">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Heading</label>
											<div class="controls">
												<input type="text" name="heading" placeholder="Heading" class="span8 tip" value="<?php echo $result->records[0]->heading ?>" required >
											</div>
										</div>
										<!--<div class="control-group">-->
										<!--	<label class="control-label" for="basicinput">seller Id</label>-->
										<!--	<div class="controls">-->
										<!--		<input type="text" name="sellerId" placeholder="Enter Product SKU ID" class="span8 tip" required>-->
										<!--	</div>-->
										<!--</div>-->



										<div class="control-group">
											<label class="control-label" for="basicinput">Paragraph</label>
											<div class="controls">
												<input type="text" name="para" placeholder="Enter Paragraph" class="span8 tip" value="<?php echo $result->records[0]->para ?>"  <?php echo empty($para) ? 'readonly' : ''; ?> required>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Button Link</label>
											<div class="controls">
												<input type="text" name="link" placeholder="Enter Button Link" class="span8 tip" value="<?php echo $result->records[0]->link ?>" required>
											</div>
										</div>

										
										

										
										<div class="control-group">
											<div class="controls">
												<input type="hidden" name="id" value="<?php echo $result->records[0]->id ?>">
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


		<script>
			function appendSize() {
				var blank_requirement = $('#blank_size_field').html();
				$('#size_area').append(blank_requirement);
			}

			function removeSize(sizeElem) {
				$(sizeElem).parent().parent().remove();
			}


			function appendColor() {
				var blank_requirement = $('#blank_color_field').html();
				$('#color_area').append(blank_requirement);
			}

			function removeColor(sizeElem) {
				$(sizeElem).parent().parent().remove();
			}
		</script>

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
