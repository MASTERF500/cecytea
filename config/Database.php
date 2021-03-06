<?php 
  class Database {
    // DB Params
    private $host = 'localhost';
    private $db_name = 'cecytea';
    private $username = 'root';
    private $password = '';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        //pdo driver de conexion a base de datos
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=cecytea', $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }