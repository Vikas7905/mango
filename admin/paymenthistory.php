<?php
include('include/header.php');
include '../constant.php';
$url = $URL . "seller/readSellerPay.php";
$data = array();
//print_r($data);
$postdata = json_encode($data);
$client = curl_init();
curl_setopt($client, CURLOPT_URL, $url);
//curl_setopt( $client, CURLOPT_HTTPHEADER,  $request_headers);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$resultPayment = json_decode($response);
// print_r($resultPayment);


$fromDate = isset($_GET["fromDate"]) ? $_GET["fromDate"] : "";
$toDate = isset($_GET["toDate"]) ? $_GET["toDate"] : "";
$url2 = $URL . "seller/readSellerPayDate.php";
$data2 = array("fromDate" => $fromDate, "toDate" => $toDate);
// print_r($data);
$postdata2 = json_encode($data2);
$client2 = curl_init($url2);
curl_setopt($client2, CURLOPT_POSTFIELDS, $postdata2);
curl_setopt($client2, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($client2, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($client2, CURLOPT_RETURNTRANSFER, true);
$response2 = curl_exec($client2);
curl_close($client2);
// print_r($response2);
$result = (json_decode($response2));


$fromDated = isset($_GET["fromDated"]) ? $_GET["fromDated"] : "";
$toDated = isset($_GET["toDated"]) ? $_GET["toDated"] : "";
$url2 = $URL . "deliveryBoy/readDeliveryPayDate.php";
$data2 = array("fromDate" => $fromDated, "toDate" => $toDated);
// print_r($data);
$postdata2 = json_encode($data2);
$client2 = curl_init($url2);
curl_setopt($client2, CURLOPT_POSTFIELDS, $postdata2);
curl_setopt($client2, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($client2, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($client2, CURLOPT_RETURNTRANSFER, true);
$response2 = curl_exec($client2);
curl_close($client2);
// print_r($response2);
$result2 = (json_decode($response2));
?>
<!DOCTYPE html>
<html lang="en">






<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin| SubCategory</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <script>
        function getSubcat(val) {
            //alert(val);
            var dataPost = {
                "cat_id": val
            };
            var dataString = JSON.stringify(dataPost);
            $.ajax({
                type: "POST",
                url: "../api/src/subcategory/readsubcategory.php",
                data: {
                    cat_id: dataString
                },
                success: function(data) {

                    $('#subcategories').html('');
                    $('#subcategories').append('<option>' + "Sub Categories" + '</option>');
                    $.each(data.records, function(i, value) {

                        $('#subcategories').append('<option id=' + (value.categoryid) + '>' + (value.subcategoryName) + '</option>');
                    });
                },
                error: function(data) {
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

									
													
													<?php
                                                    // print_r($result);
                                                    // $cnt = 0;

                                                    //for ($i = 0; $i < sizeof($resultPayment->records); $i++) { //print_r($resultPayment->records[$i]);
                                                    ?>	
				
													
														<option value="<?php //echo $resultPayment->records[$i]->id; 
                                                                        ?>"> <?php // echo $resultPayment->records[$i]->name; 
                                                                                ?></option>
														
													<?php // } 
                                                    ?>
												


										

<!- Payment History Table 1 -->
                        <div class="module">
                            <div class="module-head">
                                <h3>Payment History</h3>
                            </div>
                            <div class="module-body table">
                                <?php if (isset($resultPayment->records) && count($resultPayment->records) > 0) : ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>id</th>
                                                <th>Name</th>
                                                <th>Counter Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Commision</th>
                                                <th>Total Payment</th>
                                                <th>Payable <small>Price-Discount</small></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cnt = 0;
                                            foreach ($resultPayment->records as $record) {
                                            ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo $record->sellerId; ?></td>
                                                    <form action="paymentdetails.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $record->sellerId ?>">
                                                        <td><button type="submit"><?php echo $record->sellerName; ?></button></td>
                                                    </form>
                                                    <td><?php echo $record->counterName; ?></td>
                                                    <td><?php echo $record->phoneNo; ?></td>
                                                    <td><?php echo $record->email; ?></td>
                                                    <td><?php echo $record->totalAdminCommission; ?></td>
                                                    <td><?php echo $record->totalSubtotal; ?></td>
                                                    <td><?php echo $record->payAble - $record->totalAdminCommission; ?></td>
                                                </tr>
                                            <?php
                                                $cnt++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php else : ?>
                                    <p>No records found for the selected date range.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Payment History Table 2 -->

                        <div class="module">
                            <div class="module-head d-flex justify-content-between align-items-center">
                                <h3>Payment History</h3>
                                <form class="filter-form d-flex" method="GET" action="paymenthistory.php">
                                    <input type="date" id="fromDate" name="fromDate" class="form-control" value="<?php echo $fromDate ?>" required>
                                    <input type="date" name="toDate" id="toDate" class="form-control" value="<?php echo $toDate ?>" required>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                            </div>
                            <div class="module-body table">
                                <?php if (isset($result->records) && count($result->records) > 0) : ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>id</th>
                                                <th>Name</th>
                                                <th>Counter Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Commision</th>
                                                <th>Total Payment</th>
                                                <th>Payable <small>Price-Discount</small></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cnt = 0;
                                            foreach ($result->records as $record) {
                                            ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo $record->sellerId; ?></td>
                                                    <form action="paymentdetails.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $record->sellerId ?>">
                                                        <td><button type="submit"><?php echo $record->sellerName; ?></button></td>
                                                    </form>
                                                    <td><?php echo $record->counterName; ?></td>
                                                    <td><?php echo $record->phoneNo; ?></td>
                                                    <td><?php echo $record->email; ?></td>
                                                    <td><?php echo $record->totalAdminCommission; ?></td>
                                                    <td><?php echo $record->totalSubtotal; ?></td>
                                                    <td><?php echo $record->payAble - $record->totalAdminCommission; ?></td>
                                                </tr>
                                            <?php
                                                $cnt++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php else : ?>
                                    <p>No records found for the selected date range.</p>
                                <?php endif; ?>
                            </div>
                        </div>


                        <!-- Payment History Table 3 -->

                        <div class="module">
                            <div class="module-head d-flex justify-content-between align-items-center">
                                <h3>Payment History</h3>
                                <form class="filter-form d-flex" method="GET" action="paymenthistory.php">
                                    <input type="date" id="fromDated" name="fromDated" class="form-control" value="<?php echo $fromDated ?>" required>
                                    <input type="date" name="toDated" id="toDated" class="form-control" value="<?php echo $toDated ?>" required>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                            </div>
                            <div class="module-body table">
                                <?php if (isset($result2->records) && count($result2->records) > 0) : ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Delivery Id</th>
                                                <th>Name</th>
                                                <th>Delivered Items</th>
                                                <th>Ammount</th>
                                                <th>Mobile</th>
                                                <th>Account</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cnt = 0;
                                            foreach ($result2->records as $record) {
                                            ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo $record->deliveryId; ?></td>
                                                    <td><?php echo $record->name; ?></td>
                                                    <td><?php echo $record->total; ?></td>
                                                    <td><?php echo $record->total * $DELIVERYPRICE; ?></td>
                                                    <td><?php echo $record->phoneNo; ?></td>
                                                    <td><?php echo $record->accountNo; ?></td>
                                                </tr>
                                            <?php
                                                $cnt++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php else : ?>
                                    <p>No records found for the selected date range.</p>
                                <?php endif; ?>
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