<?php
class Category{
  
    // database connection and table name
    private $conn;
    private $table_name = "category";
  
    // object properties
    public $id;
    public $name;
    public $image;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    function read(){
        //select all data
        $query = "SELECT
                    cat_id, cat_name , cat_image
                FROM
                    " . $this->table_name . "
                ORDER BY
                    cat_name";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
function readAll($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            ORDER BY
                cat_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
    // used to read category  by its ID
function readcatbyid(){
      
    $query = "SELECT * FROM " . $this->table_name . " WHERE cat_id = ? limit 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->name  = $row['cat_name'];
    $this->image = $row['cat_image'];
}
  
    // create category
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    cat_name=:name, cat_image=:image";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name  =htmlspecialchars(strip_tags($this->name));
        $this->image =htmlspecialchars(strip_tags($this->image));
  
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }

     // create category
    function update(){
  
        //write query
        $query = "UPDATE 
                    " . $this->table_name . "
                SET
                    cat_name=:name, cat_image=:image
                WHERE
                cat_id = :id";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name  =htmlspecialchars(strip_tags($this->name));
        $this->image =htmlspecialchars(strip_tags($this->image));
  		$this->id    =htmlspecialchars(strip_tags($this->id));
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
  		$stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
// delete the category
function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE cat_id = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// used for paging products
public function countAll(){
  
    $query = "SELECT cat_id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}

}
?>