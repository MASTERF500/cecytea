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
  $post = new Post($db);
  //get parameters from url
  $parts = parse_url($url);
  

  // Get raw posted data
  //$data = json_decode(file_get_contents("php://input"));

  //$post->fecha = $data->fecha;
  //$post->longitud = $data->longitud;
  //$post->longitud = $data->longitud;
  //$post->altitud = $data->altitud;
  //$post->temt = $data->temt;
  //$post->humr = $data->humr;

  //New values

  $post->fecha = parse_str($parts['fecha'], $query);
  $post->longitud = parse_str($parts['longitud'], $query);
  $post->longitud = parse_str($parts['latitud'], $query);
  $post->altitud = parse_str($parts['latitud'], $query);
  $post->temt = parse_str($parts['temt'], $query);
  $post->humr = parse_str($parts['humr'], $query);


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

