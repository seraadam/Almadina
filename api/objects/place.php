<?php
class Place{

    // database connection and table name
    private $conn;
    private $table_name = "pois";

    // object properties
    public $PID;
    public $Category;
    public $Title;
    public $Description;
    public $Location;
    public $image_name;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read places
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

// create place
function create(){

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
             Category=:Category, Description=:Description,Location=:Location ,image_name=:image_name , Title=:Title ";

    // prepare query
    $stmt = $this->conn->prepare($query);


    // sanitize

    $this->Category=htmlspecialchars(strip_tags($this->Category));
    $this->Description=htmlspecialchars(strip_tags($this->Description));
    $this->Location=htmlspecialchars(strip_tags($this->Location));
    $this->image_name=htmlspecialchars(strip_tags($this->image_name));
    $this->Title=htmlspecialchars(strip_tags($this->Title));

    // bind values

    $stmt->bindParam(':Category', $this->Category);
    $stmt->bindParam(':Description', $this->Description);
    $stmt->bindParam(':Location', $this->Location);
    $stmt->bindParam(':image_name', $this->image_name);
    $stmt->bindParam(':Title', $this->Title);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;

}
}
