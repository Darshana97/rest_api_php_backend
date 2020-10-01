<?php 
  class User {
    // DB stuff
    private $conn;
    private $table = 'users';

    // User Properties
    public $id;
    public $name;
    public $user_name;
    public $password;
    public $gender;
    public $joined_date;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }


    

    // Create User
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET id = :id, name = :name, user_name = :user_name, password = :password, gender = :gender, joined_date = :joined_date ';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->user_name = htmlspecialchars(strip_tags($this->user_name));
          $this->password = htmlspecialchars(strip_tags($this->password));
          $this->gender = htmlspecialchars(strip_tags($this->gender));
          $this->joined_date = htmlspecialchars(strip_tags($this->joined_date));

          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':user_name', $this->user_name);
          $stmt->bindParam(':password', $this->password);
          $stmt->bindParam(':gender', $this->gender);
          $stmt->bindParam(':joined_date', $this->joined_date);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
    
  }