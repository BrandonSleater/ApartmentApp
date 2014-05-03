<?php

class sqldb {

  public $conn;   // DB connection
  
  
  function __construct($args = FALSE) {
    
    // If mysqli config is passed, use it. Else use default
    $args = ($args !== FALSE) ? $args : $this->getConfig(); 
    
    $this->conn = @new mysqli($args['HOST'], $args['USER'], $args['PW'], $args['DB'], $args['PORT']);
		
    // If we can't connect, alert the user, else return a successful connection
    if ($this->conn->connect_errno) {
      
      // Build error message
      throw new Exception($this->conn->connect_errno);
		} else {
      
      // Successful connection
      return $this->conn;
    }
  }
  
  
  /**
   * Common DB config relating to our init script
   * 
   * @return type array
   */
  private function getConfig() {
    return [
      'HOST' => 'localhost',
      'USER' => 'selenium_test',
      'PW'   => '2K00L4SKOOL',
      'DB'   => 'selenium',
      'PORT' => 3306
    ];
  }


  /**
   * Simple function to query and return results in
   * an associative array. Little brother of function below
  */
  public function runSQL($sql) {

    // SQL result holder
    $data = array();

    // Run the sql
    $query = $this->conn->query($sql);

    if (! $query) {
      printf("Error Message: %s\n", $this->conn->error);
    }

    // Collect rows returned into an associative array
    while($result = $query->fetch_array(MYSQLI_ASSOC)) {

      // Give each row an index
      array_push($data, $result);
    }

    // Free result
    $query->free();

    // Close up the DB
    $this->conn->close();

    // Send it back to caller
    return $data;
  }
  

  public function createSQL($sql) {

    $query = $this->conn->query($sql);

    if (!$query) {
      printf("Error Message: %s\n", $this->conn->error);
    }

    return $this->conn->insert_id;
  }
}

?>
