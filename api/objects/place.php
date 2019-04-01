<?php
class Place{

    // database connection and table name
    private $conn;
    private $table_name = "place";

    // object properties
    public $PID;
    public $Category;
    public $Title;
    public $Description;
    public $lat;
    public $lang;
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
             Category=:Category,
             Description=:Description,
             lat=:lat,lang=:lang,image_name=:image_name , Title=:Title ";

    // prepare query
    $stmt = $this->conn->prepare($query);


    // sanitize

    $this->Category=htmlspecialchars(strip_tags($this->Category));
    $this->Description=htmlspecialchars(strip_tags($this->Description));
     $this->lat=htmlspecialchars(strip_tags($this->lat));
    $this->lang=htmlspecialchars(strip_tags($this->lang));
    $this->image_name=htmlspecialchars(strip_tags($this->image_name));
    $this->Title=htmlspecialchars(strip_tags($this->Title));

    // bind values

    $stmt->bindParam(':Category', $this->Category);
    $stmt->bindParam(':Description', $this->Description);
    $stmt->bindParam(':lat', $this->lat);
    $stmt->bindParam(':lang', $this->lang);
    $stmt->bindParam(':image_name', $this->image_name);
    $stmt->bindParam(':Title', $this->Title);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;

}
}
