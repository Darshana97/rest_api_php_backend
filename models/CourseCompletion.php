<?php 
  class CourseCompletion {
    // DB stuff
    private $conn;
    private $table = 'course_completion';

    // User Properties
    public $user_id;
    public $course_id;
    public $points;
    public $time_spent;
    public $completed_date;
    public $status;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }


    

    // Create User
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET user_id = :user_id, course_id = :course_id, points = :points, time_spent = :time_spent, completed_date = :completed_date, status = :status ';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->user_id = htmlspecialchars(strip_tags($this->user_id));
          $this->course_id = htmlspecialchars(strip_tags($this->course_id));
          $this->points = htmlspecialchars(strip_tags($this->points));
          $this->time_spent = htmlspecialchars(strip_tags($this->time_spent));
          $this->completed_date = htmlspecialchars(strip_tags($this->completed_date));
          $this->status = htmlspecialchars(strip_tags($this->status));

          // Bind data
          $stmt->bindParam(':user_id', $this->user_id);
          $stmt->bindParam(':course_id', $this->course_id);
          $stmt->bindParam(':points', $this->points);
          $stmt->bindParam(':time_spent', $this->time_spent);
          $stmt->bindParam(':completed_date', $this->completed_date);
          $stmt->bindParam(':status', $this->status);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
    
  }