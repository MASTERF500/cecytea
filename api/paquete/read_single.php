<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Paquete.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Paquete($db);
  
  // Blog post query
  $result = $post->read_single_ultimate();   //Se llama el servicio http://localhost:8080/cecytea/api/paquete/read_single.php
  // Get row count
  if($result['ultima_fecha']) {
    // Post array
    $posts_arr = array();
    $post_item = array($result);
    array_push($posts_arr, $post_item);
    echo json_encode($posts_arr);
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
