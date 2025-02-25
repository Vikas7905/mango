<?php

class Admin
{

    private $conn;
    private $seller = "seller";
    private $admin = "admin";
    private $delivery_boy = "delivery_boy";
    private $category = "category";
    private $customer_inquiry = "customer_inquiry";
    private $users = "users";
    private $user_type = "user_type";
    private $cart = "cart";
    private $useraddress = "address";
    private $wall_upload_history = "wall_upload_history";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id, $userId, $userType, $city, $state, $name, $email,$email_id, $contactno, $password, $regDate, $seller_name,
    $seller_id,$father,$address, $counter_name, $mobile_no,$payment_status,$pincode,$created_on, $created_by, $emp_id, $alterMobile, $businessDay, $userWebsite, $businessName, $establishmentYear, $paymentMode, $businessTiming, $userServices, $aboutUser, $status, $remark, $createdOn, $createdBy,$wallImg,$productId,$quantiy,$postingDate, $updatedOn, $updatedBy,$categoryName,$categoryImage,$creationDate,$updationDate,$quantity,$shippingStreet,$shippingAddress,$shippingPincode,$shippingState,$shippingCountry,
    $orderId,$shippingCity,$user_id,$username;

    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
   

    
    public function adminLogin()
    {
        $query = "Select username,password from $this->admin where username=:username and password=:password" ;
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password); 
        $stmt->execute();
        return $stmt;
    }

    public function readAdmin()
    {
        $query = "Select username,password from " . $this->admin;
         $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }


    public function insertAdmin()
    {
         $query = "INSERT INTO
        " . $this->useraddress. "
    SET      username=:username,
             password=:password,
             creationDate=:creationDate,
             updationDate=:updationDate";           ;

        $stmt = $this->conn->prepare($query);
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->creationDate = htmlspecialchars(strip_tags($this->creationDate));
        $this->updationDate = htmlspecialchars(strip_tags($this->updationDate));
       
        
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":creationDate", $this->creationDate);
        $stmt->bindParam(":updationDate", $this->updationDate);


        
       
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteAdmin(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->useraddress. " 
        WHERE id=:id";
    
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
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
      
        // bind id of record to delete
        $stmt->bindParam(":user_id", $this->user_id);
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
    function updateAdmin()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->useraddress . "
     SET
        
        password=:password,
        username=:username,
        where id=:id";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->id = htmlspecialchars(strip_tags($this->id));
      
        //bind values with stmt
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":id", $this->id);
        
        
        // execute query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function countAdmin()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->useraddress;

 
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