<?php

class Producthistory
{

    private $conn;
    private $seller = "seller";
    private $producthistory = "producthistory";
    private $wall_upload_history = "wall_upload_history";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id,$name,$productId,$sizeAttributetId,$price,$colorAttributeId,$sizeAttributeId,$skuId,$quantity,$trending,$discount,$arrival,$bestselling,$categoriesId,$createdOn,$updatedOn,$createdBy,$summary,$sellerId;
   
   
    public function readProductById()
    {
         echo $query = "Select name,categoriesId,description,image,skuId
       ,price,discount from " . $this->producthistory
       . " where skuId=:skuId";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(":skuId", $this->skuId); 
        $stmt->execute();
        return $stmt;
    }


    public function readAllProduct()
    {
       $query = " Select name,categoriesId,description,image,sellerId,skuId,price,discount from " . $this->producthistory;
         $stmt = $this->conn->prepare($query);
        //  $stmt->bindParam(":skuId", $this->skuId); 
        $stmt->execute();
        return $stmt;
    }

    public function insertProducthistory()
    {
       // echo $this->sizeAttributeId;
        //echo $this->colorAttributeId;
         $query = "INSERT INTO
        " . $this->producthistory . "
    SET      productId=:productId,
             skuId=:skuId,
             discount=:discount,
             price=:price,
             createdOn=:createdOn,
             createdBy=:createdBy,
             quantity=:quantity";

        $stmt = $this->conn->prepare($query);
        // $this->productId = htmlspecialchars(strip_tags($this->productId));
        // $this->sizeAttributeId = htmlspecialchars(strip_tags($this->sizeAttributetId));
        // $this->colorAttributeId = htmlspecialchars(strip_tags($this->colorAttributeId));
        // $this->skuId = htmlspecialchars(strip_tags($this->skuId));
        // $this->price = htmlspecialchars(strip_tags($this->price));
        // $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        // $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        // $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        
       
        
        $stmt->bindParam(":productId", $this->productId);
        $stmt->bindParam(":skuId", $this->skuId);
        $stmt->bindParam(":discount", $this->discount);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":createdOn", $this->createdOn);
        $stmt->bindParam(":createdBy", $this->createdBy);
      

               
       
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deletproducthistory(){
  
        // delete user detatail
        $query = " DELETE FROM " . $this->producthistory. " 
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
    // function updateProduct()
    // {

        // query to update record
    //      $query = "UPDATE 
    //      " . $this->producthistory . "
    //  SET      
    //          p=:name,
    //          price=:price,
    //          description=:descripation,
    //          discount=:discount";

    //     $stmt = $this->conn->prepare($query);
    //     $this->name = htmlspecialchars(strip_tags($this->name));
    //     $this->price = htmlspecialchars(strip_tags($this->price));
    //     $this->description = htmlspecialchars(strip_tags($this->description));
    //     $this->discount = htmlspecialchars(strip_tags($this->discount));
       
        
    //     $stmt->bindParam(":name", $this->name);
    //     $stmt->bindParam(":price", $this->price);
    //     $stmt->bindParam(":description", $this->description);
    //     $stmt->bindParam(":discout", $this->discount);

        
        
    //     // execute query
    //     if ($stmt->execute()){
    //         return true;
    //     }

    //     return false;
    // }

    function countCart()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->producthistory;

 
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