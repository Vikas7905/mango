<?php

class Admincommisionhistory
{
    private $conn;
    private $commisionhistory = "commisionhistory";
    private $delivery_boy = "delivery_boy";
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

    public $id, $userId, $type, $city,$categoriesId, $state, $name, $email,$email_id, $amount, $regDate, $seller_name,$seller_id,$father,$address, $counter_name, $mobile_no,$payment_status,$pincode,$created_on, $created_by, $emp_id, $alterMobile, $businessDay, $userWebsite, $businessName, $establishmentYear, $paymentMode, $businessTiming, $userServices, $aboutUser, $status, $remark, $createdOn, $createdBy, $updatedOn, $updatedBy;

    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
   
   
    public function commisionHistoryRead()
    {
        $query = "Select categoriesId,type,amount,status,createdBy,createdOn from " . $this->commisionhistory . " where categoriesId=:categoriesId";
         
        $stmt = $this->conn->prepare($query);

        $this->categoriesId = htmlspecialchars(strip_tags($this->categoriesId));
        //$this->emp_id = htmlspecialchars(strip_tags(string: $this->emp_id));
        $stmt->bindParam(":categoriesId", $this->categoriesId); 
        $stmt->execute();
        return $stmt;
                
    }


    public function commisionHistoryInsert()
    {
         $query = "INSERT INTO
        " . $this->commisionhistory. "
    SET      type=:type,
             categoriesId=:categoriesId,
             status=:status,
             amount=:amount,
             creatdOn=:createdOn, 
             createdBy=:createdBy";           ;

        $stmt = $this->conn->prepare($query);
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->categoriesId = htmlspecialchars(strip_tags($this->categoriesId));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":categoriesId", $this->categoriesId);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":createdOn", $this->createdOn);
        $stmt->bindParam(":createdBy", $this->createdBy);
        
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function commisionHistoryDelete(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->commisionhistory . " 
        WHERE categoriesId=:categoriesId";
    
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
        $this->categoriesId=htmlspecialchars(strip_tags($this->categoriesId));
      
        // bind id of record to delete
        $stmt->bindParam(":categoriesId", $this->categoriesId);
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
    function commisionHistoryUpdate()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->commisionhistory . "
     SET
        type=:type,
        amount=:amount,
        status=:status
        where categoriesId=:categoriesId";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->status = htmlspecialchars(strip_tags($this->status));

        //bind values with stmt
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":categoriesId", $this->categoriesId);
        
        
        // execute query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function countDeliveryBoy()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->delivery_boy;

 
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