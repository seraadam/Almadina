<?php
class Visitor{

    // database connection and table name
    private $conn;
    private $table_name = "visitor";

    // object properties
    public $VID;
    public $Username;
    public $Password;
    public $NAtionality;
    public $Age;
    public $Gender;
    public $Email;
    public $PhoneNumber;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read visitors
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

// create visitor
function create(){

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
             Username=:Username, Password=:Password,NAtionality=:NAtionality ,
             Age=:Age , Gender=:Gender , Email=:Email , PhoneNumber=:PhoneNumber";

    // prepare query
    $stmt = $this->conn->prepare($query);


    // sanitize

    $this->Username=htmlspecialchars(strip_tags($this->Username));
    $this->Password=htmlspecialchars(strip_tags($this->Password));
    $this->NAtionality=htmlspecialchars(strip_tags($this->NAtionality));
    $this->Age=htmlspecialchars(strip_tags($this->Age));
    $this->Gender=htmlspecialchars(strip_tags($this->Gender));
    $this->Email=htmlspecialchars(strip_tags($this->Email));
    $this->PhoneNumber=htmlspecialchars(strip_tags($this->PhoneNumber));

    // bind values

    $stmt->bindParam(':Username', $this->Username);
    $stmt->bindParam(':Password', $this->Password);
    $stmt->bindParam(':NAtionality', $this->NAtionality);
    $stmt->bindParam(':Age', $this->Age);
    $stmt->bindParam(':Gender', $this->Gender);
    $stmt->bindParam(':Email', $this->Email);
    $stmt->bindParam(':PhoneNumber', $this->PhoneNumber);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;

}
// used when filling up the update product form
function readOne(){

    // query to read single record
    $query = "SELECT * FROM " . $this->table_name ." WHERE VID = ? ";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->VID);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->Username = $row['Username'];
    $this->Password = $row['Password'];
    $this->NAtionality = $row['NAtionality'];
    $this->Age = $row['Age'];
    $this->Gender = $row['Gender'];
    $this->Email = $row['Email'];
    $this->PhoneNumber = $row['PhoneNumber'];

}


// check if given email exist in the database
function emailExists(){

    // query to check if email exists
    $query = "SELECT *
            FROM " . $this->table_name . "
            WHERE `Email` = '" . $this->Email."'
            LIMIT 0,1";



    // prepare the query
    $stmt = $this->conn->prepare( $query );


    // sanitize
    $this->Email=htmlspecialchars(strip_tags($this->Email));

    // bind given email value
    $stmt->bindParam(1, $this->Email);

    // execute the query
    $stmt->execute();

    // get number of rows
    $num = $stmt->rowCount();
    
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){

        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // assign values to object properties
        $this->VID = $row['VID'];
        $this->Username = $row['Username'];
        $this->Email = $row['Email'];
        $this->Password = $row['Password'];

        // return true because email exists in the database
        return true;
    }

    // return false if email does not exist in the database
    return false;
}

// update() method will be here

}
