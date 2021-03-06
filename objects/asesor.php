<?php

class Asesor{
 
    // database connection and table name
    private $conn;
    private $table_name = "asesor";
 
    // object properties
    public $uid;
    public $displayName;
    public $email;
    public $photoURL;
    public $departamento;
    public $telefono;
    public $rol;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
     
        $query = "INSERT INTO " . $this->table_name . "(uid, nombre, email, picture,
        departamento, telefono, rol) VALUES (?,?,?,?,?,?,?);";

     
        // prepare the query
        $sql = $this->conn->prepare($query);

     	$this->uid=htmlspecialchars(strip_tags($this->uid));
        $this->displayName=htmlspecialchars(strip_tags($this->displayName));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->photoURL=htmlspecialchars(strip_tags($this->photoURL));
        $this->departamento=htmlspecialchars(strip_tags($this->departamento));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->rol=htmlspecialchars(strip_tags($this->rol));

        $sql->bindParam(1, $this->uid, PDO::PARAM_STR);
        $sql->bindParam(2, $this->displayName, PDO::PARAM_STR);
        $sql->bindParam(3, $this->email, PDO::PARAM_STR);
        $sql->bindParam(4, $this->photoURL, PDO::PARAM_STR);
        $sql->bindParam(5, $this->departamento, PDO::PARAM_STR);
        $sql->bindParam(6, $this->telefono, PDO::PARAM_STR);
        $sql->bindParam(7, $this->rol, PDO::PARAM_STR);


			     
        if($sql->execute()){
            return true;
        }
     
        return false;
    }

    // emailExists() 
    function uidExists(){

    $query = "SELECT uid
            FROM " . $this->table_name . "
            WHERE uid = ?
            LIMIT 0,1";

    $sql = $this->conn->prepare( $query );

    $this->uid=htmlspecialchars(strip_tags($this->uid));

    $sql->bindParam(1, $this->uid);

    $sql->execute();

    $num = $sql->rowCount();

    if($num>0){

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        $this->uid = $row['uid'];

        return true;
    }

    return false;
    }

    //Asesor info
    function readOne(){
     
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    uid = ?
                LIMIT
                    0,1";
     
        // prepare query statement
        $sql = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        $sql->bindParam(1, $this->uid);
     
        // execute query
        $sql->execute();
     
        // get retrieved row
        $row = $sql->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->uid = $row['uid'];
        $this->displayName = $row['nombre'];
        $this->email = $row['email'];
        $this->photoURL = $row['picture'];
        $this->departamento = $row['departamento'];
        $this->telefono = $row['telefono'];
        $this->rol = $row['rol'];
    }

}

?>