<?php

include 'sqldb.php';       // Connect with our database
include 'controller.php';  // Connect with our data controller

/**
 * A class to control model content
 */
class model extends sqldb {

  public $control;      // Clean our data through this
  
  public $squery;       // Holds the search query for output
  public $cquery;       // Holds the insert query for output

  protected $data;      // Container of results

  /**
   * On creation, determine if we are 
   * performing a search or create query
   * 
   * @param [array]  $post [data collected from the form]
   * @param [string] $type [query choice]
   */
  function __construct($post, $type) {
    
    // Currently, no reason to pass another config to our sql class
    parent::__construct();

    // Connect up
    $this->control = new controller();

    // Determine if this is a search query or if we're making a new apartment    
    $func  = ($type == 'search') ? 'search' : 'create';

    // Determine if we are paying a bill
    $func  = ($type == 'pay') ? 'pay' : $func;

    $func .= 'Query';

    // On instantiation, run our search query then return the results
    $this->$func($post);
  }
  
  
  /**
   * This is our big search query. It is given the POST that contains
   * all of our search information. We then build the query and send it
   * off to our database sql class to be processed. Once we receive the
   * sql results, we give it to our html generator to display
   * 
   * @param  [array] $post [data collected from the form]
   * @param  [int]   $id   [id of a new apartment]
   */
  public function searchQuery($post = FALSE, $id = FALSE, $payment = FALSE) {

    /**
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

    // Search query
    if ($post !== FALSE) {

      // Lets clean up the data before we give it to our database
      $this->control->cleanPOSTData($post);

      // Let's prepare our inputs for the query
      $floor = ' AND a.floorplan = "'.$this->control->data['floorplan'].'"';
      $wind  = ' AND a.build_fk = ' . $this->control->data['window'];

      $intr  = ($this->control->data['has_internet'] == 1)   ? ' AND a.has_internet = ' .$this->control->data['has_internet']     : '';
      $micro = ($this->control->data['has_microwave'] == 1)  ? ' AND a.has_microwave = ' .$this->control->data['has_microwave']   : '';
      $patio = ($this->control->data['has_patio'] == 1)      ? ' AND a.has_patio = ' .$this->control->data['has_patio']           : '';
      $dish  = ($this->control->data['has_dishwasher'] == 1) ? ' AND a.has_dishwasher = ' .$this->control->data['has_dishwasher'] : '';
      $wash  = ($this->control->data['has_washdry'] == 1)    ? ' AND a.has_washdry = ' .$this->control->data['has_washdry']       : '';
      $price = ($this->control->data['p_range'] == 1)        ? ' AND a.price>700'                                                 : ' AND a.price<=700';
    } else {

      // Insert Query
      $post = $floor = $price = $wind = $intr = $micro = $patio = $dish = $wash = '';
    }

    // If we just created an apartment, we grab its data based off the new ID
    $payid = ($payment !== FALSE) ? "p.pay_pk = $id" : '';
    $id    = ($id !== FALSE)      ? " AND a.apart_pk = $id" : '';

    if ($payment === FALSE) {
      // SQL query (populated with a bunch of AND's)
      $query = "
        SELECT
          b.build_name,
          b.build_address,
          l.ll_name,
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
        INNER JOIN
          landlord as l ON l.ll_pk = b.build_landlord_fk
        WHERE
          a.status = 1
        ".$id."
        ".$floor."
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
    } else {
      $query = "
        SELECT
          t.tena_name,
          p.pay_type,
          p.pay_date,
          p.pay_processed,
          p.pay_amount
        FROM
          payment AS p
        INNER JOIN
          tenant AS t ON t.tena_pk = p.tena_fk
        WHERE
          ".$payid."
      ";
    }

    // Save this query so that we can view it from the browser
    $this->squery = $query;
    
    // Run the query. The values are received in the form of an associative array
    $result = $this->searchSQL($query);

    if ($result == 0) {
      echo "User not found";
      exit;
    }
    
    // Clean up our inputs for the html
    $this->control->cleanSQLData($result, $payment);

    // Type of html container we will display
    $type = ($id == NULL) ? 'multi' : 'single';

    $type = ($type == 'single' && $payment !== FALSE) ? 'pay' : $type;

    // Pass back the data to our view
    $this->data = array('results' => $this->control->data, 'type' => $type);
  }


  /**
   * An administrator ability to add 
   * a new apartment to the database
   * 
   * @param  [array] $post [data collected from the form]
   */
  public function createQuery($post) {
    
    // Lets clean up the data before we give it to our database
    $this->control->cleanPOSTData($post);

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
      ('.$this->control->data['window'].',
       1,
       "'.$this->control->data["floorplan"].'",
       1,
       '.$this->control->data["price"].',
       '.$this->control->data["has_internet"].',
       '.$this->control->data["has_microwave"].',
       '.$this->control->data["has_patio"].',
       '.$this->control->data["has_dishwasher"].',
       '.$this->control->data["has_washdry"].')   
    ';

    // Save this query so that we can view it from the browser
    $this->cquery = $query;
    
    // Run the query. The values are received in the form of an associative array
    $id = $this->createSQL($query);

    // Lets get information on the new apartment we just created
    $this->searchQuery(FALSE, $id);
  }


  /**
   * An administrator ability to add 
   * a new apartment to the database
   * 
   * @param  [array] $post [data collected from the form]
   */
  public function payQuery($post) {
    
    // Lets clean up the data before we give it to our database
    $this->control->cleanPOSTData($post, 'pay');

    $first = "
      SELECT
        tena_pk
      FROM  
        tenant
      WHERE
        tena_name = '".$this->control->data['payname']." ".$this->control->data['lastname']."'
    ";

    $result = $this->searchSQL($first);

    if (empty($result)) {
      echo "No user found";
      exit;
    } else {

      // SQL query
      $query = '
        INSERT INTO payment 
        (
          tena_fk,
          pay_type,
          pay_date,
          pay_processed,
          pay_amount
        )
        VALUES
        ('.$result[0]['tena_pk'].',
         "'.$this->control->data['paytype'].'",
         now(),
         1,
         '.$this->control->data['amount'].')   
      ';

      // Save this query so that we can view it from the browser
      $this->cquery = $query;
      
      // Run the query. The values are received in the form of an associative array
      $id = $this->createSQL($query);

      // Lets get information on the new apartment we just created
      $this->searchQuery(FALSE, $id, 'pay');
    }
  }
}

?>
