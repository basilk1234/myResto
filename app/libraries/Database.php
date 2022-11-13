<?php


   // here I put all the statements that execute the queries to make it easir and faster to 
   //execute
  class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbshortcut;
   
   
   
 private $stmt;

 private $error;




    public function __construct(){
 
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

      $options = array(

        PDO::ATTR_PERSISTENT => true,
        
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

      );


      try{
        $this->dbshortcut = new PDO($dsn, $this->user, $this->pass, $options);
      } catch(PDOException $e){
       //
        $this->error = $e->getMessage();
                   echo $this->error;
      }
    }


    public function query($sql){
      $this->stmt = $this->dbshortcut->prepare($sql);
    }

    public function con(){
      $con = mysqli_connect('localhost','root','','resto');
    }

    public function resultSet(){

      //get array of objects 
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
 
    public function associate($param, $value, $type = null){
      if(is_null($type)){
        switch(true){
          case is_int($value):
            $type = PDO::PARAM_INT;
            break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
          default:
            $type = PDO::PARAM_STR;
        }
      }
      //this is a bilt in method. 
      $this->stmt->bindValue($param, $value, $type);
    }

    // execute statement 
    public function execute(){
      return $this->stmt->execute();
    }


    public function rowCount(){

      //we wanna get the rows
      return $this->stmt->rowCount();
    }


} 