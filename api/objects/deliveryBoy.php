<?php
class DeliveryBoy
{

    private $conn;
    private $deliverybankdetails = "deliverybankdetails";
    private $deliveryboyhistory = "deliveryboyhistory";
    private $deliveryincome = "deliveryincome";
    private $deliverypayment = "deliverypayment";
    private $deliveryboy = "deliveryboy";
    private $orderdetails = "orderdetails";

    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id, $userId, $userType, $delivery_id, $deliveryId, $city, $pwd, $state, $name, $email, $email_id, $contactno, $password, $regDate, $seller_name, $seller_id, $father, $address, $counter_name, $mobile_no, $payment_status, $pincode, $created_on, $created_by, $emp_id, $alterMobile, $businessDay, $userWebsite, $businessName, $image, $establishmentYear, $paymentMode, $businessTiming, $userServices, $aboutUser, $status, $remark, $createdOn, $pan, $aadhar, $createdBy, $wallImg, $workingAddress, $regidenceAddress, $workingPincode, $phoneNo, $updatedOn, $updatedBy;

    public $cuId, $cuName, $cuEmail, $cuAddress, $cuMobile, $requiredService, $accountNo, $ifscCode, $fromDate, $toDate, $bankName, $accountHolderName;

    // public $cuId, $cuName,$cuEmail,$accountHolderName, $cuAddress, $cuMobile, $requiredService, $accountNo, $ifscCode, $bankName;



    public function readDeliveryBoy()
    {
        $query = "Select name,phoneNo,city,password,email,id,status,regidenceAddress,workingPincode,workingAddress,aadhar,pan,image,createdBy,createdOn from " . $this->deliveryboy;

        $stmt = $this->conn->prepare($query);

        // $this->id = htmlspecialchars(strip_tags($this->id));
        //$this->emp_id = htmlspecialchars(strip_tags(string: $this->emp_id));
        //$stmt->bindParam(":id", $this->id); 
        $stmt->execute();
        return $stmt;
    }

    // Read Delivery Boy Max Id





    // read delivery boy by id

    public function readDeliveryBoyId()
    {
        $query = "Select a.name,a.phoneNo,a.email,a.id,a.status,a.regidenceAddress,a.workingPincode,a.workingAddress,a.aadhar,pan,b.accountNo,a.city,b.bankName, b.accountHolderName,b.ifscCode,image,a.createdBy,b.updatedOn,a.createdOn from " . $this->deliveryboy . " as a INNER JOIN " . $this->deliverybankdetails . " as b ON b.deliveryId=a.id JOIN " . $this->deliveryincome . " as c ON c.deliveryId=a.id where b.deliveryId=:id";

        $stmt = $this->conn->prepare($query);

        // $this->id = htmlspecialchars(strip_tags($this->id));
        //$this->emp_id = htmlspecialchars(strip_tags(string: $this->emp_id));
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return $stmt;
    }



    // Delivery Boy Login


    public function readDeliveryBoyLogin()
    {
        $query = "Select a.name,a.phoneNo,a.email,a.id,a.status,a.regidenceAddress,a.workingPincode,a.workingAddress,a.aadhar,pan,b.accountNo,b.bankName, b.accountHolderName,b.ifscCode,image,a.createdBy,b.updatedOn,a.createdOn from " . $this->deliveryboy . " as a INNER JOIN " . $this->deliverybankdetails . " as b ON b.deliveryId=a.id JOIN " . $this->deliveryincome . " as c ON c.deliveryId=a.id where a.id=:id and password=:pwd";

        $stmt = $this->conn->prepare($query);

        // $this->id = htmlspecialchars(strip_tags($this->id));
        //$this->emp_id = htmlspecialchars(strip_tags(string: $this->emp_id));
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":pwd", $this->pwd);
        $stmt->execute();
        return $stmt;
    }

    public function readDeliveryBoymaxId()
    {
        $query = "Select max(id) as id from " . $this->deliveryboy;

        $stmt = $this->conn->prepare($query);

        // $this->id = htmlspecialchars(strip_tags($this->id));
        //$this->emp_id = htmlspecialchars(strip_tags(string: $this->emp_id));
        //$stmt->bindParam(":id", $this->id); 
        $stmt->execute();
        return $stmt;
    }


    public function insertDeliveryBoy()
    {
        $query = "INSERT INTO
        " . $this->deliveryboy . "
    SET      name=:name,
             email=:email,
             phoneNo=:phoneNo,
             city=:city,
             workingAddress=:workingAddress, 
             regidenceAddress=:regidenceAddress,
             pan=:pan,
             aadhar=:aadhar,
             password=:password,
             image=:image,
             status=:status,
             workingPincode=:workingPincode,
             createdOn=:createdOn,
             createdBy=:createdBy";;

        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->phoneNo = htmlspecialchars(strip_tags($this->phoneNo));
        $this->workingAddress = htmlspecialchars(strip_tags($this->workingAddress));
        $this->regidenceAddress = htmlspecialchars(strip_tags($this->regidenceAddress));
        $this->workingPincode = htmlspecialchars(strip_tags($this->workingPincode));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->pan = htmlspecialchars(strip_tags($this->pan));
        $this->aadhar = htmlspecialchars(strip_tags($this->aadhar));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));



        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":phoneNo", $this->phoneNo);
        $stmt->bindParam(":workingAddress", $this->workingAddress);
        $stmt->bindParam(":regidenceAddress", $this->regidenceAddress);
        $stmt->bindParam(":workingPincode", $this->workingPincode);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":pan", $this->pan);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":aadhar", $this->aadhar);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":createdBy", $this->createdBy);
        $stmt->bindParam(":createdOn", $this->createdOn);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delivery History

    public function insertDeliveryBoyHistory()
    {
        $query = "INSERT INTO
    " . $this->deliveryboyhistory . "
SET      name=:name,
         email=:email,
         phoneNo=:phoneNo,
         city=:city,
         delivery_id=:delivery_id,
         workingAddress=:workingAddress, 
         regidenceAddress=:regidenceAddress,
         pan=:pan,
         aadhar=:aadhar,
         password=:password,
         image=:image,
         status=:status,
         workingPincode=:workingPincode,
         createdOn=:createdOn,
         createdBy=:createdBy";;

        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->delivery_id = htmlspecialchars(strip_tags($this->delivery_id));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->phoneNo = htmlspecialchars(strip_tags($this->phoneNo));
        $this->workingAddress = htmlspecialchars(strip_tags($this->workingAddress));
        $this->regidenceAddress = htmlspecialchars(strip_tags($this->regidenceAddress));
        $this->workingPincode = htmlspecialchars(strip_tags($this->workingPincode));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->pan = htmlspecialchars(strip_tags($this->pan));
        $this->aadhar = htmlspecialchars(strip_tags($this->aadhar));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));



        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":delivery_id", $this->delivery_id);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":phoneNo", $this->phoneNo);
        $stmt->bindParam(":workingAddress", $this->workingAddress);
        $stmt->bindParam(":regidenceAddress", $this->regidenceAddress);
        $stmt->bindParam(":workingPincode", $this->workingPincode);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":pan", $this->pan);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":aadhar", $this->aadhar);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":createdBy", $this->createdBy);
        $stmt->bindParam(":createdOn", $this->createdOn);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



    public function insertDeliveryBoyPayment()
    {
        $query = "INSERT INTO
        " . $this->deliverypayment . "
    SET      city=:city,
             workingPincode=:workingPincode,
             createdOn=:createdOn,
             createdBy=:createdBy";;

        $stmt = $this->conn->prepare($query);
        $this->workingPincode = htmlspecialchars(strip_tags($this->workingPincode));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));



        $stmt->bindParam(":workingPincode", $this->workingPincode);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":createdBy", $this->createdBy);
        $stmt->bindParam(":createdOn", $this->createdOn);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    //insert delivery bank details


    public function insertDeliveryBoybank()
    {
        $query = "INSERT INTO
        " . $this->deliverybankdetails . "
    SET      deliveryId=:id,
             createdOn=:createdOn,
             createdBy=:createdBy";;

        $stmt = $this->conn->prepare($query);

        // $this->id = htmlspecialchars(strip_tags($this->id));
        // $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        // $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));




        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":createdBy", $this->createdBy);
        $stmt->bindParam(":createdOn", $this->createdOn);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }



    //insert income delivery boy 

    public function insertDeliveryIncome()
    {
        $query = "INSERT INTO
        " . $this->deliveryincome . "
    SET      deliveryId=:id,
             createdOn=:createdOn,
             createdBy=:createdBy";;

        $stmt = $this->conn->prepare($query);

        // $this->id = htmlspecialchars(strip_tags($this->id));
        // $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        // $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));




        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":createdBy", $this->createdBy);
        $stmt->bindParam(":createdOn", $this->createdOn);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }





    function deleteDelivery()
    {

        // delete user detatail
        $query1 = " DELETE FROM " . $this->deliveryboy . " 
        WHERE id=:id";
        $query2 = " DELETE FROM " . $this->deliverybankdetails . " 
        WHERE deliveryId=:id";
        $query3 = " DELETE FROM " . $this->deliveryincome . " 
        WHERE deliveryId=:id";

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
        // $stmt2 = $this->conn->prepare($query2);
        // $stmt3 = $this->conn->prepare($query3);
        // $stmt4 = $this->conn->prepare($query4);
        // $stmt5 = $this->conn->prepare($query5);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt1->bindParam(":id", $this->id);
        $stmt2->bindParam(":id", $this->id);
        $stmt3->bindParam(":id", $this->id);
        // $stmt2->bindParam(":id", $this->id);
        // $stmt3->bindParam(":id", $this->id);
        // $stmt4->bindParam(":id", $this->id);
        // $stmt5->bindParam(":id", $this->id);

        // execute query
        if ($stmt1->execute() && $stmt2->execute() && $stmt3->execute()) {
            return true;
        }

        return false;
    }
    function updateDelivery()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->deliveryboy . "
     SET
        name=:name,
        city=:city,
        status=:status,
        aadhar=:aadhar,
        pan=:pan,
        email=:email,
        workingAddress=:workingAddress,
        workingPincode=:workingPincode,
        regidenceAddress=:regidenceAddress,
        updatedOn=:updatedOn,
        updatedBy=:updatedBy
        where id=:id";


        // prepare query
        $stmt = $this->conn->prepare($query);


        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->city = htmlspecialchars(strip_tags($this->city));

        $this->workingAddress = htmlspecialchars(strip_tags($this->workingAddress));

        $this->workingPincode = htmlspecialchars(strip_tags($this->workingPincode));
        $this->regidenceAddress = htmlspecialchars(strip_tags($this->regidenceAddress));
        $this->aadhar = htmlspecialchars(strip_tags($this->aadhar));
        $this->pan = htmlspecialchars(strip_tags($this->pan));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));



        //bind values with stmt
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":city", $this->city);

        $stmt->bindParam(":workingAddress", $this->workingAddress);

        $stmt->bindParam(":workingPincode", $this->workingPincode);
        $stmt->bindParam(":regidenceAddress", $this->regidenceAddress);
        $stmt->bindParam(":aadhar", $this->aadhar);
        $stmt->bindParam(":pan", $this->pan);
        $stmt->bindParam(":status", $this->status);



        $stmt->bindParam(":updatedOn", $this->updatedOn);
        $stmt->bindParam(":updatedBy", $this->updatedBy);



        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function updateBankDelivery()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->deliverybankdetails . "
     SET
        accountNo=:accountNo,
        bankName=:bankName,
        ifscCode=:ifscCode,
        accountHolderName=:accountHolderName
        where deliveryId=:id";


        // prepare query
        $stmt = $this->conn->prepare($query);


        $this->accountNo = htmlspecialchars(strip_tags($this->accountNo));
        $this->bankName = htmlspecialchars(strip_tags($this->bankName));
        $this->accountHolderName = htmlspecialchars(strip_tags($this->accountHolderName));

        $this->ifscCode = htmlspecialchars(strip_tags($this->ifscCode));

        // $this->workingPincode = htmlspecialchars(strip_tags($this->workingPincode));


        // $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        // $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));



        //bind values with stmt
        $stmt->bindParam(":accountNo", $this->accountNo);
        $stmt->bindParam(":bankName", $this->bankName);
        $stmt->bindParam(":accountHolderName", $this->accountHolderName);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":ifscCode", $this->ifscCode);

        // $stmt->bindParam(":workingPincode", $this->workingPincode);



        // $stmt->bindParam(":updatedOn", $this->updatedOn);
        // $stmt->bindParam(":updatedBy", $this->updatedBy);



        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }



    function updateDeliveryAddress()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->deliveryboy . "
     SET
 
        phoneNo=:phoneNo,
        email=:email,
        regidenceAddress=:regidenceAddress,
        aadhar=:aadhar,
        image=:image
        where id=:id";


        // prepare query
        $stmt = $this->conn->prepare($query);


        $this->id = htmlspecialchars(strip_tags($this->id));

        $this->phoneNo = htmlspecialchars(strip_tags($this->phoneNo));

        $this->email = htmlspecialchars(strip_tags($this->email));

        $this->regidenceAddress = htmlspecialchars(strip_tags($this->regidenceAddress));

        $this->aadhar = htmlspecialchars(strip_tags($this->aadhar));


        $this->image = htmlspecialchars(strip_tags($this->image));
        // $this->workingPincode = htmlspecialchars(strip_tags($this->workingPincode));


        // $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        // $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));



        //bind values with stmt
        $stmt->bindParam(":id", $this->id);

        $stmt->bindParam(":phoneNo", $this->phoneNo);
        $stmt->bindParam(":email", $this->email);

        $stmt->bindParam(":regidenceAddress", $this->regidenceAddress);

        $stmt->bindParam(":aadhar", $this->aadhar);

        $stmt->bindParam(":image", $this->image);

        // $stmt->bindParam(":workingPincode", $this->workingPincode);



        // $stmt->bindParam(":updatedOn", $this->updatedOn);
        // $stmt->bindParam(":updatedBy", $this->updatedBy);



        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }



    function updateDeliveryboyBank()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->deliverybankdetails . "
     SET
        accountNo=:accountNo,
        ifscCode=:ifscCode,
        accountHolderName=:accountHolderName,
        bankName=:bankName
        where deliveryId=:id";


        // prepare query
        $stmt = $this->conn->prepare($query);


        $this->accountNo = htmlspecialchars(strip_tags($this->accountNo));
        $this->ifscCode = htmlspecialchars(strip_tags($this->ifscCode));

        $this->accountHolderName = htmlspecialchars(strip_tags($this->accountHolderName));
        $this->bankName = htmlspecialchars(strip_tags($this->bankName));

        // $this->workingPincode = htmlspecialchars(strip_tags($this->workingPincode));


        // $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        // $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));



        //bind values with stmt
        $stmt->bindParam(":accountNo", $this->accountNo);
        $stmt->bindParam(":ifscCode", $this->ifscCode);
        $stmt->bindParam(":accountHolderName", $this->accountHolderName);
        $stmt->bindParam(":bankName", $this->bankName);
        $stmt->bindParam(":id", $this->id);


        // $stmt->bindParam(":workingPincode", $this->workingPincode);



        // $stmt->bindParam(":updatedOn", $this->updatedOn);
        // $stmt->bindParam(":updatedBy", $this->updatedBy);



        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }



    function countDeliveryBoy()
    {

        // query to update record
        $query = "SELECT COUNT(*) FROM  
         " . $this->deliveryboy;


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
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function readDeliveryPayDateId($fromDate, $toDate)
    {
        // Query to fetch total for a given deliveryId within a date range
        $query = "SELECT count(orderId) as total , a.deliveryId, name,ifscCode, accountNo , bankName, phoneNo, email FROM $this->orderdetails as a join $this->deliveryboy as b on a.deliveryId=b.id join $this->deliverybankdetails as c on a.deliveryId=c.deliveryId WHERE (a.createdOn BETWEEN :fromDate AND :toDate) AND a.deliveryId = :deliveryId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
        $stmt->bindParam(':deliveryId', $this->deliveryId);

        // Execute the query
        $stmt->execute();

        // Return the statement object, or you can fetch the results if needed
        return $stmt;
    }
    public function readDeliveryPayId()
    {
        // Query to fetch total for a given deliveryId within a date range
        $query = "SELECT count(orderId) as total , a.deliveryId, name,ifscCode, accountNo , bankName, phoneNo, email FROM $this->orderdetails as a join $this->deliveryboy as b on a.deliveryId=b.id join $this->deliverybankdetails as c on a.deliveryId=c.deliveryId WHERE a.deliveryId = :deliveryId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':deliveryId', $this->deliveryId);

        // Execute the query
        $stmt->execute();

        // Return the statement object, or you can fetch the results if needed
        return $stmt;
    }

    public function readDeliveryPayDate($fromDate, $toDate)
    {

        $query = "SELECT count(orderId) as total , a.deliveryId, name,ifscCode, accountNo , bankName, phoneNo, email FROM $this->orderdetails as a join $this->deliveryboy as b on a.deliveryId=b.id join $this->deliverybankdetails as c on a.deliveryId=c.deliveryId WHERE a.createdOn BETWEEN :fromDate AND :toDate GROUP BY deliveryId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
        $stmt->execute();
        return $stmt;
    }
}
