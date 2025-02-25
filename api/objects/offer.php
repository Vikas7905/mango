<?php

class Offer
{

    private $conn;
    private $offer = "offer";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id, $offerId, $offerAmount, $offerName, $offerDuration, $createdOn,$createdBy,$updatedOn,$oupdatedBy;
    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
    public function readOffer()
    {
        $query = "Select offerId,offerAmount,offerName,offerDuration,createdOn,createdBy,updatedOn,updatedBy, from " . $this->offer;
         $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }


    public function insertOffer()
    {
         $query = "INSERT INTO
        " . $this->offer . "
    SET      offerId=:offerId,
             offerAmount=:offerAmount,
             offerName=:offerName,
             offerDuration=:offerDuration,
             createOn=:createOn,
             createdBy=:createdBy";

        $stmt = $this->conn->prepare($query);
        $this->offerId = htmlspecialchars(strip_tags($this->offerId));
        $this->offerAmount = htmlspecialchars(strip_tags($this->offerName));
        $this->offerName = htmlspecialchars(strip_tags($this->offerName));
        $this->offerDuration = htmlspecialchars(strip_tags($this->offerDuration));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));


        
        $stmt->bindParam(":offerId", $this->offerId);
        $stmt->bindParam(":offerAmount", $this->offerAmount);
        $stmt->bindParam(":offerName", $this->offerName);
        $stmt->bindParam(":offerDuration", $this->offerDuration);
        $stmt->bindParam(":createdOn", $this->createdOn);
        $stmt->bindParam(":createdBy", $this->createdBy);
        
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteOffer(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->offer . " 
        WHERE offerId=:offerId";
    
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
        $this->offerId=htmlspecialchars(strip_tags($this->offerId));
      
        // bind id of record to delete
        $stmt->bindParam(":offerId", $this->offerId);
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
    function updateOffer()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->offer . "
     SET
        offerName=:offerName,
        offerAmount=:offerAmount,
        offerDuration=:offerDuration where
        offerId=:offerId";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        $this->offerName = htmlspecialchars(strip_tags($this->offerName));
        $this->offerAmount = htmlspecialchars(strip_tags($this->offerAmount));
        $this->offerDuration = htmlspecialchars(strip_tags($this->offerDuration));
        

        //bind values with stmt
        $stmt->bindParam(":offerName", $this->offerName);
        $stmt->bindParam(":offerAmount", $this->offerAmount);
        $stmt->bindParam(":offerDuration", $this->offerDuration);
        $stmt->bindParam(":offerId", $this->offerId);
       
        
        // execute query
        $stmt->execute();
            return $stmt;
        }

    function orderOffer()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->offer;

 
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