<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: user');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog user object
  $user = new User($db);

  // Get raw usered data
  $data = json_decode(file_get_contents("php://input"));

  $user->id = $data->UserId;
  if(!$user->id){
    echo json_encode(
      array('message' => 'No id provided!')
    );
    return;
  }
  $user->name = $data->Name;
  if(!$user->name){
    echo json_encode(
      array('message' => 'No name provided!')
    );
    return;
  }
  $user->user_name = $data->Username;
  $user->password = $data->Password;
  $user->gender = $data->Gender;
  if(!($user->gender=="Male" || $user->gender=="Female")){
    echo json_encode(
      array('message' => 'Gender is not valid!')
    );
    return;
  }
  $user->joined_date = $data->JoinedDate;

  // Create user
  if($user->create()) {
    echo json_encode(
      array('message' => 'user Created')
    );
  } else {
    echo json_encode(
      array('message' => 'user Not Created')
    );
  }

