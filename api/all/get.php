<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: all');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/All.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog course object
  $all = new All($db);

  // Create course
  if($data = $all->get()) {
    echo json_encode(
      array($data)
    );
  } else {
    echo json_encode(
      array('message' => 'Can"t fetch data!')
    );
  }

