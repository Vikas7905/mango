<?php
include ('include/header.php');
//session_start();
// $jwt="123";
// $request_headers = [
//   'Authorization:' . $jwt
// ];
include "../constant.php";
$id=trim(strtoupper($_POST["id"]));
$url = $URL . "product/readProductById.php";
//$url="http://localhost/onlinesabjimandiapi/api/src/category/readCategory.php";
$data = array("crid" =>"", "spid" => "", "pid" =>$id, "filter" =>"", "pageSize" =>"", "sort" => "", "extra" => "","pincode"=>"");
// print_r($data);
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
		<title>Seller| Insert Product</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
			rel='stylesheet'>
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>

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
					<?php include ('include/sidebar.php'); ?>
					<div class="span9">
						<div class="content">

							<div class="module">
								<div class="module-head">
									<h3>Insert Product</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Well done!</strong>
											<?php echo htmlentities($_SESSION['msg']); ?>
											<?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>


									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Oh snap!</strong>
											<?php echo htmlentities($_SESSION['delmsg']); ?>
											<?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>

									<br />

									<form class="form-horizontal row-fluid" action="action/editProduct_post.php" name="insertproduct" method="post"
										enctype=	"multipart/form-data">

										<?php
                // print_r($result);
				$cnt=0;
                //print_r($result['records']);
                for($i=0; $i<sizeof($result->records);$i++)
                { //print_r($result->records[$i]);
                ?>
				<input type="hidden" name="pid" value="<?php echo $result->records[$i]->pid;?>">
				<input type="hidden" name="sellerId" value="<?php echo $result->records[$i]->sellerId;?>">


											<div class="control-group">
												<label class="control-label" for="basicinput">Category</label>
												<div class="controls">
												<select name="categoriesId" class="span8 tip" onChange="getSubcat(this.value);" >
													<option value="">Select Category</option>
													<?php
                // print_r($result);
                // print_r($result['records']);
                // for($i=0; $i<sizeof($result->records);$i++)
                // { print_r($result->records[$i]);
                // ?>
				
													
														<option value="<?php echo $result->records[$i]->categoriesId;?>"> <?php echo $result->records[$i]->categoriesId;?></option>
														
													
												</select>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Product SKU-ID</label>
												<div class="controls">
													<input type="text" name="skuId" 
														value="<?php echo $result->records[$i]->skuId;?>" class="span8 tip"
														required>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Sub Category</label>
												<div class="controls">

													<select name="subcategory" id="subcategory" class="span8 tip" required>
														<option value="<?php echo $result->records[$i]->categoriesId;?>">
														<?php echo $result->records[$i]->skuId;?>
														</option>
													</select>
												</div>
											</div>


											<div class="control-group">
												<label class="control-label" for="basicinput">Product Name</label>
												<div class="controls">
													<input type="text" name="productName" placeholder="Enter Product Name"
														value="<?php echo $result->records[$i]->productName;?>"
														class="span8 tip">
												</div>
											</div>

											
											<div class="control-group">
												<label class="control-label" for="basicinput">Product Price
													</label>
												<div class="controls">
													<input type="text" name="price"
														value="<?php echo $result->records[$i]->price;?>"
														class="span8 tip" required>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Discount in Percent %</label>
												<div class="controls">
													<input type="text" name="discount" placeholder="Enter Product Price"
														value="<?php echo $result->records[$i]->discount;?>"
														class="span8 tip" required>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="basicinput">Quantity</label>
												<div class="controls">
													<input type="text" name="quantity"
														value="<?php echo $result->records[$i]->quantity;?>"
														class="span8 tip" required>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="basicinput">Product Description</label>
												<div class="controls">
													<textarea name="productDescription" placeholder="Enter Product Description"
														rows="6"
														class="span8 tip"><?php echo $result->records[$i]->description;?>
													</textarea>
												</div>
											</div>

											
											
											<div class="control-group">
												<label class="control-label" for="basicinput">Product Shipping Charge</label>
												<div class="controls">
													<input type="text" name="productShippingcharge"
														placeholder="Enter Product Shipping Charge"
														value="<?php echo $result->records[$i]->shippingCharge;?>"
														class="span8 tip" required>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Product Availability</label>
												<div class="controls">
													<select name="status" id="productAvailability"
														class="span8 tip" required>
														<option
															value="<?php echo htmlentities($row['productAvailability']); ?>">
															<?php echo htmlentities($row['productAvailability']); ?>
														</option>
														<option value="In Stock">In Stock</option>
														<option value="Out of Stock">Out of Stock</option>
													</select>
												</div>
											</div>


												<div class="control-group">
													<label class="control-label" for="basicinput">Product Image1</label>
													<div class="controls">
														<img src="productimages/<?php echo $result->records[$i]->skuId;?>/<?php echo $result->records[$i]->skuId;?>1.png"
															width="200" height="100"> <a
															href="update-image1.php?id=<?php echo $row['id']; ?>"><input type="file" name="productimage1" class="span8 tip"></a>
													</div>
												</div>
												
											<?php } ?>
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

		<div id="blank_size_field" style="display: none;">
			<div class="flex-grow-1 pr-3">
				<div class="form-group">
					<input type="text" class="span8 tip" name="size[]" id="size" placeholder="Enter Product Size" />
					<button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button"
						onclick="removeSize(this)">
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
					<button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button"
						onclick="removeColor(this)">
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

		<?php include ('include/footer.php'); ?>

		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
		<script src="scripts/datatables/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function () {
				$('.datatable-1').dataTable();
				$('.dataTables_paginate').addClass("btn-group datatable-pagination");
				$('.dataTables_paginate > a').wrapInner('<span />');
				$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
				$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
			});
		</script>
	</body>