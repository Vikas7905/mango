<?php

class Productskuid
{

    private $conn;
    private $productskuid = "productskuid";
    private $products = "products";
    private $wall_upload_history = "wall_upload_history";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id,$productId,$sizeAttributeId,$colorAttributeId,$price,$skuId,$quantity,$createdBy,$createdOn,$updatedOn,$updatedBy;

   
   
    public function readProductsku()
    {
         $query = "Select productId,sizeAttributeId,colorAttributeId,price,quqntity,
       ,createdBy,createdOn from " . $this->productskuid . " where skuId=:skuId";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(":skuId", $this->skuId); 
        $stmt->execute();
        return $stmt;
    }


    

    public function insertProductSku()
    {
 $query = "INSERT INTO
        " . $this->productskuid. "
        set  productId=:productId,
             skuId=:skuId,
             price=:price,
             createdOn=:createdOn,
             createdBy=:createdBy,
             quantity=:quantity";

        $stmt = $this->conn->prepare($query);
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->skuId = htmlspecialchars(strip_tags($this->skuId));
        // $this->sizeAttributeId = (($this->sizeAttributeId));
        // $this->colorAttributeId = (($this->colorAttributeId));
        $this->price = (($this->price));
        $this->quantity = (($this->quantity));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        
       
        
        $stmt->bindParam(":productId", $this->productId);
        // $stmt->bindParam(":sizeAttributeId", $this->sizeAttributeId);
        // $stmt->bindParam(":colorAttributeId", $this->colorAttributeId);
        $stmt->bindParam(":skuId", $this->skuId);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":createdOn", $this->createdOn);
        $stmt->bindParam(":createdBy", $this->createdBy);
      
        //$stmt->debugDumpParams();
       // print_r($stmt->debugDumpParams());
 
      

               
       
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deletProducts(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->productskuid. " 
        WHERE skuId=:skuId";
    
       
        // prepare query
        $stmt = $this->conn->prepare($query);
       
        // sanitize
        $this->skuId=htmlspecialchars(strip_tags($this->skuId));
      
        // bind id of record to delete
        $stmt->bindParam(":skuId", $this->skuId);
       
        // execute query
        if ($stmt->execute()){
            return true;
        }
      
        return false;
    }
    function updateProduct()
    {

        // query to update record
         $query = "UPDATE 
         " . $this->productskuid . "
     SET      
             sizeAttribute=:sizeAttribute,
             colorAttribute=:colorAttribute,
             price=:price,
             quantity=:quantity where skuId=:skuId";

        $stmt = $this->conn->prepare($query);
        $this->sizeAttributeId = htmlspecialchars(strip_tags($this->sizeAttributeId));
        $this->colorAttributeId = htmlspecialchars(strip_tags($this->colorAttributeId));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
       
        
        $stmt->bindParam(":sizeAttribute", $this->sizeAttributeId);
        $stmt->bindParam(":colorAttribute", $this->colorAttributeId);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":skuId", $this->skuId);

        
        
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
         " . $this->products;

 
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