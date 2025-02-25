<?php
class Promotion
{
    private $conn;
    private $promotion = 'promotion';

    public function __construct($db) {
        $this->conn = $db;
    }
    public $id, $tHeading, $heading, $para, $link, $status, $createdBy, $createdOn, $updatedBy, $updatedOn;

    public function updatepromotion()
    {
        $sql = "UPDATE $this->promotion SET 
        tHeading=:tHeading,
        heading=:heading,
        para=:para,
        link=:link,
        status=:status,
        updatedOn=:updatedOn,
        updatedBy=:updatedBy WHERE
        id=:id
        ";

        $stmt = $this->conn->prepare($sql);

        $this->tHeading = htmlspecialchars(strip_tags($this->tHeading));
        $this->heading = htmlspecialchars(strip_tags($this->heading));
        $this->para = htmlspecialchars(strip_tags($this->para));
        $this->link = htmlspecialchars(strip_tags($this->link));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->updatedOn = htmlspecialchars(strip_tags($this->updatedOn));
        $this->updatedBy = htmlspecialchars(strip_tags($this->updatedBy));


        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":tHeading", $this->tHeading);
        $stmt->bindParam(":heading", $this->heading);
        $stmt->bindParam(":para", $this->para);
        $stmt->bindParam(":link", $this->link);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":updatedOn", $this->updatedOn);
        $stmt->bindParam(":updatedBy", $this->updatedBy);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function readpromotion()
    {
        if($this->id != ''){
        $sql = "SELECT
        tHeading,heading,para,link,status,updatedOn,updatedBy,createdOn, createdBy, img, id from $this->promotion where id=:id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $this->id);
        }
        else{
            $sql = "SELECT
        tHeading,heading,para,link,status,updatedOn,updatedBy,createdOn, createdBy, img, id from $this->promotion";

        $stmt = $this->conn->prepare($sql);
        }
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return false;
        }
    }


    public function Insertpromotion()
    {
        $sql = "INSERT $this->promotion SET
        tHeading=:tHeading,
        heading=:heading,
        para=:para,
        link=:link,
        status=:status,
        createdOn=:createdOn,
        createdBy=:createdBy
        ";

        $stmt = $this->conn->prepare($sql);

        $this->tHeading = htmlspecialchars(strip_tags($this->tHeading));
        $this->heading = htmlspecialchars(strip_tags($this->heading));
        $this->para = htmlspecialchars(strip_tags($this->para));
        $this->link = htmlspecialchars(strip_tags($this->link));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->createdOn = htmlspecialchars(strip_tags($this->createdOn));
        $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));

        $stmt->bindParam(":tHeading", $this->tHeading);
        $stmt->bindParam(":heading", $this->heading);
        $stmt->bindParam(":para", $this->para);
        $stmt->bindParam(":link", $this->link);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":createdOn", $this->createdOn);
        $stmt->bindParam(":createdBy", $this->createdBy);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            return false;
        }
    }
}
