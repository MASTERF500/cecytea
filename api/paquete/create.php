<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Paquete.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Paquete($db);
   //get parameters from url
  //$parts = parse_url($url);
  

  // Get raw posted data
  //$data = json_decode(file_get_contents("php://input"));

  //$post->fecha = $data->fecha;
  //$post->longitud = $data->longitud;
  //$post->longitud = $data->longitud;                           
  //$post->altitud = $data->altitud;
  //$post->temt = $data->temt;
  //$post->humr = $data->humr;
                                   //Se llama http://localhost:8080/cecytea/api/paquete/create.php
  //New values                     //Se Crea http://localhost:8080/cecytea/api/paquete/create.php?f=2019/06/07%2000:00:00&la=35.3ff422&ln=-120.222324&al=450&t=27.2&h=41
  $post->fecha = $_GET['f'];
  $post->latitud = $_GET['la'];
  $post->longitud = $_GET['ln'];
  $post->altitud = $_GET['al'];
  $post->temt = $_GET['t'];
  $post->humr = $_GET['h'];
  $post->CO2  = $_GET['co'];
  $post->TVOC = $_get['tv'];
  $post->PA   = $_GET['ps '];
  $post->VOLT  = $_GET['v'];
  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }

