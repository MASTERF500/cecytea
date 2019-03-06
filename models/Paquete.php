<?php
    class Paquete{
        // DB stuff
        private $conn;
        private $table = 'datos';

        // Post Properties
        public $fecha;
        public $latitud;
        public $longitud;
        public $altitud;
        public $temt;
        public $humr;

        // Constructor with DB
        public function __construct($db) {
        $this->conn = $db;
        }

        // Get Posts
        public function read() {
        // Create query
        $query = 'SELECT  t.fecha,t.altitud,t.longitud,t.altitud,t.temt,t.humr  FROM ' . $this->table . ' t order by t.fecha';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        }

        // Get Single Post ( se modifico el nombre) ************
        public function read_single_ultimate() {
            // Create query
            $query = 'SELECT max(t.fecha) as ultima_fecha,t.altitud,t.longitud,t.altitud,t.temt,t.humr FROM ' . $this->table . ' t ';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            //$stmt->bindParam(1, $this->id);
            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->fecha = $row['ultima_fecha'];
            $this->latitud = $row['latitud'];
            $this->longitud = $row['longitud'];
            $this->altitud = $row['altitud'];
            $this->temt = $row['temt'];
            $this->humr = $row['humr'];
        }

        // Create Post
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . ' SET fecha = :fecha, latitud = :latitud, longitud = :longitud, temt = :temt, humr=: humr';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->fecha = htmlspecialchars(strip_tags($this->fecha));
            $this->latitud = htmlspecialchars(strip_tags($this->latitud));
            $this->longitud = htmlspecialchars(strip_tags($this->longitud));
            $this->temt = htmlspecialchars(strip_tags($this->temt));
            $this->humr = htmlspecialchars(strip_tags($this->humr));

            // Bind data
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':latitud', $this->latitud);
            $stmt->bindParam(':longitud', $this->longitud);
            $stmt->bindParam(':altitud', $this->altitud);
            $stmt->bindParam(':temt', $this->altitud);
            $stmt->bindParam(':humr', $this->altitud);

            // Execute query
            if($stmt->execute()) {
                return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
        }

    }