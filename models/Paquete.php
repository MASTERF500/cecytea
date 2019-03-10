<?php
    class Paquete{
        // DB stuff
        private $conn;
        private $table = 'paquete';

        // Post Properties
        public $fecha;
        public $latitud;
        public $longitud;
        public $altitud;
        public $temt;
        public $humr;
        public $CO2;
        public $TVOC;
        public $PS;
        public $VOLT;

        // Constructor with DB
        public function __construct($db) {
        $this->conn = $db;
        }

        // Get Posts
        public function read() {
        // Create query
        $query = 'SELECT  t.fecha,t.latitud,t.longitud,t.altitud,t.temt,t.humr,t.CO2,t.TVOC,t.PS,t.VOLT,  FROM ' . $this->table . ' t order by t.fecha';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        }
        public function read_ultimos_num($num) {
            // Create query
            $query = 'SELECT fecha,latitud,longitud,altitud,temt,humr,CO2,TVOC,PS,VOLT  FROM ' . $this->table . ' order by fecha asc LIMIT 0'. $num;
            // Prepare statement
            $stmt = $this->conn->prepare($query);
    
            // Execute query
            $stmt->execute();
    
            return $stmt;
            }

        // Get Single Post ( se modifico el nombre) ************
        public function read_single_ultimate() {
            // Create query
            $query = 'SELECT max(fecha) as ultima_fecha,latitud,longitud,altitud,temt,humr,CO2,TVOC,PS,VOLT FROM ' . $this->table ;

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
            $this->CO2 = $row['CO2'];
            $this->TVOC = $row['TVOC'];
            $this->PS = $row['PS'];
            $this->VOLT = $row['VOLT'];
            return $row;
        }

        // Create Post
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . ' set fecha = :fecha, latitud = :latitud, longitud = :longitud, altitud=:altitud, temt = :temt, humr= :humr, CO2 = :CO2, TVOC = :TVOC, PS = :PS, VOLT = :VOLT';
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->fecha = htmlspecialchars(strip_tags($this->fecha));
            $this->latitud = htmlspecialchars(strip_tags($this->latitud));
            $this->longitud = htmlspecialchars(strip_tags($this->longitud));
            $this->altitud = htmlspecialchars(strip_tags($this->altitud));
            $this->temt = htmlspecialchars(strip_tags($this->temt));
            $this->CO2 = htmlspecialchars(strip_tags($this->CO2));
            $this->TVOC = htmlspecialchars(strip_tags($this->TVOC));
            $this->PA = htmlspecialchars(strip_tags($this->PS));
            $this->VOL = htmlspecialchars(strip_tags($this->VOLT));
            // Bind data
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':latitud', $this->latitud);
            $stmt->bindParam(':longitud', $this->longitud);
            $stmt->bindParam(':altitud', $this->altitud);
            $stmt->bindParam(':temt', $this->temt);
            $stmt->bindParam(':humr', $this->humr);
            $stmt->bindParam(':CO2', $this->CO2);
            $stmt->bindParam(':TVOC', $this->TVOC);
            $stmt->bindParam(':PS', $this->PS);
            $stmt->bindParam(':VOLT', $this->VOLT);
            //$stmt->execute();
            // Execute query
            if($stmt->execute()) {
               return true;
            }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
        }

    }