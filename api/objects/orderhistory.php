<?php

class Orderhistory
{

    private $conn;
    private $seller = "seller";
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

    public $id, $userId, $userType, $city, $state, $name, $email,$email_id, $contactno, $password, $regDate, $seller_name,
    $seller_id,$father,$address, $counter_name, $mobile_no,$payment_status,$pincode,$created_on, $created_by, $emp_id, $alterMobile, $businessDay, $userWebsite, $businessName, $establishmentYear, $paymentMode, $businessTiming, $userServices, $aboutUser, $status, $remark, $createdOn, $createdBy,$wallImg,$productId,$quantiy,$postingDate, $updatedOn, $updatedBy,$categoryName,$categoryImage,$creationDate,$updationDate,$quantity,$orderId,$productreviews;

    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
   
   
    public function readHistory()
    {
        $query = "Select orderId,status,remark from " . $this->ordertrackhistory;
         $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }


    public function insertHistory()
    {
         $query = "INSERT INTO
        " . $this->ordertrackhistory. "
    SET      orderId=:orderId,
             status=:status,
             remark=:remark,
             postingDate=:postingDate";           ;

        $stmt = $this->conn->prepare($query);
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->quantity = htmlspecialchars(strip_tags($this->creationDate));
        $this->updationDate = htmlspecialchars(strip_tags($this->updationDate));
       
        
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":productId", $this->productId);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":postingDate", $this->postingDate);
        
       
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteHistory(){
  
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
    function updateHistory()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->ordertrackhistory . "
     SET
        
        productId=:productId,
        quantity=:quantity,
        postingDate=:postingDate
        where userId=:userId";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->postingDate = htmlspecialchars(strip_tags($this->postingDate));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
      
        //bind values with stmt
        $stmt->bindParam(":productId", $this->productId);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":postinDate", $this->postingDate);
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