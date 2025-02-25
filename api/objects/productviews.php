<?php

class Productviews
{

    private $conn;
    private $seller = "seller";
    private $delivery_boy = "delivery_boy";
    private $category = "category";
    private $customer_inquiry = "customer_inquiry";
    private $users = "users";
    private $user_type = "user_type";
    private $productvies = "productviews";
    private $cart = "cart";
    private $wall_upload_history = "wall_upload_history";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id, $userId, $userType, $city, $state, $name, $email,$email_id, $contactno, $password, $regDate, $seller_name,
    $seller_id,$father,$address, $counter_name, $mobile_no,$payment_status,$pincode,$created_on, $created_by, $emp_id, $alterMobile, $businessDay, $userWebsite,$price,$quality,$summary,$review,$reviewDate, $businessName, $establishmentYear, $paymentMode, $businessTiming, $userServices, $aboutUser, $status, $remark, $createdOn, $createdBy,$wallImg,$productId,$quantiy,$postingDate, $updatedOn, $updatedBy,$categoryName,$categoryImage,$creationDate,$updationDate,$value,$quantity,$orderId;

    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
   
   
    public function readProductView()
    {
        $query = "Select productId,quality,price,value,summary,review,reviewDate from " . $this->productvies;
         $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }


    public function insertProductView()
    {
         $query = "INSERT INTO
        " . $this->productvies. "
    SET      productId=:quality,
             price=:price,
             value=:value,
             quality=:quality,
             summary=:summary,
             reviewDate=:reviewDate,
             review=:review";           ;

        $stmt = $this->conn->prepare($query);
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->quality = htmlspecialchars(strip_tags($this->quality));
        $this->value = htmlspecialchars(strip_tags($this->value));
        $this->summary = htmlspecialchars(strip_tags($this->summary));
        $this->reviewDate = htmlspecialchars(strip_tags($this->reviewDate));
        $this->review = htmlspecialchars(strip_tags($this->review));
       
        
        $stmt->bindParam(":productId", $this->productId);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quwality", $this->quality);
        $stmt->bindParam(":value", $this->value);
        $stmt->bindParam(":summary", $this->summary);
        $stmt->bindParam(":reviewDate", $this->reviewDate);
        $stmt->bindParam(":review", $this->review);
        
       
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteProductView(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->productvies. " 
        WHERE productId=:productId";
    
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
        $this->productId=htmlspecialchars(strip_tags($this->productId));
      
        // bind id of record to delete
        $stmt->bindParam(":productId", $this->productId);
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
    function updateProductView()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->productvies . "
     SET
        
        productId=:productId,
        quality=:quality,
        summary=:summary
        where productId=:productId";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->quality = htmlspecialchars(strip_tags($this->quality));
        $this->summary = htmlspecialchars(strip_tags($this->summary));
      
      
        //bind values with stmt
        $stmt->bindParam(":productId", $this->productId);
        $stmt->bindParam(":quality", $this->quality);
        $stmt->bindParam(":summary", $this->summary);
        
        
        // execute query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function countCart()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->cart;

 
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