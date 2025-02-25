<?php

class Refunddetails
{

    private $conn;
    private $refunddetails = " refunddetails";
    private $delivery_boy = "delivery_boy";
    private $category = "category";
    private $customer_inquiry = "customer_inquiry";
    private $users = "users";
    private $user_type = "user_type";
    private $cart = "cart";
//    private $productreviews="productreviews";
    private $ordertrackhistory = "ordertrackhistory";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id, $userId, $sellerId, $amount, $description,$totalAmount, $email,$email_id, $contactno, $password, $regDate, $seller_name,
    $seller_id,$father,$address, $counter_name, $mobile_no,$payment_status,$pincode,$created_on, $created_by, $emp_id, $alterMobile, $businessDay, $userWebsite, $businessName, $establishmentYear, $paymentMode, $businessTiming, $userServices, $aboutUser, $status, $remark, $createdOn, $createdBy,$wallImg,$productId,$quantiy,$postingDate, $updatedOn, $updatedBy,$categoryName,$categoryImage,$creationDate,$updationDate,$quantity,$orderId,$productreviews;

    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
   
   
    public function readRefund()
    {
        $query = "Select orderId,sellerId,userId,amount,description,totalAmount,createdBy,createdOn from " . $this->refunddetails . "where userId=:userId";
         $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":userId", $this->userId); 
        $stmt->execute();
        return $stmt;
    }


    public function insertRefund()
    {
         $query = "INSERT INTO
        " . $this->refunddetails. "
    SET      orderId=:orderId,
             sellerId=:sellerId,
             userId=:userId,
             amount=:amount,
             totalAmount=:totalAmount,
             description=:description,
             createdOn=:createdOn,
             createdBy=:createdBy";           ;

        $stmt = $this->conn->prepare($query);
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->sellerId = htmlspecialchars(strip_tags($this->sellerId));
        $this->orderId = htmlspecialchars(strip_tags($this->orderId));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->totalAmount = htmlspecialchars(strip_tags($this->totalAmount));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
       
        
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":sellerId", $this->sellerId);
        $stmt->bindParam(":orderId", $this->orderId);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":totalAmount", $this->totalAmount);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":createdBy", $this->createdBy);
        $stmt->bindParam(":createdOn", $this->createdOn);

        
       
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteRefund(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->ordertrackhistory. " 
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
        $this->userId=htmlspecialchars(strip_tags($this->userId));
      
        // bind id of record to delete
        $stmt->bindParam(":userId", $this->userId);
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
    function updateRefund()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->refunddetails . "
     SET
        
        amount=:amount,
        orderId=:orderId,
        totalAmount=:totalAmount,
        descripiton=:descripiton,
        sellerId=:sellerId,
        where userId=:userId";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->orderId = htmlspecialchars(strip_tags($this->orderId));
        $this->totalAmount = htmlspecialchars(strip_tags($this->totalAmount));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->sellerId = htmlspecialchars(strip_tags($this->sellerId));
      
        //bind values with stmt
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":orderId", $this->orderId);
        $stmt->bindParam(":totalAmount", $this->totalAmount);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":sellerId", $this->sellerId);
        $stmt->bindParam(":userId", $this->userId);
        
        
        // execute query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function countHistory()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->ordertrackhistory;

 
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