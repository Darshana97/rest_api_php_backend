<?php 
  class Course {
    // DB stuff
    private $conn;
    private $table = 'courses';

    // Course Properties
    public $id;
    public $title;
    public $description;
    public $number_of_points;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }


    

    // Create Course
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET id = :id, title = :title, description = :description, number_of_points = :number_of_points';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->description = htmlspecialchars(strip_tags($this->description));
          $this->number_of_points = htmlspecialchars(strip_tags($this->number_of_points));


          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':description', $this->description);
          $stmt->bindParam(':number_of_points', $this->number_of_points);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
    
  }