<?php
class Product
{

    private $conn;
    private $seller = "seller";
    private $products = "products";
    private $categories = "categories";
    private $productskuid = "productskuid";
    private $cart = "cart";
    private $selleraddress = "selleraddress";
    private $producthistory = "producthistory";

    private $wall_upload_history = "wall_upload_history";
    // private $table_payment = "payment";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public $id,$status, $pid, $name, $productId, $description, $price, $quantity, $discount, $userId, $minVal,$maxVal,$sgst,$cgst,
    $image,$mainImage, $skuId, $papular, $trending, $arrival, $bestselling, $categoriesId, $createdOn,$createdBy,$filter, $extra,
    $updatedOn,$subCategoryId, $summary, $sellerId, $shippingCharge, $updatedBy, $productType, $subCat, $sort,$sid, $pincode,$catId, $pageSize;


    public function readProductById()
    {
        if ($this->catId != "" && $this->pid == null && $this->filter == "" && $this->extra == ""  && $this->pageSize == "") {
             $query = "Select a.name,a.id,a.categoriesId,a.rating, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
        a.sellerId,a.skuId,a.price,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
         INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid  JOIN ". $this->categories . " e ON a.categoriesId=e.id  where a.categoriesId=:catId ";
        } else if ($this->subCat != "" && $this->pincode != "" && $this->filter == "" && $this->extra == ""  && $this->pageSize == "") {
             //echo "*******". $this->sid;
            //echo  $this->pincode;
           
        //    echo $this->catId;
         $query = "Select a.name,a.id,a.categoriesId,a.rating,f.pincode, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
                     a.sellerId,a.skuId,a.price,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
                      INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid
                  JOIN   $this->seller  as d ON a.sellerId=d.id JOIN ". $this->categories . " e ON a.categoriesId=e.id JOIN " . $this->selleraddress . " f ON f.sellerId=d.id  where a.subCategoryId=:sid AND f.pincode=:pincode ";
        } 
        else if ($this->subCat != "" && $this->filter == "" && $this->extra == ""  && $this->pageSize == "" && $this->pincode=="") {
             $query = "Select a.name,a.id,a.categoriesId,a.rating, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
                       a.sellerId,a.skuId,a.price,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
                        INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid
                     JOIN ". $this->categories . " e ON a.categoriesId=e.id where  a.subCategoryId=:sid ";
                }
        else if ($this->pid != "" && $this->catId == "" && $this->filter == "" && $this->extra == ""  && $this->pageSize == "") {
             $query = "Select a.name,a.id,a.categoriesId,a.rating, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
                a.sellerId,a.skuId,a.price,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
                 INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid JOIN ". $this->categories . " e ON a.categoriesId=e.id where  a.id=:pid ";
        } 
        else if ($this->pid == "" && $this->catId != "" && $this->filter != "" && $this->extra == ""  && $this->pageSize == "") {
              $query = "Select a.name,a.id,a.categoriesId,a.rating, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
                a.sellerId,a.skuId,a.price,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
                 INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid JOIN ". $this->categories . " e ON a.categoriesId=e.id where  a.id=:pid ";
        } 
    //     else if ($this->pid == "" && $this->catId == "" && $this->filter != "" && $this->extra == ""  && $this->pageSize == "") {
    //          $query = "Select a.name,a.id,a.categoriesId,a.rating, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
    //            a.sellerId,a.skuId,a.price,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
    //             INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid JOIN " .
    //            $this->seller . "  as d ON a.sellerId=d.id JOIN ". $this->categories . " e ON a.categoriesId=e.id where  a.id=:pid ";
    //    } 
        else if ($this->pid == "" && $this->subCat != "" && $this->filter != "" && $this->extra == ""  && $this->pageSize == "") {
              $query = "Select a.name,a.id,a.categoriesId,a.rating, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
                a.sellerId,a.skuId,a.price ,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
                 INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid JOIN ". $this->categories . " e ON a.categoriesId=e.id where  a.subCategoryId=:sid ";
        } 
        else if ($this->pid == "" && $this->subCat == "" && $this->filter != "" && $this->extra == ""  && $this->pageSize == "") {
              $query = "Select a.name,a.id,acategoriesId,a.rating, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
                a.sellerId,a.skuId,a.price ,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
                 INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid JOIN ". $this->categories . " e ON a.categoriesId=e.id where a.price >=:minVal and  a.price<=:maxVal ";
        }  
        else if ($this->pid == "" && $this->subCat == "" && $this->filter == "" && $this->extra != ""  && $this->pageSize == "") {
             $query = "Select a.name,a.id,a.categoriesId,a.rating, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
               a.sellerId,a.skuId,a.price ,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
                INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid JOIN ". $this->categories . " e ON a.categoriesId=e.id where a.name LIKE :search ";
       }    

         else if($this->pincode!="" && $this->pincode!=0)
          {
          //  echo strlen;

            $query = "Select a.name,a.id,a.categoriesId,a.rating, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
            a.sellerId,a.skuId,a.price,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
             INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid  JOIN ". $this->categories . " e ON a.categoriesId=e.id  JOIN ". $this->selleraddress . " f ON f.sellerId=d.id where f.pincode=:pincode";
            
       }
        else{
            //   echo $this->pincode;
             $query = "Select a.name ,a.id,a.categoriesId,a.rating, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
            a.sellerId,a.skuId,a.price,a.shippingCharge,a.discount, e.sgst,e.cgst from " . $this->products . " as a
              INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid JOIN ". $this->categories . " e ON a.categoriesId=e.id";

        }
        // $stmt = $this->conn->prepare($query);

        // $stmt->bindParam(":pincode", $this->pincode);
        // print_r($stmt);
        if ($this->sort != "") {
         
            $query .= " ORDER BY a." . str_replace("_"," ",$this->sort);
        }


        $stmt = $this->conn->prepare($query);
        
        if ($this->catId != "" &&  $this->pincode != "" && $this->pid == null && $this->filter == "" && $this->extra == "") {
            $stmt->bindParam(":catId", $this->catId);
        } else if ($this->subCat != "") {

            $stmt->bindParam(":sid", $this->subCat);
        } else if ($this->pid != "") {

            $this->pid = htmlspecialchars(strip_tags(trim($this->pid)));

            $stmt->bindParam(":pid", $this->pid);
            

        }
        // else if ($this->filter != "") {

        //     $stmt->bindParam(":minVal", $this->minVal,PDO::PARAM_INT);  
        //     $stmt->bindParam(":maxVal", $this->maxVal,PDO::PARAM_INT);  
        // }
        else if ($this->extra != "") {

            $this->extra = htmlspecialchars(strip_tags(trim($this->extra)));
            $searchTerm =  '%' . $this->extra . '%';
            $stmt->bindParam(":search",$searchTerm );

        }
        else if ($this->pid == "" && $this->subCat == "" && $this->filter != "" && $this->extra == ""  && $this->pageSize == ""){
            $stmt->bindParam(":minVal", $this->minVal,PDO::PARAM_INT);  
            $stmt->bindParam(":maxVal", $this->maxVal,PDO::PARAM_INT);  
        }
        else if($this->pincode!=="" && $this->pincode!=0){
            $stmt->bindParam(":pincode", $this->pincode);
            //$stmt->bindParam(":catId", $this->catId);
        }
        
       

       
       
        $stmt->execute();
        return $stmt;

    }


    public function readProductDetailsforOrder()
    {
        $query = "Select a.name,a.categoriesId,a.description,b.quantity,a.createdOn,a.image,a.sellerId,a.skuId,a.price,a.shippingCharge,a.discount from " . $this->products . " as a INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid INNER JOIN " . $this->cart . " as c ON c.productId=a.id where c.userId=:userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":userId", $this->userId);
        $stmt->execute();
        return $stmt;
    }




    // Read Product Max id

    public function readProductMaxId()
    {
        $query = "Select max(id) as id from " . $this->products;
        $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":skuId", $this->skuId); 
        $stmt->execute();
        return $stmt;
    }



    public function readAllProductDetails()
    {

        $query = "Select a.name as productName,a.id, c.name, a.categoriesId,a.description,b.quantity,b.price ,a.id
                ,a.createdOn,a.image,a.sellerId,d.sellerName, a.skuId,a.price,a.discount,a.shippingCharge from 
             $this->products   as a INNER JOIN 
             $this->productskuid   as b ON b.skuid=a.skuid JOIN 
             $this->categories  as c ON c.id=a.categoriesId JOIN 
             $this->seller  as d ON a.sellerId=d.id where a.categoriesId=:productType";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":productType", $this->productType);

        $stmt->execute();
        return $stmt;
    }








    public function readAllProductDetailsByseller()
    {
        if($this->sellerId!="")
        {
            $query = "Select a.name as productName,a.id,c.name,c.commision, a.categoriesId,a.description,b.quantity,a.id,a.createdOn,a.image,a.sellerId,a.skuId,a.price,a.discount from " . $this->products . " as a INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid JOIN " . $this->categories . " as c ON c.id=a.categoriesId  where a.sellerId=:sellerId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":sellerId", $this->sellerId);
        }
        else{
            $query = "Select a.name as productName,a.id,c.name,c.commision, a.categoriesId,a.description,b.quantity,a.id,a.createdOn,a.image,a.sellerId,a.skuId,a.price,a.discount from " . $this->products . " as a INNER JOIN " . $this->productskuid . " as b ON b.skuid=a.skuid JOIN " . $this->categories . " as c ON c.id=a.categoriesId";
            $stmt = $this->conn->prepare($query);
            //$stmt->bindParam(":sellerId", $this->sellerId);       
             }
        
        $stmt->execute();
        return $stmt;
    }





    public function readProduct($limit, $offset, $catId, $sort, $search)
    {
        if($catId != ""){

            //read product by category
             $query = "Select a.name as productName,a.id, c.name, a.categoriesId,a.description,b.quantity,b.price ,a.id
                ,a.createdOn,a.image,a.sellerId, a.skuId,a.price,a.discount,a.shippingCharge from 
             $this->products   as a INNER JOIN 
             $this->productskuid   as b ON b.skuid=a.skuid JOIN 
             $this->categories  as c ON c.id=a.categoriesId where a.categoriesId=:catId LIMIT 10";

        }else if($search !=""){
            //Read searched data
            $query = "SELECT a.name as productName, a.id, c.name, a.categoriesId, a.description, 
            b.quantity, b.price, a.id, a.createdOn, a.image, a.sellerId, a.skuId, 
            a.price, a.discount, a.shippingCharge 
            FROM $this->products as a 
            INNER JOIN $this->productskuid as b ON b.skuid = a.skuid 
            JOIN $this->categories as c ON c.id = a.categoriesId WHERE a.name LIKE :search";
        }
        else if($sort != ""){
            // read product by sort method like price low to high , high to low, a to z, z to a
            switch ($sort) {
                case 'name_desc':
                    $query = "SELECT a.name as productName, a.id, c.name, a.categoriesId, a.description, 
                    b.quantity, b.price, a.id, a.createdOn, a.image, a.sellerId, a.skuId, 
                    a.price, a.discount, a.shippingCharge 
                    FROM $this->products as a 
                    INNER JOIN $this->productskuid as b ON b.skuid = a.skuid 
                    JOIN $this->categories as c ON c.id = a.categoriesId order by a.name desc";
                    break;
                case 'name_asc':
                    $query = "SELECT a.name as productName, a.id, c.name, a.categoriesId, a.description, 
                    b.quantity, b.price, a.id, a.createdOn, a.image, a.sellerId, a.skuId, 
                    a.price, a.discount, a.shippingCharge 
                    FROM $this->products as a 
                    INNER JOIN $this->productskuid as b ON b.skuid = a.skuid 
                    JOIN $this->categories as c ON c.id = a.categoriesId order by a.name ASC";
                    break;
                
                case 'price_asc':
                    $query = "SELECT a.name as productName, a.id, c.name, a.categoriesId, a.description, 
                    b.quantity, b.price, a.id, a.createdOn, a.image, a.sellerId, a.skuId, 
                    a.price, a.discount, a.shippingCharge 
                    FROM $this->products as a 
                    INNER JOIN $this->productskuid as b ON b.skuid = a.skuid 
                    JOIN $this->categories as c ON c.id = a.categoriesId order by b.price ASC";
                    break;
                case 'price_desc':
                    $query = "SELECT a.name as productName, a.id, c.name, a.categoriesId, a.description, 
                    b.quantity, b.price, a.id, a.createdOn, a.image, a.sellerId, a.skuId, 
                    a.price, a.discount, a.shippingCharge 
                    FROM $this->products as a 
                    INNER JOIN $this->productskuid as b ON b.skuid = a.skuid 
                    JOIN $this->categories as c ON c.id = a.categoriesId order by b.price desc";
                    break;
                default:
                $query = "SELECT a.name as productName, a.id, c.name, a.categoriesId, a.description, 
                b.quantity, b.price, a.id, a.createdOn, a.image, a.sellerId, a.skuId, 
                a.price, a.discount, a.shippingCharge 
                FROM $this->products as a 
                INNER JOIN $this->productskuid as b ON b.skuid = a.skuid 
                JOIN $this->categories as c ON c.id = a.categoriesId 
                ";
                break;
            }
          
        }
        else if($limit !=""){
            // read product for index page limit 5 
            $query = "SELECT a.name as productName, a.id, c.name, a.categoriesId, a.description, 
            b.quantity, b.price, a.id, a.createdOn, a.image, a.sellerId, a.skuId, 
            a.price, a.discount, a.shippingCharge 
            FROM $this->products as a 
            INNER JOIN $this->productskuid as b ON b.skuid = a.skuid 
            JOIN $this->categories as c ON c.id = a.categoriesId 
            LIMIT $limit OFFSET $offset";
        }
       
        else{
            // default read all product without any limitation
            $query = "SELECT a.name as productName, a.id, c.name, a.categoriesId, a.description, 
            b.quantity, b.price, a.id, a.createdOn, a.image, a.sellerId, a.skuId, 
            a.price, a.discount, a.shippingCharge 
            FROM $this->products as a 
            INNER JOIN $this->productskuid as b ON b.skuid = a.skuid 
            JOIN $this->categories as c ON c.id = a.categoriesId 
            ";
        }
        




       

        $stmt = $this->conn->prepare($query);

        if($catId != ""){
            $stmt->bindParam(':catId', $catId, PDO::PARAM_INT);
        }
        if ($search != "") {
            $searchTerm = '%' . $search . '%';
            $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
        }
        
       
        $stmt->execute();
        return $stmt;
    }


    public function readAllProduct()
    {
        $query = " Select name,categoriesId,description,image,sellerId,skuId,price,discount from " . $this->products . "INNER JOIN ON";
        $stmt = $this->conn->prepare($query);
        //  $stmt->bindParam(":skuId", $this->skuId); 
        $stmt->execute();
        return $stmt;
    }

    public function insertProduct()
    {
        $query = "INSERT INTO
        " . $this->products . "
    SET      name=:name,
             categoriesId=:categoriesId,
             shippingCharge=:shippingCharge,
             description=:description,
             image=:image,
             status=:status,
             mainImage=:mainImage,
             subCategoryId=:subCategoryId,
             skuId=:skuId,
             price=:price,
             sellerId=:sellerId,
             createdOn=:createdOn,
             createdBy=:createdBy,
             discount=:discount";

        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->skuId = htmlspecialchars(strip_tags($this->skuId));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->subCategoryId = htmlspecialchars(strip_tags($this->subCategoryId));
        $this->categoriesId = htmlspecialchars(strip_tags($this->categoriesId));
        $this->shippingCharge = htmlspecialchars(strip_tags($this->shippingCharge));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->mainImage = htmlspecialchars(strip_tags($this->mainImage));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->discount = htmlspecialchars(strip_tags($this->discount));
        $this->sellerId = htmlspecialchars(strip_tags($this->sellerId));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));



        $stmt->bindParam(":skuId", $this->skuId);
        $stmt->bindParam(":sellerId", $this->sellerId);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":discount", $this->discount);
        $stmt->bindParam(":shippingCharge", $this->shippingCharge);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":mainImage", $this->mainImage);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":categoriesId", $this->categoriesId);
        $stmt->bindParam(":subCategoryId", $this->subCategoryId);
        $stmt->bindParam(":createdOn", $this->createdOn);
        $stmt->bindParam(":createdBy", $this->createdBy);




        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deletProducts()
    {

        // delete user detatail
        $query1 = " DELETE FROM " . $this->products . " 
        WHERE id=:id";
        $query2 = " DELETE FROM " . $this->producthistory . " 
        WHERE productId=:id";
        $query3 = " DELETE FROM " . $this->productskuid . " 
        WHERE productId=:id";


        // prepare query
        $stmt1 = $this->conn->prepare($query1);
        $stmt2 = $this->conn->prepare($query2);
        $stmt3 = $this->conn->prepare($query3);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt1->bindParam(":id", $this->id);
        $stmt2->bindParam(":id", $this->id);
        $stmt3->bindParam(":id", $this->id);

        // execute query
        if ($stmt1->execute() && $stmt2->execute() && $stmt2->execute()) {
            return true;
        }

        return false;
    }

    function updateProduct()
    {
      //echo $this->pid;
        // query to update record
         $query = "UPDATE 
         " . $this->products . "
     SET      
             name=:name,
             price=:price,
             image=:image,
             mainImage=:mainImage,
             description=:description,
             status=:status,
             updatedOn=:updatedOn,
             updatedBy=:updatedBy,
             discount=:discount where id=:pid";

        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->mainImage = htmlspecialchars(strip_tags($this->mainImage));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->discount = htmlspecialchars(strip_tags($this->discount));
        $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));
        $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        $this->pid = htmlspecialchars(strip_tags($this->pid));
        

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":discount", $this->discount);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":mainImage", $this->mainImage);
        $stmt->bindParam(":updatedOn", $this->updatedOn);
        $stmt->bindParam(":updatedBy", $this->updatedBy);
        $stmt->bindParam(":pid", $this->pid);




        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    function insertProductHistory()
    {
      //echo $this->pid;
        // query to update record
         $query = "INSERT 
         " . $this->products . "
     SET      
             
             price=:price,
             updatedOn=:updatedOn,
             quantity=:quantity,
             updatedBy=:updatedBy,
             productId=:pid";

        $stmt = $this->conn->prepare($query);
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));
        $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        $this->pid = htmlspecialchars(strip_tags($this->pid));
        

        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":updatedOn", $this->updatedOn);
        $stmt->bindParam(":updatedBy", $this->updatedBy);
        $stmt->bindParam(":pid", $this->pid);




        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

//update product quantity by sellar

function updateProductSkuIdTablebyseller()
{

    // query to update record
    $query = "UPDATE 
     " . $this->productskuid . "
 SET      
         quantity=:quantity,
         price=:price,
         updatedOn=:updatedOn,
         updatedBy=:updatedBy
          where productId=:pid";

    $stmt = $this->conn->prepare($query);
    // $this->quantity = htmlspecialchars(strip_tags($this->quantity));
    // $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));
    // $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
    // $this->productId = htmlspecialchars(strip_tags($this->productId));



    $stmt->bindParam(":quantity", $this->quantity);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":updatedBy", $this->updatedBy);
    $stmt->bindParam(":updatedOn", $this->updatedOn);
    $stmt->bindParam(":pid", $this->pid);




    // execute query
    if ($stmt->execute()) {
        return true;
    }

    return false;
}


    ///Update Product Quantity after Sold

    function updateProductQuantity()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->productskuid . "
     SET      
             quantity=quantity-:quantity,
             updatedOn=:updatedOn,
             updatedBy=:updatedBy
              where productId=:productId";

        $stmt = $this->conn->prepare($query);
        // $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        // $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));
        // $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        // $this->productId = htmlspecialchars(strip_tags($this->productId));



        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":updatedBy", $this->updatedBy);
        $stmt->bindParam(":updatedOn", $this->updatedOn);
        $stmt->bindParam(":productId", $this->productId);




        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }




    function updateProductQuantitydata()
    {

        // query to update record
        $query = "UPDATE 
         " . $this->productskuid . "
     SET      
             quantity=quantity+:quantity,
             updatedOn=:updatedOn
              where productId=:productId";

        $stmt = $this->conn->prepare($query);
        // $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        // $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));
        // $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        // $this->productId = htmlspecialchars(strip_tags($this->productId));



        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":updatedOn", $this->updatedOn);
        $stmt->bindParam(":productId", $this->productId);




        // execute query
        if ($stmt->execute()) {
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
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
?>