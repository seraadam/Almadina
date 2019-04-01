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
}
