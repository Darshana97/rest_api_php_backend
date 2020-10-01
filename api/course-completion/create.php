<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: course-completion');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/CourseCompletion.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog course object
  $course_completion = new CourseCompletion($db);

  // Get raw courseed data
  $data = json_decode(file_get_contents("php://input"));

  $course_completion->user_id = $data->UserId;
  $course_completion->course_id = $data->CourseId;
  $course_completion->points = $data->Points;
  $course_completion->time_spent = $data->TimeSpent;
  $course_completion->completed_date = $data->CompletedDate;
  $course_completion->status = $data->Status;


  // Create course
  if($course_completion->create()) {
    echo json_encode(
      array('message' => 'Course completion Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Course completion Not Created')
    );
  }

