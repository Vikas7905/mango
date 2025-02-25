<?php

class OrderItem
{

    private $conn;
    private $orderitem = "orderitem";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id, $orderId, $productId,$discount,$price,$sgst,$cgst,$createdOn,$createdBy,$productSkuId, $quantity, $total;
    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
    public function readOrderItem()
    {
        $query = "Select orderId,productId,productSkuId,quantity,discount,price,total,sgst,cgst from " . $this->orderitem;
         $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }


    public function insertOrderItem()
    {
         $query = "INSERT INTO
        " . $this->orderitem . "
    SET      orderId=:orderId,
             productId=:productId,
             productSkuId=:productSkuId,
             quantity=:quantity,
             discount=:discount,
             price=:price,
             total=:total,
             sgst=:sgst,
             cgst=:cgst,
             createdOn=:createdOn,
             createdBy=:createdBy,
             orderId=:orderId";

        $stmt = $this->conn->prepare($query);
        $this->orderId = htmlspecialchars(strip_tags($this->orderId));
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->productSkuId = htmlspecialchars(strip_tags($this->productSkuId));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->discount = htmlspecialchars(strip_tags($this->discount));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->total = htmlspecialchars(strip_tags($this->total));
        $this->sgst = htmlspecialchars(strip_tags($this->sgst));
        $this->cgst = htmlspecialchars(strip_tags($this->cgst));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));




        
        $stmt->bindParam(":orderId", $this->orderId);
        $stmt->bindParam(":productId", $this->productId);
        $stmt->bindParam(":productSkuId", $this->productSkuId);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":discount", $this->discount);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":sgst", $this->sgst);
        $stmt->bindParam(":cgst", $this->cgst); 
        $stmt->bindParam(":createdOn", $this->createdOn);
        $stmt->bindParam(":createdBy", $this->createdBy);
        
        
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteOrderItem(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->orderitem . " 
        WHERE orderId=:orderId";
    
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
        $this->orderId=htmlspecialchars(strip_tags($this->orderId));
      
        // bind id of record to delete
        $stmt->bindParam(":orderId", $this->orderId);
        // $stmt2->bindParam(":id", $this->id);
        // $stmt3->bindParam(":id", $this->id);
        // $stmt4->bindParam(":id", $this->id);
        // $stmt5->bindParam(":id", $this->id);
      
        // execute query
        if ($stmt->execute()){
            return true;
        }
      
        return false;
    }
    function updateOrderItem()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->orderitem . "
     SET
        orderId=:orderId,
        productId=:productId,
        productSkuId=:productSkuId,
        quantity=:quantity";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        $this->orderId = htmlspecialchars(strip_tags($this->orderId));
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->productSkuId = htmlspecialchars(strip_tags($this->productSkuId));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));

        //bind values with stmt
        $stmt->bindParam(":orderId", $this->orderId);
        $stmt->bindParam(":productId", $this->productId);
        $stmt->bindParam(":productSkuId", $this->productSkuId);
        $stmt->bindParam(":quantity", $this->quantity);
       
        
        // execute query
        $stmt->execute();
            return $stmt;
        }

    function orderCountItem()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->orderitem;

 
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
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

  }
?>