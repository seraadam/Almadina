<?php
class plan{

    // database connection and table name
    private $conn;
    private $table_name = "plan";

    // object properties
    public $TID;
    public $VID;
    public $PID;
    public $StartDate;
    public $EndDate;
    public $Places;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read plans
function read(){

    // select all query
    $query = "SELECT
              *
            FROM
                " . $this->table_name . " ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}


// create plan
function create(){

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
          VID=:VID, PID=:PID,StartDate=:StartDate ,
            EndDate=:EndDate , Places=:Places ";

    // prepare query
    $stmt = $this->conn->prepare($query);


    // sanitize
    // $this->TID=  3 ;
    // $this->VID=htmlspecialchars(strip_tags($this->VID));
    // $this->PID=htmlspecialchars(strip_tags($this->PID));
    // $this->StartDate=htmlspecialchars(strip_tags($this->StartDate));
    // $this->EndDate=htmlspecialchars(strip_tags($this->EndDate));
    // $this->places=htmlspecialchars(strip_tags($this->places));

    // bind values

    $stmt->bindParam(':VID', $this->VID);
    $stmt->bindParam(':PID', $this->PID);
    $stmt->bindParam(':StartDate', $this->StartDate);
    $stmt->bindParam(':EndDate', $this->EndDate);
    $stmt->bindParam(':Places', $this->Places);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;

}
// used when filling up the update product form
function readOne(){

    // query to read single record
    $query = "SELECT * FROM " . $this->table_name ." WHERE TID = ? ";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->TID);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->VID = $row['VID'];
    $this->PID = $row['PID'];
    $this->StartDate = $row['StartDate'];
    $this->EndDate = $row['EndDate'];
    $this->Places = $row['Places'];


}
}
