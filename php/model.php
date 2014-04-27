<?php

include 'sqldb.php';

class model extends sqldb {
  

  function __construct($args = FALSE) {
    
    parent::__construct();
    
    // On instantiation, run our search query
    $this->search_query($args);
  }
  
  
  /**
   * This is our big search query. It is given the POST that contains
   * all of our search information. We then build the query and send it
   * off to our database sql class to be processed. Once we receive the
   * sql results, we give it to our html generator to display.
   *
   * Search Parameters:
   *  - build_name = Set to a direction they face "North Building",
   *                 except these are just (North,East,West)
   *  - build_city = Self explanatory, values are (Gilbert,Chandler,Mesa)
   *  - story = Which level the apartment is located on (1,2,3)
   *  - floorplan = Type of apartment (studio,1Bed,2Bed)
   *  - status = Is the apartment being used or able to be rented (0,1)
   *  - price = Amount to pay per month ($500-$1000)
   *
   *  - BELOW ARE APARTMENT AMENITIES 
   *  - has_internet = High-Speed Internet (0,1)
   *  - has_microwave = Microvewave (0,1)
   *  - has_patio = Patio (0,1)
   *  - has_dishwasher = Dishwasher (0,1)
   *  - has_washdry = Washer and Dryer (0,1)
   */
  public function search_query($post) {
    
    //Test parameter for SQL
    $bid = $post['name'];
    //echo "name is " . $_POST['name'];
    
    //SQL query
    $query = "
      SELECT
        b.build_name,
        a.floorplan,
        a.price,
        a.has_internet,
        a.has_microwave,
        a.has_patio,
        a.has_dishwasher,
        a.has_washdry
      FROM
        apartment AS a
      INNER JOIN
        building AS b ON b.build_pk = a.build_fk
      WHERE
        a.status = 1
      ORDER BY
        b.build_name,
        a.price
    ";
    
    //Parameters must be stored in an array

    //Run the query. The values are received in the form of an associative array
    //$result = $this->prepSQL($this->conn, $query, "i", $params);
    $result = $this->runSQL($query);
    
    //Lets make sure we are getting the data back
    /*echo "Name = " . $result[0]['build_name'];
    echo "<BR>Address = " . $result[0]['build_address'];
    echo "<BR>Landlord = " . $result[0]['build_landlord'];*/
    $this->buildHTML($result);
  }


  public function buildHTML($data) {
    
    $html = '<div class="col-sm-6">';

    /*foreach ($data as $key => $value) {
      foreach ($value as $result) {
        $html .= ''.$result.'<br>';
      }
    }*/
    //print_r($data);
    foreach($data as $value => $key) {
      foreach($key as $title => $data) {
        echo "title is $title, value is $data<BR>";
      }
      echo "<BR>";
    }

    $html .= '</div>';

    echo $html;
  }
}
