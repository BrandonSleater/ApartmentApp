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
        a.status = 1 AND
        a.has_internet = 0
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
    
    $html = '<div class="col-sm-12" style="padding-bottom: 100px">';

    $switch = 1; // Between left and right boxes

    foreach($data as $value => $key) {

      // Which sides the box is on
      $side = ($switch) ? 'left' : 'right';

      // Apartment Container
      $html .= '<div class="col-sm-5 pull-'.$side.'" style="border: 2px solid #000">';

      // Each row of data
      $html .= '
        <div class="row" id="apt-floorplan"> 
          Apartment Floorplan: '.$key["floorplan"].'
        </div>
        <div class="row" id="apt-direction"> 
          Apartment faces '.$key["build_name"].'
        </div>
        <div class="row" id="apt-price"> 
          Monthly Rent: '.$key["price"].'
        </div>
        <div class="row" id="apt-internet"> 
          Has internet?: '.$key["has_internet"].'
        </div>
        <div class="row" id="apt-microwave"> 
          Has a microwave?: '.$key["has_microwave"].'
        </div>
        <div class="row" id="apt-patio"> 
          Has a patio?: '.$key["has_patio"].'
        </div>
        <div class="row" id="apt-dishwasher"> 
          Has a dishwasher?: '.$key["has_dishwasher"].'
        </div>
        <div class="row" id="apt-washdry"> 
          Has a washer and dryer?: '.$key["has_washdry"].'
        </div>';

      $html .= '</div>';

      // Handles flipping between sides
      $switch = ($switch) ? 0 : 1;
    }

    $html .= '</div>';

    echo $html;
  }
}
