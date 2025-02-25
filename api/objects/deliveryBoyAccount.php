<?php

class DeliveryBoyAccount
{

    private $conn;
    private $deliverybankdetails = "deliverybankdetails";
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

    public $id, $userId, $userType, $city, $state, $name, $email,$email_id, $contactno, $password, $regDate, $seller_name,$seller_id,$father,$address, $counter_name, $mobile_no,$payment_status,$pincode,$created_on, $created_by, $emp_id, $alterMobile, $businessDay, $userWebsite, $deliveryId, $establishmentYear, $paymentMode, $businessTiming, $userServices, $aboutUser, $status, $remark, $createdOn, $createdBy,$accountHolderName,$wallImg,$bankName,$workingAddress,$deleveryId,$regidenceAddress,$workingPincode,$phoneNo,$ifscCode, $updatedOn,$accountNo, $updatedBy;

    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
   
   
    public function readDeliveryBoyBank()
    {
        $query = "Select deliveryId,bankName,AccountHolderName,ifscCode,accontNo,createdBy,createdOn from " . $this->deliverybankdetails . " where deleveryId=:deleveryId";
         
        $stmt = $this->conn->prepare($query);

        $this->deleveryId = htmlspecialchars(strip_tags($this->deleveryId));
        //$this->emp_id = htmlspecialchars(strip_tags(string: $this->emp_id));
        $stmt->bindParam(":deleveryId", $this->deleveryId); 
        $stmt->execute();
        return $stmt;
                
    }


    public function insertDeliveryBoyBank()
    {
         $query = "INSERT INTO
        " . $this->delivery_boy. "
    SET      deliveryId=:deliveryId,
             bankName=:bankName,
             accountHolderName=:phoneNo,
             ifscCode=:ifscCode, 
             accountNo=:accountNo,
             createdOn=:createdOn
             createdBy=:createdBy";           ;

        $stmt = $this->conn->prepare($query);
        $this->deliveryId = htmlspecialchars(strip_tags($this->deliveryId));
        $this->bankName = htmlspecialchars(strip_tags($this->bankName));
        $this->accountHolderName = htmlspecialchars(strip_tags($this->accountHolderName));
        $this->accountNo = htmlspecialchars(strip_tags($this->accountNo));
        $this->ifscCode = htmlspecialchars(strip_tags($this->ifscCode));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
       
        
        $stmt->bindParam(":deliveryId", $this->deliveryId);
        $stmt->bindParam(":bankName", $this->bankName);
        $stmt->bindParam(":accountHolderName", $this->accountHolderName);
        $stmt->bindParam(":accountNo", $this->accountNo);
        $stmt->bindParam(":createdOn", $this->createdOn);
        $stmt->bindParam(":createdBy", $this->createdBy);
       
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteDelivery(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->deliverybankdetails . " 
        WHERE deliveryId=:deliveryId";
    
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
        $this->deliveryId=htmlspecialchars(strip_tags($this->deliveryId));
      
        // bind id of record to delete
        $stmt->bindParam(":deliveryId", $this->deliveryId);
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
    function deliveryBankDetailsUpdate()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->deliverybankdetails . "
     SET
        accountHolderName=:accountHolderName,
        bankName=:bankName,
        ifscCode=:ifscCode,
        accountNo=:accountNo,
        createdBy=:createdBy,
        createdOn=:createdOn,
        where deliveryId=:deliveryId";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        
        $this->accountHolderName = htmlspecialchars(strip_tags($this->accountHolderName));
        $this->bankName = htmlspecialchars(strip_tags($this->bankName));
        $this->ifscCode = htmlspecialchars(strip_tags($this->ifscCode));
        $this->accountNo = htmlspecialchars(strip_tags($this->accountNo));
        $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));
       
        //bind values with stmt
        $stmt->bindParam(":accountHolderName", $this->accountHolderName);
        $stmt->bindParam(":bankName", $this->bankName);
        $stmt->bindParam(":ifscCode", $this->ifscCode);
        $stmt->bindParam(":accountNo", $this->accountNo);
        $stmt->bindParam(":updatedOn", $this->updatedOn);
        $stmt->bindParam(":updatedBy", $this->updatedBy);
        $stmt->bindParam(":deliveryId", $this->deliveryId);
        
        
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