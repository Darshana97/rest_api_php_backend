<?php 
  class All {
    // DB stuff
    private $conn;
  


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }


    

    // Create Course
    public function get() {
          // Create query
          $query = 'SELECT * FROM course_completion JOIN users ON (users.id = course_completion.user_id) JOIN courses ON (courses.id = course_completion.course_id)';
          $q = $this->conn->query($query);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          // var_dump($q);
          return $q->fetch();
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
    
  }