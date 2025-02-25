<?php

class Arrival
{

    private $conn;
    private $seller = "seller";
    private $arrival = "arrival";
    private $user_profile_history = "user_profile_history";
    private $business_category = "business_category";
    private $customer_inquiry = "customer_inquiry";
    private $users = "users";
    private $user_type = "user_type";
    private $wall_uploads = "wall_uploads";
    private $wall_upload_history = "wall_upload_history";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id, $userId, $userType, $city, $state, $name, $email,$email_id, $contactno, $password, $regDate, $seller_name,$seller_id,$address, $counter_name, $mobile_no,$payment_status,$pincode,$created_on, $categoryId, $userAddress, $alterMobile, $businessDay, $userWebsite, $businessName, $establishmentYear, $paymentMode, $businessTiming, $userServices, $aboutUser, $status, $remark, $createdOn, $createdBy,$wallImg,$price,$productName,$productDescription, $updatedOn, $updatedBy;

    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
   
   
    public function readArrival()
    {
        echo $query = "Select productName,productDescription,price from " . $this->arrival;
         $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }


    public function insertArrival()
    {
         $query = "INSERT INTO
        " . $this->arrival. "
    SET      productName=:productName,
             productDescription=:productDescription,
             price=:price,
             createdOn=:createdOn";           ;

        $stmt = $this->conn->prepare($query);
        $this->productName = htmlspecialchars(strip_tags($this->productName));
        $this->productDescription = htmlspecialchars(strip_tags($this->productDescription));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));

        
        $stmt->bindParam(":productName", $this->productName);
        $stmt->bindParam(":productDescription", $this->productDescription);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":createdOn", $this->createdOn);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteseller(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->arrival . " 
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
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        // bind id of record to delete
        $stmt->bindParam(":id", $this->id);
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
    function updateseller()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->seller . "
     SET
        seller_name=:seller_name,
        counter_name=:counter_name,
        mobile_no=:mobile_no,
        email_id=:email_id
        where seller_id=:seller_id";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        
        $this->seller_name = htmlspecialchars(strip_tags($this->seller_name));
        $this->counter_name = htmlspecialchars(strip_tags($this->counter_name));
        $this->mobile_no = htmlspecialchars(strip_tags($this->mobile_no));
        $this->email_id = htmlspecialchars(strip_tags($this->email_id));
        $this->seller_id = htmlspecialchars(strip_tags($this->seller_id));

        //bind values with stmt
        $stmt->bindParam(":seller_id", $this->seller_id);
        $stmt->bindParam(":seller_name", $this->seller_name);
        $stmt->bindParam(":counter_name", $this->counter_name);
        $stmt->bindParam(":mobile_no", $this->mobile_no);
        $stmt->bindParam(":email_id", $this->email_id);
        
        
        // execute query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function countUser()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->users;

 
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