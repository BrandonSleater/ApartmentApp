<?php

include 'php/sqldb.php';

class model extends sqldb {
  

  function __construct($args = FALSE) {
    
    parent::__construct($args);
  }
  
  
  /**
   * Basic test query to make sure we are communicating
   * with our DB and that the OOP Style SQL is working correctly
   */
  public function test_query() {
    
    //Test parameter for SQL
    $bid = 1;
    
    //SQL query
    $query = "
      SELECT
        build_name,
        build_address,
        build_landlord
      FROM
        building
      WHERE
        build_pk=?
    ";
    
    //Parameters must be stored in an array
    $params = [$bid]; 

    //Run the query. The values are received in the form of an associative array
    $result = $this->prepSQL($this->conn, $query, "i", $params);
    
    //Lets make sure we are getting the data back
    echo "Name = " . $result[0]['build_name'];
    echo "<BR>Address = " . $result[0]['build_address'];
    echo "<BR>Landlord = " . $result[0]['build_landlord'];
  }
}
