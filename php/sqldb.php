<?php

/**
 * A class for querying sql
 */
class sqldb {

  public $conn;   // DB connection
  
  /**
   * Automatically connect with our database for queries
   * 
   * @param [array] $args [can pass in another db config]
   */
  function __construct($args = false) {
    
    // If mysqli config is passed, use it. Else use default
    $args = ($args !== false) ? $args : $this->getConfig(); 
    
    // Make the actual connection with our database
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
   * Common DB config relating 
   * to our init script
   * 
   * @return type array
   */
  private function getConfig() {
    return array(
      'HOST' => 'localhost',
      'USER' => 'selenium_test',
      'PW'   => '2K00L4SKOOL',
      'DB'   => 'selenium',
      'PORT' => 3306
    );
  }


  /**
   * Simple function to query and return 
   * results in an associative array. Used mainly
   * for searching apartments
   * 
   * @param  [string] $sql  [the sql query]
   * @return [array]  $data [the sql results]
   */
  public function searchSQL($sql) {

    // SQL result holder
    $data = array();

    // Run the sql
    $query = $this->conn->query($sql);

    // Debugger if we get an error
    if (! $query) {
      printf("Error Message: %s\n", $this->conn->error);
    }

    // Collect rows returned into an associative array
    while($result = $query->fetch_array(MYSQLI_ASSOC)) {

      // Give each row an index
      array_push($data, $result);
    }

    // Free the result
    $query->free();

    // Close up the DB
    $this->conn->close();

    // Send it back to caller
    return $data;
  }
  

  /**
   * Even simpler function for creating our
   * apartments. Will give us an ID that we
   * then use with the above function
   * 
   * @param  [string] $sql [the sql query]
   * @return [int]    $id  [the id of the new apartment]
   */
  public function createSQL($sql) {

    // Run the sql
    $query = $this->conn->query($sql);

    // Debugger if we get an error
    if (! $query) {
      printf("Error Message: %s\n", $this->conn->error);
    }

    // Return the newly created row pk
    return $this->conn->insert_id;
  }
}

?>
