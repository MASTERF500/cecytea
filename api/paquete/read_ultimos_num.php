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

  $cantidad= $_GET['cant'];
  // Blog post query
  $result = $post->read_ultimos_num($cantidad);         //Se llama http://localhost:8080/cecytea/API/Paquete/read_ultimos_num.php?cant=3
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'fecha' => $fecha,
        'latitud' => $latitud,
        'longitud' => $longitud,
        'altitud' => $altitud,
        'temt' => $temt,
        'humr' => $humr,
        'CO2'  => $CO2,
        'TVOC' => $TVOC,
        'PS'   => $PS,
        'VOLT'  => $VOLT
      );

      // Push to "data"
      array_push($posts_arr, $post_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }

  
