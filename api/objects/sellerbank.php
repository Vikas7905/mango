<?php

class Sellerbank
{

    private $conn;
    private $sellerbankdetails = "sellerbankdetails";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id,$sellerId,$bankName,$AccountHolderName,$ifscCode,$upiId,$accountNo,$createdBy,$createdOn,$updatedBy,$updatedOn;

    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
   
   
    public function readsellerBank()
    {
        $query = "Select sellerName,counterName,address,city,pincode,phoneNo,email from " . $this->sellerbankdetails;
         $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }


    public function insertsellerBank()
    {
         echo $query = "INSERT INTO
        " . $this->sellerbankdetails. "
    SET      sellerId=:sellerId,
             createdOn=:createdOn,
             createdBy=:createdBy";           ;

        $stmt = $this->conn->prepare($query);
        $this->sellerId = htmlspecialchars(strip_tags($this->sellerId));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        
        $stmt->bindParam(":sellerId", $this->sellerId);
        $stmt->bindParam(":createdOn", $this->createdOn);
        $stmt->bindParam(":createdBy", $this->createdBy);
      
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteseller(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->sellerbankdetails . " 
        WHERE sellerId=:sellerId";
    
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
        $this->sellerId=htmlspecialchars(strip_tags($this->sellerId));
      
        // bind id of record to delete
        $stmt->bindParam(":sellerId", $this->sellerId);
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
    function updatesellerbank()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->sellerbankdetails . "
     SET
        bankName=:bankName,
        accountNo=:accountNo,
        ifscCode=:ifscCode,
        upiId=:upiId,
        updatedOn=:updatedOn,
        updatedBy=:updatedBy
        where sellerId=:id";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        
        $this->bankName = htmlspecialchars(strip_tags($this->bankName));
        $this->ifscCode = htmlspecialchars(strip_tags($this->ifscCode));
        $this->upiId = htmlspecialchars(strip_tags($this->upiId));

        //bind values with stmt
        $stmt->bindParam(":bankName", $this->bankName);
        $stmt->bindParam(":accountNo", $this->accountNo);
        $stmt->bindParam(":ifscCode", $this->ifscCode);
        $stmt->bindParam(":updatedOn", $this->updatedOn);
        $stmt->bindParam(":updatedBy", $this->updatedBy);
        $stmt->bindParam(":upiId", $this->upiId);
        $stmt->bindParam(":id", $this->id);
        
        // execute query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function countseller()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->sellerbankdetails;

 
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