<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: course');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Course.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog course object
  $course = new Course($db);

  // Get raw courseed data
  $data = json_decode(file_get_contents("php://input"));

  $course->id = $data->CourseID;
  $course->title = $data->Title;
  $course->description = $data->Description;
  $course->number_of_points = $data->NumberOfPoints;


  // Create course
  if($course->create()) {
    echo json_encode(
      array('message' => 'Course Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Course Not Created')
    );
  }

