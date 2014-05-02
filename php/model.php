<?php

include 'sqldb.php';

class model extends sqldb {
  

  function __construct($post, $type) {
    
    // Currently, no reason to pass another config to our sql class
    parent::__construct();
    
    $type = ($type == 'search') ? 'search' : 'create';

    $type .= '_query';

    // On instantiation, run our search query
    $this->$type($post);
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
  public function search_query($post = FALSE, $id = FALSE) {
    
    $post = ($post !== FALSE) ? $post : '';
    $id = ($id !== FALSE) ? "AND a.apart_pk = $id" : '';

    // Lets clean up the data before we give it to our database
    //$data = $this->cleanPOSTData($post);
    
    // SQL query
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
      ".$id."
      ORDER BY
        a.price
    ";
    
    // Run the query. The values are received in the form of an associative array
    $result = $this->runSQL($query);
    
    // Clean up our inputs
    $html = $this->cleanSQLData($result);

    // Give our data to our html generator
    //$this->buildHTML($html);
    if ($id === FALSE) {
      $this->buildHTML($html);
    } else {
      return $html;
    }
  }


  public function create_query($post) {
    
    // Lets clean up the data before we give it to our database
    $data = $this->cleanPOSTData($post);

    // SQL query
    $query = '
      INSERT INTO apartment 
      (
        build_fk,
        story,
        floorplan,
        status,
        price,
        has_internet,
        has_microwave,
        has_patio,
        has_dishwasher,
        has_washdry
      )
      VALUES
      ('.$data['window'].',
       1,
       "'.$data["floorplan"].'",
       1,
       '.$data["price"].',
       '.$data["has_internet"].',
       '.$data["has_microwave"].',
       '.$data["has_patio"].',
       '.$data["has_dishwasher"].',
       '.$data["has_washdry"].')   
    ';
    
    // Run the query. The values are received in the form of an associative array
    $id = $this->createSQL($query);

    $html = $this->search_query(FALSE, $id);

    // Give our data to our html generator
    $this->buildSingleHTML($html);
  }


    /**
   * This will sanitize our inputs before we use them in the sql
   * (sql injection prevention)
   */
  private function cleanPOSTData($post) {

    $data = array();

    $data['window'] = (array_key_exists('window', $post)) ? $post['window'] : 0;
    $data['floorplan'] = (array_key_exists('floorplan', $post)) ? $post['floorplan'] : 'studio';
    $data['price'] = (array_key_exists('price', $post) && is_numeric($post['price'])) ? $post['price'] : 0;
    $data['has_internet'] = (array_key_exists('has_internet', $post) == 1) ? 1 : 0; 
    $data['has_microwave'] = (array_key_exists('has_microwave', $post) == 1) ? 1 : 0; 
    $data['has_patio'] = (array_key_exists('has_patio', $post) == 1) ? 1 : 0; 
    $data['has_dishwasher'] = (array_key_exists('has_dishwasher', $post) == 1) ? 1 : 0; 
    $data['has_washdry'] = (array_key_exists('has_washdry', $post) == 1) ? 1 : 0; 

    return $data;
  }


  /**
   * This will reformat the data from the sql to something visually
   * more appealing to the client
   */
  private function cleanSQLData($sql) {

    foreach ($sql as $value => $key) {

      foreach ($key as $data => $result) {
        
        switch ($data) {

          case 'floorplan':   
            // Handle "studio"
            $sql[$value][$data] = ucfirst($result);

            // Handle "1Bed,2Bed"
            if (is_numeric($result[0])) {
              $sql[$value][$data] = preg_replace('/^.{1}/', "$0 ", $result."room");
            }
            break;

          case 'price':
            // Handle dollar sign
            $sql[$value][$data] = preg_replace('/^/', "$$0", $result);
            break;

          case 'has_internet':
          case 'has_washdry':
          case 'has_dishwasher':
          case 'has_patio':
          case 'has_microwave':
            // Handle 0 and 1
            $sql[$value][$data] = ($result) ? 'Yes' : 'No';
            break;

          default:
            break;
        }
      }
    }

    return $sql;
  }


  public function buildHTML($data) {

    // Search results container
    $html = '<div class="col-sm-12" style="padding-bottom: 50px">';

    // Counter for box switching
    $switch = 1;

    foreach($data as $value => $key) {

      // Which sides the box is on
      $side = ($switch) ? 'left' : 'right';

      $html .= ($switch) ? '<div class="row" style="padding-bottom: 40px">' : '';

      // Apartment container
      $html .= '<div class="col-sm-5 cont-border pull-'.$side.'" style="margin-'.$side.': 70px">';

      // Determine which photo we are using
      switch ($key['floorplan']) {
        case 'Studio':
          $img = 'studio';
          break;

        case '1 Bedroom':
          $img = '1bed';
          break;

        case '2 Bedroom':
          $img = '2bed';
          break;

        default:
          break;
      }

      // Each row of data
      $html .= '
        <div class="row text-center" id="apt-image">
          <img src="images/'.$img.'.png" alt="apartment image" class="img-rounded" width="95%" height="180px">
        </div>

        <div class="row text-center" id="apt-floorplan"> 
          <h3>'.$key["floorplan"].' - '.$key["price"].'/month</h3><hr style="width: 70%">
        </div><BR>

        <div class="row text-center" id="apt-direction-internet"> 
          <span style="font-size: 17px">Direction Facing: <span style="color: #000; font-weight: bold">'.$key["build_name"].'</span>
          <span style="border-left: 1px solid #999; margin: 0 20px 0 20px"></span>
          Has Internet?: <span style="color: #000; font-weight: bold">'.$key["has_internet"].'</span></span>
        </div><BR>

        <div class="row text-center" id="apt-direction-internet"> 
          <span style="font-size: 17px">Has Microwave?: <span style="color: #000; font-weight: bold">'.$key["has_microwave"].'</span>
          <span style="border-left: 1px solid #999; margin: 0 20px 0 20px"></span>
          Has Patio?: <span style="color: #000; font-weight: bold">'.$key["has_patio"].'</span></span>
        </div><BR>

        <div class="row text-center" id="apt-direction-internet"> 
          <span style="font-size: 17px">Has Dishwasher: <span style="color: #000; font-weight: bold">'.$key["has_dishwasher"].'</span>
          <span style="border-left: 1px solid #999; margin: 0 20px 0 20px"></span>
          Has Washer/Dryer?: <span style="color: #000; font-weight: bold">'.$key["has_washdry"].'</span></span>
        </div>';

      // End apartment container
      $html .= '</div>';

      $html .= (! $switch) ? '</div>' : '';

      // Handles flipping between sides
      $switch = ($switch) ? 0 : 1;
    }

    // End search results container
    $html .= '</div>';

    // Send our html to the client
    echo $html;
  }


  public function buildSingleHTML($data) {

    // Search results container
    $html = '';

    // Counter for box switching
    $switch = 1;

    foreach($data as $value => $key) {

      // Determine which photo we are using
      switch ($key['floorplan']) {
        case 'Studio':
          $img = 'studio';
          break;

        case '1 Bedroom':
          $img = '1bed';
          break;

        case '2 Bedroom':
          $img = '2bed';
          break;

        default:
          break;
      }

      // Each row of data
      $html .= '
        <div class="row text-center" id="apt-image">
          <img src="images/'.$img.'.png" alt="apartment image" class="img-rounded" width="95%" height="180px">
        </div>

        <div class="row text-center" id="apt-floorplan"> 
          <h3>'.$key["floorplan"].' - '.$key["price"].'/month</h3><hr style="width: 70%">
        </div>

        <div class="row text-center" id="apt-direction-internet"> 
          <span style="font-size: 17px">Direction Facing: <span style="color: #3498db; font-weight: bold">'.$key["build_name"].'</span>
          <span style="border-left: 1px solid #999; margin: 0 20px 0 20px"></span>
          Has Internet?: <span style="color: #3498db; font-weight: bold">'.$key["has_internet"].'</span></span>
        </div><BR>

        <div class="row text-center" id="apt-direction-internet"> 
          <span style="font-size: 17px">Has Microwave?: <span style="color: #3498db; font-weight: bold">'.$key["has_microwave"].'</span>
          <span style="border-left: 1px solid #999; margin: 0 20px 0 20px"></span>
          Has Patio?: <span style="color: #3498db; font-weight: bold">'.$key["has_patio"].'</span></span>
        </div><BR>

        <div class="row text-center" id="apt-direction-internet"> 
          <span style="font-size: 17px">Has Dishwasher: <span style="color: #3498db; font-weight: bold">'.$key["has_dishwasher"].'</span>
          <span style="border-left: 1px solid #999; margin: 0 20px 0 20px"></span>
          Has Washer/Dryer?: <span style="color: #3498db; font-weight: bold">'.$key["has_washdry"].'</span></span>
        </div>';
    }

    // Send our html to the client
    echo $html;
  }
}
