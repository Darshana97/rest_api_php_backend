<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: user-with-course');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/UserWithCourse.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog user object
  $user_with_course = new UserWithCourse($db);

  // Get raw usered data
  $data = json_decode(file_get_contents("php://input"));

  $user_with_course->user_id = $data->UserId;
  if(!$user_with_course->user_id){
    echo json_encode(
      array('message' => 'No id provided!')
    );
    return;
  }
  $user_with_course->course_id = $data->CourseId;


  // Create user
  if($user_with_course->create()) {
    echo json_encode(
      array('message' => 'User link with course Created')
    );
  } else {
    echo json_encode(
      array('message' => 'User link with course not Created')
    );
  }

