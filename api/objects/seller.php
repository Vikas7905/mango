<?php

class Seller
{

    private $conn;
    private $seller = "seller";
    private $selleraddress="selleraddress";
    private $sellerbankdetails="sellerbankdetails";
    private $orderdetails="orderdetails";
    private $orderItem="orderitem";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id,$sellerName,$counterName,$gst,$updatedBy,$status, $sellerId, $pan,$address,$city,$date,$pincode,$sgst,$cgst,$aadhar,$image,$phonNo,$regFee,$depositAmount,$password,$pwd,$createdOn,$createdBy,$updatedOn,$phoneNo,$email, $fromDate, $toDate;

    public $cuId, $cuName,$cuEmail, $cuAddress, $cuMobile, $requiredService;
   
   
    public function readseller()
    {
        $query = "Select a.sellerName,a.counterName,a.id,a.password,a.pan,a.gst,b.city,b.pincode,a.createdOn,b.address,a.aadhar,image,phoneNo,regFee,depositAmount,email,status from " . $this->seller .  " as a INNER JOIN " . $this->selleraddress . " as b ON b.sellerId=a.id JOIN " . $this->selleraddress . " as c ON c.sellerId=a.id";
         $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }
    // public function readSellerPay1() {
    //     $query = "SELECT a.sellerName, a.counterName, a.id, a.password, a.pan, a.gst, b.city, b.pincode, a.createdOn, b.address, a.aadhar, image, phoneNo, regFee, depositAmount, email, a.status, SUM(o.total) AS sTotal, SUM(o.adminCommision) AS adminCommision, SUM(o.subTotal) AS sub, SUM(z.discount) AS discount, o.createdOn AS orderc, SUM(CASE WHEN DATE(o.createdOn) = CURDATE() THEN o.total ELSE 0 END) AS todaysTotal, SUM(CASE WHEN DATE(o.createdOn) = CURDATE() THEN z.discount ELSE 0 END) AS todaysDiscount, SUM(CASE WHEN DATE(o.createdOn) = CURDATE() THEN o.adminCommision ELSE 0 END) as todaysCommision FROM " . $this->seller . " AS a INNER JOIN " . $this->selleraddress . " AS b ON b.sellerId = a.id
    //               JOIN " . $this->selleraddress . " AS c ON c.sellerId = a.id
    //               JOIN " . $this->orderdetails . " AS o ON a.id = o.sellerId
    //               JOIN " . $this->orderItem . " AS z ON o.orderId = z.orderId
    //               GROUP BY o.sellerId";
                  
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     return $stmt;
    // }

    public function readSellerPay(){
    $query = "SELECT b.sellerName, b.counterName, b.email, b.phoneNo, productId, a.sellerId, quantity, SUM(subTotal) AS total_subtotal, SUM(discount * quantity) AS total_discount,
    SUM(subTotal - (subTotal * (discount * quantity) / 100)) AS total_after_discount, SUM(adminCommision) AS total_admin_commission,
    SUM(total) as payAble, SUM(cgst) as cgst, SUM(sgst) as sgst FROM $this->orderItem as a INNER JOIN $this->seller as b on a.sellerId=b.id GROUP BY sellerId";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
    }

    public function readSellerPayId() {
        $query = "SELECT b.sellerName, b.counterName, b.email, b.phoneNo, productId, a.sellerId, quantity, SUM(subTotal) AS total_subtotal, SUM(discount * quantity) AS total_discount,
    SUM(subTotal - (subTotal * (discount * quantity) / 100)) AS total_after_discount, SUM(adminCommision) AS total_admin_commission,
    SUM(total) as payAble, SUM(cgst) as cgst, SUM(sgst) as sgst FROM $this->orderItem as a INNER JOIN $this->seller as b on a.sellerId=b.id WHERE sellerId=:sellerId GROUP BY sellerId";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":sellerId", $this->sellerId);
        $stmt->execute();
        return $stmt;
    }

    public function readSellerPayDate($fromDate, $toDate){
        $query = "SELECT b.sellerName, b.counterName, b.email, b.phoneNo, productId, a.sellerId, quantity, SUM(subTotal) AS total_subtotal, SUM(discount * quantity) AS total_discount,
        SUM(subTotal - (subTotal * (discount * quantity) / 100)) AS total_after_discount, SUM(adminCommision) AS total_admin_commission,
        SUM(total) as payAble, SUM(cgst) as cgst, SUM(sgst) as sgst FROM $this->orderItem as a INNER JOIN $this->seller as b on a.sellerId=b.id  WHERE a.createdOn BETWEEN :fromDate AND :toDate GROUP BY sellerId";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
        $stmt->execute();
        return $stmt;
        }
    public function readSellerPayDateId($fromDate, $toDate){
        $query = "SELECT b.sellerName, b.counterName, b.email, b.phoneNo, productId, a.sellerId, quantity, SUM(subTotal) AS total_subtotal, SUM(discount * quantity) AS total_discount,
        SUM(subTotal - (subTotal * (discount * quantity) / 100)) AS total_after_discount, SUM(adminCommision) AS total_admin_commission,
        SUM(total) as payAble, SUM(cgst) as cgst, SUM(sgst) as sgst FROM $this->orderItem as a INNER JOIN $this->seller as b on a.sellerId=b.id  WHERE (a.createdOn BETWEEN :fromDate AND :toDate) and sellerId=:sellerId GROUP BY sellerId";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
        $stmt->bindParam(':sellerId', $this->sellerId);
        $stmt->execute();
        return $stmt;
        }
    
    // *****************************
    public function readsellerdata()
    {
        $query = "Select a.sellerName,a.counterName,a.id,a.password,a.pan,a.gst,b.city,b.pincode,a.createdOn,b.address,a.aadhar,image,phoneNo,regFee,depositAmount,email,status from " . $this->seller .  " as a INNER JOIN " . $this->selleraddress . " as b ON b.sellerId=a.id JOIN " . $this->selleraddress . " as c ON c.sellerId=a.id";
         $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }
    // *****************************


    


    public function readsellerById()
    {
        $query = "Select a.sellerName,a.counterName,c.bankName,b.sellerId,c.updatedOn,c.updatedBy,c.upiId,b.city,b.pincode,c.accountNo,c.ifscCode,a.id,a.pan,a.gst,b.city,b.pincode,a.createdOn,b.address,a.aadhar,image,phoneNo,regFee,depositAmount,password,email,status from " . $this->seller .  " as a INNER JOIN " . $this->selleraddress . " as b ON b.sellerId=a.id JOIN " . $this->sellerbankdetails . " as c ON c.sellerId=a.id where a.id=:id";
         $stmt = $this->conn->prepare($query);
          $stmt->bindParam(":id", $this->id); 
        $stmt->execute();
        return $stmt;
    }

    public function readsellerPincode()
    { 
       // echo $this->id;
         $query = "Select pincode from " . $this->selleraddress .  " where sellerId=:id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(":id", $this->id); 
        $stmt->execute();
        return $stmt;
    }


    public function sellerLogin()
    {
        $query = "Select a.sellerName,a.counterName,c.bankName,b.sellerId,c.updatedOn,c.updatedBy,c.upiId,b.city,b.pincode,c.accountNo,c.ifscCode,a.id,a.pan,a.gst,b.city,b.pincode,a.createdOn,b.address,a.aadhar,image,phoneNo,regFee,depositAmount,password,email,status from " . $this->seller .  " as a INNER JOIN " . $this->selleraddress . " as b ON b.sellerId=a.id JOIN " . $this->sellerbankdetails . " as c ON c.sellerId=a.id where a.id=:id and a.password=:pwd";
         $stmt = $this->conn->prepare($query);
          $stmt->bindParam(":id", $this->id); 
          $stmt->bindParam(":pwd", $this->pwd); 
        $stmt->execute();
        return $stmt;
    }

    public function readsellermaxId()
    {
        $query = "Select max(id) as id from " . $this->seller;
         $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":userName", $this->userName); 
        $stmt->execute();
        return $stmt;
    }


    public function insertseller()
    {
         $query = "INSERT INTO
        " . $this->seller. "
    SET      sellerName=:sellerName,
             counterName=:counterName,
             pan=:pan,
             email=:email,
             aadhar=:aadhar, 
             gst=:gst, 
             status=:status, 
             regFee=:regFee,
             depositAmount=:depositAmount, 
             phoneNo=:phoneNo,
             createdOn=:createdOn,
             createdBy=:createdBy, 
             password=:password";           ;

        $stmt = $this->conn->prepare($query);
        $this->sellerName = htmlspecialchars(strip_tags($this->sellerName));
        $this->gst = htmlspecialchars(strip_tags($this->gst));
        $this->counterName = htmlspecialchars(strip_tags($this->counterName));
        $this->pan = htmlspecialchars(strip_tags($this->pan));
        $this->regFee = htmlspecialchars(strip_tags($this->regFee));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->depositAmount = htmlspecialchars(strip_tags($this->depositAmount));
        $this->phoneNo = htmlspecialchars(strip_tags($this->phoneNo));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        
        $stmt->bindParam(":sellerName", $this->sellerName);
        $stmt->bindParam(":gst", $this->gst);
        $stmt->bindParam(":counterName", $this->counterName);
        $stmt->bindParam(":pan", $this->pan);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":aadhar", $this->aadhar);
        $stmt->bindParam(":phoneNo", $this->phoneNo);
        $stmt->bindParam(":regFee", $this->regFee);
        $stmt->bindParam(":depositAmount", $this->depositAmount);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":status", $this->status);
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
        $query1 = " DELETE FROM " . $this->seller . " 
        WHERE id=:id";
        $query2 = " DELETE FROM " . $this->selleraddress . " 
        WHERE sellerId=:id";
        $query3 = " DELETE FROM " . $this->sellerbankdetails . " 
        WHERE sellerId=:id";
    
        
        // $query2 = " DELETE FROM " . $this->user_profile . " 
        // WHERE userId=:id";
    
        // $query3 = " DELETE FROM " . $this->user_profile_history . " 
        // WHERE userId=:id";
    
        // $query4 = " DELETE FROM " . $this->wall_uploads . " 
        // WHERE userId=:id";
    
        // $query5 = " DELETE FROM " . $this->wall_upload_history . " 
        // WHERE userId=:id";
      
        // prepare query
        $stmt1 = $this->conn->prepare($query1);
        $stmt2 = $this->conn->prepare($query2);
        $stmt3 = $this->conn->prepare($query3);
        // $stmt4 = $this->conn->prepare($query4);
        // $stmt5 = $this->conn->prepare($query5);
      
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        // bind id of record to delete
        $stmt1->bindParam(":id", $this->id);
        $stmt2->bindParam(":id", $this->id);
        $stmt3->bindParam(":id", $this->id);
        // $stmt4->bindParam(":id", $this->id);
        // $stmt5->bindParam(":id", $this->id);
      
        // execute query
        if ($stmt1->execute() && $stmt2->execute() && $stmt3->execute() ){
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
        counterName=:counterName,
        sellerName=:sellerName,
        pan=:pan,
        aadhar=:aadhar,
        phoneNo=:phoneNo,
        gst=:gst,
        email=:email,
        updatedOn=:updatedOn,
        updatedBy=:updatedBy
        where id=:id";

 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        
        $this->counterName = htmlspecialchars(strip_tags($this->counterName));
        $this->sellerName = htmlspecialchars(strip_tags($this->sellerName));
        $this->phoneNo = htmlspecialchars(strip_tags($this->phoneNo));
        $this->pan = htmlspecialchars(strip_tags($this->pan));
        $this->aadhar = htmlspecialchars(strip_tags($this->aadhar));
        $this->gst = htmlspecialchars(strip_tags($this->gst));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->email = htmlspecialchars(strip_tags($this->email));    
        $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));


        //bind values with stmt
        $stmt->bindParam(":counterName", $this->counterName);
        $stmt->bindParam(":sellerName", $this->sellerName);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":phoneNo", $this->phoneNo);
        $stmt->bindParam(":pan", $this->pan);
        $stmt->bindParam(":aadhar", $this->aadhar);
        $stmt->bindParam(":gst", $this->gst);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":updatedBy", $this->updatedBy);
        $stmt->bindParam(":updatedOn", $this->updatedOn);

        
        // execute query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }


// updated seller address

function updateselleraddrss()
{

    // query to update record
    $query = "UPDATE 
     " . $this->selleraddress . "
 SET
    address=:address,
    city=:city,
    pincode=:pincode,
    updatedOn=:updatedOn,
    updatedBy=:updatedBy
    where sellerId=:id";


    // prepare query
    $stmt = $this->conn->prepare($query);

    
    $this->address = htmlspecialchars(strip_tags($this->address));
    $this->city = htmlspecialchars(strip_tags($this->city));
    $this->pincode = htmlspecialchars(strip_tags($this->pincode));
    $this->id = htmlspecialchars(strip_tags($this->id));    
    $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
    $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));


    //bind values with stmt
    $stmt->bindParam(":address", $this->address);
    $stmt->bindParam(":city", $this->city);
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":pincode", $this->pincode);
    $stmt->bindParam(":updatedBy", $this->updatedBy);
    $stmt->bindParam(":updatedOn", $this->updatedOn);

    
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
         " . $this->seller;

 
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