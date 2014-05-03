<?php

include 'sqldb.php';

class model extends sqldb {
  
  public $squery;
  public $cquery;


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

    if ($post !== FALSE) {
      // Lets clean up the data before we give it to our database
      $data = $this->cleanPOSTData($post);
      $fp    = ' AND a.floorplan = "'.$data['floorplan'].'"';
      $price = ($data['p_range'] == 1) ? ' AND a.price>700' : ' AND a.price<=700';
      $wind  = ' AND a.build_fk = ' . $data['window'];
      $intr  = ($data['has_internet'] == 1) ? ' AND a.has_internet = ' .$data['has_internet'] : '';
      $micro = ($data['has_microwave'] == 1) ? ' AND a.has_microwave = ' .$data['has_microwave'] : '';
      $patio = ($data['has_patio'] == 1) ? ' AND a.has_patio = ' .$data['has_patio'] : '';
      $dish  = ($data['has_dishwasher'] == 1) ? ' AND a.has_dishwasher = ' .$data['has_dishwasher'] : '';
      $wash  = ($data['has_washdry'] == 1) ? ' AND a.has_washdry = ' .$data['has_washdry'] : '';
    } else {
      $post = $fp = $price = $wind = $intr = $micro = $patio = $dish = $wash = '';

    }

    $id    = ($id !== FALSE) ? " AND a.apart_pk = $id" : "";

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
      ".$fp."
      ".$price."
      ".$wind."
      ".$intr."
      ".$micro."
      ".$patio."
      ".$dish."
      ".$wash."
      ORDER BY
        a.price
    ";

    $this->squery = $query;
    
    // Run the query. The values are received in the form of an associative array
    $result = $this->runSQL($query);
    
    // Clean up our inputs
    $html = $this->cleanSQLData($result);

    // Give our data to our html generator
    if ($id == NULL) {
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

    $this->cquery = $query;
    
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
    $data['p_range'] = (array_key_exists('p_range', $post) && $post['p_range'] == 'gt') ? 1 : 0;

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

    if (!empty($data)) {
      // Search results container
      $html = '<div class="col-sm-12">';

      $html .= '<button class="btn btn-primary btn-sm" data-toggle="modal" style="position: absolute; left: 10px; top: -80px" data-target="#sqlModal">SQL Code</button>';

      // Counter for box switching
      $switch = 1;

      foreach($data as $value => $key) {

        // Which sides the box is on
        $side = ($switch) ? 'left' : 'right';

        $html .= ($switch) ? '<div class="row" style="padding-bottom: 40px">' : '';

        // Apartment container
        $html .= '<div class="col-sm-5 cont-border apt-cont pull-'.$side.'" style="margin-'.$side.': 70px">';

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
    } else {
      $html = '<div class="col-md-12 text-center" style="padding-bottom: 20px">No Apartments Found</div>';
    }

    $html .= '
      <div class="modal fade" id="sqlModal" tabindex="-1" role="dialog" aria-labelledby="sql-query-code" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel" style="color: #34495e">SQL Search Query</h4>
            </div>
            <div class="modal-body" style="color: #34495e">
              '.$this->squery.'
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>';

    // Send our html to the client
    echo $html;
  }


  public function buildSingleHTML($data) {

    // Search results container
    $html = '<button class="btn btn-primary btn-sm" data-toggle="modal" style="position: absolute; right: 0; top: -70px" data-target="#sqlModal">SQL Code</button>';

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

    $html .= '
      <div class="modal fade" id="sqlModal" tabindex="-1" role="dialog" aria-labelledby="sql-query-code" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel" style="color: #34495e">SQL Insert Query</h4>
            </div>
            <div class="modal-body" style="color: #34495e">
              '.$this->cquery.'
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>';

    // Send our html to the client
    echo $html;
  }
}
