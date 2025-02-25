<?php

class Paymentdetails
{

    private $conn;
    private $paymentdetails = "paymentdetails";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id, $orderId, $amount,$refundId,$paymentMode,$status,$cgst,$createdOn,$createdBy,$productSkuId, $quantity, $total;
    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile,$updatedBy,$updatedOn, $requiredService;
    public function readpaymentdetails()
    {
        $query = "Select orderId,amount,refundId,paymentMode,status,createdOn,createdBy from " . $this->paymentdetails;
         $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":orderId", $this->orderId); 
        $stmt->execute();
        return $stmt;
    }


    public function insertpaymentdetails()
    {
         $query = "INSERT INTO
        " . $this->paymentdetails . "
    SET      orderId=:orderId,
             amount=:amount,
             rfundId=:refundId,
             paymentMode=:paymentMode,
             status=:status,
             createdBy=:createdBy,
             createdOn=:createdOn";
             
        $stmt = $this->conn->prepare($query);
        $this->orderId = htmlspecialchars(strip_tags($this->orderId));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->refundId = htmlspecialchars(strip_tags($this->refundId));
        $this->paymentMode = htmlspecialchars(strip_tags($this->paymentMode));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));




        
        $stmt->bindParam(":orderId", $this->orderId);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":refundId", $this->refundId);
        $stmt->bindParam(":paymentMode", $this->paymentMode);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":createdBy", $this->createdBy);
        $stmt->bindParam(":createdOn", $this->createdOn);        
        
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deletepaymentdetails(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->paymentdetails . " 
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
    function updatepaymentdetails()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->paymentdetails . "
     SET

        paymentMode=:paymentMode,
        amount=:amount,
        status=:status,
        refundId=:rufundId,
        updatedOn=:updatedOn,
        updatedBy=:updatedBy 
        where orderId=:orederId";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        
        $this->paymentMode = htmlspecialchars(strip_tags($this->paymentMode));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->refundId = htmlspecialchars(strip_tags($this->refundId));
        $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));

        //bind values with stmt
        $stmt->bindParam(":orderId", $this->orderId);
        $stmt->bindParam(":paymentMode", $this->paymentMode);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":refundId", $this->refundId);
        $stmt->bindParam(":updatedBy", $this->updatedBy);
        $stmt->bindParam(":updatedOn", $this->updatedOn);
       
        
        // execute query
        $stmt->execute();
            return $stmt;
        }

    function orderCountItem()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->paymentdetails;

 
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