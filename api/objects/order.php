<?php

class Order
{

    private $conn;
    private $orderdetails = "orderdetails";
    private $orderItem = "orderitem";
    private $products = "products";
    private $users = "users";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $productSkuId, $cgst, $sgst, $orderSGST,$orderCGST, $price, $discount, $quantity, $productId, $orderId, $createdBy, $adminCommision;
    public $id, $userId, $sellerId, $sellerName,$deliveryBoyId, $paymentId, $total, $paymentResponse;
    public $cuId, $cuName, $name,$cuEmail, $cuAddress, $cuMobile, $requiredService,$totalQuantity;
    public function readOrder()
    {
        $query = "Select userId,sellerId,deliveryBoyId,paymentId from " . $this->orderItem;
        $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }




    public function order_view()
    {
        $query = "Select a.userId,a.orderId,name,a.createdOn,a.productId,a.productSkuId,a.quantity,a.total from  $this->orderItem as a left join $this->products as b on productSkuId=skuId where orderId=:orderId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":orderId", $this->orderId); 
        $stmt->execute();
        return $stmt;
    }


    public function readOrdersById()
    {

        if ($this->paymentId == "ALL" && $this->userId != "") {
            
                         $query = "Select b.userId,a.orderId,a.productId,a.productSkuId,a.quantity,a.discount,a.price,a.total itemTotal,b.total orderTotal, 
            a.sgst,a.cgst,b.sgst as orderSGST,b.cgst as orderCGST,f.name as name,b.sellerId as mainSeller,b.deliveryId,b.status,b.deliveryAddress,b.deliveryInstruction,b.paymentResponse,b.totalQuantity, 'null' as pName,
            a.createdOn,a.createdBy,b.paymentId,a.subId,a.sellerId, a.sellerName from " . $this->orderItem . "  a left join " . $this->orderdetails . " b on a.orderId=b.orderid 
            INNER JOIN " . $this->users . " as f ON f.email = b.userId where a.userId=:userId GROUP BY a.orderId";

        } else if ($this->paymentId != "ALL" && $this->userId != "") {
            
            $query = "Select b.userId,a.orderId,a.productId,a.productSkuId,a.quantity,a.discount,a.price,a.total itemTotal,b.total orderTotal, 
            a.sgst,a.cgst,f.name as name,b.sgst as orderSGST,b.cgst as orderCGST,b.sellerId as mainSeller,b.deliveryId,b.status,b.deliveryAddress,b.deliveryInstruction,b.paymentResponse,b.totalQuantity, p.name as pName,
            a.createdOn,a.createdBy,b.paymentId,a.subId,a.sellerId, a.sellerName  from " . $this->orderItem . "  a left join " . $this->orderdetails . " b on a.orderId=b.orderid
             INNER JOIN " . $this->users . " as f ON f.email = b.userId left join " . $this->products . " as p on a.productSkuId=p.skuId where (b.orderId=:paymentResponse or a.subId=:paymentResponse) and a.userId=:userId";
        }
        else {
            $query = "Select b.userId,a.orderId,a.productId,a.productSkuId,a.quantity,a.discount,a.price,a.total itemTotal,b.total orderTotal, 
            a.sgst ,a.cgst,b.sgst as orderSGST,b.cgst as orderCGST,b.sellerId as mainSeller,b.deliveryId,b.status,b.deliveryAddress,b.deliveryInstruction,b.paymentResponse,b.totalQuantity, 'null' as pName,
            a.createdOn,a.subId ,a.createdBy,b.paymentId,a.sellerId, a.sellerName from " . $this->orderItem . "  a left join " . $this->orderdetails . " b on a.orderId=b.orderid";
        }
        $stmt = $this->conn->prepare($query);
        if ($this->paymentId != "ALL" && $this->userId != "") {
            $stmt->bindParam(":paymentResponse", $this->paymentId);
            $stmt->bindParam(":userId", $this->userId);
        }
        else  if ($this->paymentId == "ALL" && $this->userId != "") {
            $stmt->bindParam(":userId", $this->userId);
        }
      
        $stmt->execute();
        return $stmt;
    }

    public function insertOrder()
    {
         $query = "INSERT INTO
        " . $this->orderdetails . "
    SET      userId=:userId,
    orderId=:orderId,
    paymentId=:paymentId,
             sellerId=:sellerId,
             adminCommision=:adminCommision,
             	createdBy=	:createdBy,
             total=:total";

        $stmt = $this->conn->prepare($query);
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->sellerId = htmlspecialchars(strip_tags($this->sellerId));
        $this->paymentId = htmlspecialchars(strip_tags($this->paymentId));
        $this->deliveryBoyId = htmlspecialchars(strip_tags($this->deliveryBoyId));

        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":sellerId", $this->sellerId);
        $stmt->bindParam(":paymentId", $this->paymentId);
        $stmt->bindParam(":orderId", $this->orderId);

        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":adminCommision", $this->adminCommision);
        $stmt->bindParam(":createdBy", $this->createdBy);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function insertOrderItem()
    {
        $query = "INSERT INTO
        " . $this->orderItem . "
    SET      userId=:userId,
    orderId=:orderId,
    productId=:productId,
             productSkuId=:productSkuId,
             quantity=:quantity,
             discount=:discount,
             price=:price,
             sgst=:sgst,
             cgst=:cgst,
             createdBy=:createdBy,
             total=:total";

        $stmt = $this->conn->prepare($query);
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->sellerId = htmlspecialchars(strip_tags($this->sellerId));
        $this->paymentId = htmlspecialchars(strip_tags($this->paymentId));
        $this->deliveryBoyId = htmlspecialchars(strip_tags($this->deliveryBoyId));



        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":orderId", $this->orderId);
        $stmt->bindParam(":productId", $this->productId);
        $stmt->bindParam(":productSkuId", $this->productSkuId);

        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":discount", $this->discount);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":total", $this->total);

        $stmt->bindParam(":cgst", $this->cgst);
        $stmt->bindParam(":sgst", $this->sgst);
        $stmt->bindParam(":createdBy", $this->createdBy);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteOrder()
    {

        // delete user detatail
        $query = " DELETE FROM " . $this->orderdetails . " 
        WHERE userId=:userId";

        // $query2 = " DELETE FROM " . $this->user_profile . " 
        // WHERE userId=:id";

        // $query3 = " DELETE FROM " . $this->user_profile_history . " 
        // WHERE userId=:id";

        // $query4 = " DELETE FROM " . $this->wall_uploads . " 
        // WHERE userId=:id";

        // $query5 = " DELETE FROM " . $this->wall_upload_history . " 
        // WHERE userId=:id";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // $stmt2 = $this->conn->prepare($query2);
        // $stmt3 = $this->conn->prepare($query3);
        // $stmt4 = $this->conn->prepare($query4);
        // $stmt5 = $this->conn->prepare($query5);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(":userId", $this->userId);
        // $stmt2->bindParam(":id", $this->id);
        // $stmt3->bindParam(":id", $this->id);
        // $stmt4->bindParam(":id", $this->id);
        // $stmt5->bindParam(":id", $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    function updateOrder()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->orderdetails . "
     SET
        userId=:userId,
        paymentId=:paymentId,
        sellerId=:sellerId,
        deliveryBoyId=:deliveryBoyId";


        // prepare query
        $stmt = $this->conn->prepare($query);

        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->paymentId = htmlspecialchars(strip_tags($this->paymentId));
        $this->sellerId = htmlspecialchars(strip_tags($this->sellerId));
        $this->deliveryBoyId = htmlspecialchars(strip_tags($this->deliveryBoyId));

        //bind values with stmt
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":paymentId", $this->paymentId);
        $stmt->bindParam(":sellerId", $this->sellerId);
        $stmt->bindParam(":deliveryBoyId", $this->deliveryBoyId);


        // execute query
        $stmt->execute();
        return $stmt;
    }

    function orderCount()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->orderdetails;


        // prepare query
        $stmt = $this->conn->prepare($query);

        // $this->id = htmlspecialchars(strip_tags($this->id));
        // $this->name = htmlspecialchars(strip_tags($this->name));
        // $this->email = htmlspecialchars(strip_tags($this->email));
        // $this->contactno = htmlspecialchars(strip_tags($this->contactno));

        // //bind values with stmt
        // $stmt->bindParam(":id", $this->id);
        // $stmt->bindParam(":name", $this->name);
        // $stmt->bindParam(":email", $this->email);
        // $stmt->bindParam(":contactno", $this->contactno);


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
?>