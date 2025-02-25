<?php

class Useracountdetails
{

    private $conn;
    private $useracountdetails = "useracountdetails";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id, $userId, $bankName, $AccontHolderName, $ifscCode, $accountNo,$contactno, $password, $phoneNo, $userMobile, $updationDate, $businessCategory, $categoryId, $userAddress, $alterMobile, $businessDay, $userWebsite, $businessName, $establishmentYear, $paymentMode, $businessTiming, $userServices, $aboutUser, $status, $remark, $createdOn, $createdBy,$wallImg, $updatedOn,$updatedBy,$lastLogin;

    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
    public function readUserAccount()
    {
        $query = "Select userId,bankName,AccountHolderName,ifscCode,accountNo,createdOn,createdBy from " . $this->useracountdetails . " where userId=:userId";
         $stmt = $this->conn->prepare($query);
         $this->userId = htmlspecialchars(strip_tags($this->userId));
         $stmt->bindParam(":userId", $this->userId);
        $stmt->execute();
        return $stmt;
    }


    public function insertUserAccount()
    {
         $query = "INSERT INTO
        " . $this->useracountdetails . "
    SET      userId=:userId,
             bankName=:bankName,
             AccountHolderName=:AccountHolderName,
             ifscCode=:ifscCode, 
             accountNo=:accountNo,
             createdBy=:createdBy,
             createdOn=:createdOn";

        $stmt = $this->conn->prepare($query);
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->bankName = htmlspecialchars(strip_tags($this->bankName));
        $this->AccontHolderName = htmlspecialchars(strip_tags($this->AccontHolderName));
        $this->ifscCode = htmlspecialchars(strip_tags($this->ifscCode));
        $this->accountNo = htmlspecialchars(strip_tags($this->accountNo));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));

        
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":bankName", $this->bankName);
        $stmt->bindParam(":AccountHolderName", $this->AccontHolderName);
        $stmt->bindParam(":ifscCode", $this->ifscCode);
        $stmt->bindParam(":accountNo", $this->accountNo);
        $stmt->bindParam(":createdBy", $this->createdBy);
        $stmt->bindParam(":createdOn", $this->createdOn);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteUser(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->useracountdetails . " 
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
    function updateUser()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->useracountdetails . "
     SET

        AccountHolderName=:AccountHolderName,
        bankName=:bankName,
        accountNo=:accountNo,
        ifscCode=:ifscCode
        where userId=:userId";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        $this->AccontHolderName = htmlspecialchars(strip_tags($this->AccontHolderName));
        $this->bankName = htmlspecialchars(strip_tags($this->bankName));
        $this->accountNo = htmlspecialchars(strip_tags($this->accountNo));
        $this->ifscCode = htmlspecialchars(strip_tags($this->ifscCode));
       // $this->password = htmlspecialchars(strip_tags($this->password));

        //bind values with stmt
        $stmt->bindParam(":AccountHolderName", $this->AccontHolderName);
        $stmt->bindParam(":bankName", $this->bankName);
        $stmt->bindParam(":accountNo", $this->accountNo);
        $stmt->bindParam(":ifscCode", $this->ifscCode);
        
        
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
         " . $this->useracountdetails;

 
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