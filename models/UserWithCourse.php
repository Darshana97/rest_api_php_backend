<?php 
  class UserWithCourse {
    // DB stuff
    private $conn;
    private $table = 'user_with_course';

    // UserWithCourse Properties
    public $user_id;
    public $course_id;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }


    

    // Create UserWithCourse
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET user_id = :user_id, course_id = :course_id';
          // $query = 'INSERT INTO ' . $this->table . ' VALUES ( :user_id, :course_id)';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->user_id = htmlspecialchars(strip_tags($this->user_id));
          $this->course_id = htmlspecialchars(strip_tags($this->course_id));
          

          // Bind data
          $stmt->bindParam(':user_id', $this->user_id);
          $stmt->bindParam(':course_id', $this->course_id);
         
          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
    
  }