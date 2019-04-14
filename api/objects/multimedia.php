<?php
class Multimedia{

    // database connection and table name
    private $conn;
    private $table_name = "Multimedia";

    // object properties
    public $MID;
    public $image;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


// create place
function create(){

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
             image=:image,MID=:MID";

    // prepare query
    $stmt = $this->conn->prepare($query);


    // sanitize

    $this->image=htmlspecialchars(strip_tags($this->image));
    $this->MID=htmlspecialchars(strip_tags($this->MID));

    // bind values

    $stmt->bindParam(':image', $this->image);
    $stmt->bindParam(':MID', $this->MID);


    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;

}
// used when filling up the update product form
function readCategory($MID){

    // select all query
    $query = "SELECT * FROM " . $this->table_name ." WHERE MID = '".$MID."'";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();
    return $stmt;

}





}
