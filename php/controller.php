<?php

/**
 * A class of functions for data manipulation / event handling
 */
class controller {

  public $data;   // Holds the formatted results

  /**
   * Not much happening here..
   */
  function __construct() {
    
    // Initialize our data holder
    $this->data = array();
  }


  /**
   * Cleaning up the data we receive from the post.
   * We put it in an easier format to manipulate
   * 
   * @param  [array] $post [data collected from the form]
   */
  public function cleanPOSTData($post) {

    // If there is junk data in our array, clean it out
    if (!empty($this->data)) {
      $this->data = array();
    }

    // Selector inputs
    $this->data['window']    = (array_key_exists('window', $post))    ? $post['window']    : 0;
    $this->data['floorplan'] = (array_key_exists('floorplan', $post)) ? $post['floorplan'] : 'studio';

    // Only specific to creating an apartment
    $this->data['price'] = (array_key_exists('price', $post) && is_numeric($post['price'])) ? $post['price'] : 0;

    // Our checkboxes/radios don't show up, so lets set them to 0 if not selected
    $this->data['has_internet']   = (array_key_exists('has_internet', $post) == 1)   ? 1 : 0; 
    $this->data['has_microwave']  = (array_key_exists('has_microwave', $post) == 1)  ? 1 : 0; 
    $this->data['has_patio']      = (array_key_exists('has_patio', $post) == 1)      ? 1 : 0; 
    $this->data['has_dishwasher'] = (array_key_exists('has_dishwasher', $post) == 1) ? 1 : 0; 
    $this->data['has_washdry']    = (array_key_exists('has_washdry', $post) == 1)    ? 1 : 0; 

    // Range value is either lt ot gt. We let gt stand as 1
    $this->data['p_range'] = (array_key_exists('p_range', $post) && $post['p_range'] == 'gt') ? 1 : 0;
  }


  /**
   * This will reformat the data from the sql to something visually
   * more appealing to the client
   * 
   * @param  [array] $sql [query results from the database]
   */
  public function cleanSQLData($sql) {

    // If there is junk data in our array, clean it out
    if (!empty($this->data)) {
      $this->data = array();
    }

    // First set all inputs to our holder
    $this->data = $sql;

    // Results are saved in an associative array, lets edit them up
    foreach ($this->data as $value => $key) {

      // One last layer to go
      foreach ($key as $attr => $result) {
        
        // Only need to edit certain columns output
        switch ($attr) {

          case 'floorplan':   

            // Handle "studio"
            $this->data[$value][$attr] = ucfirst($result);

            // Handle "1Bed,2Bed"
            if (is_numeric($result[0])) {
              $this->data[$value][$attr] = preg_replace('/^.{1}/', "$0 ", $result."room");
            }

            break;

          case 'price':
            
            // Handle dollar sign
            $this->data[$value][$attr] = preg_replace('/^/', "$$0", $result);
            
            break;

          case 'has_internet':
          case 'has_washdry':
          case 'has_dishwasher':
          case 'has_patio':
          case 'has_microwave':
            
            // Handle 0 and 1     
            $this->data[$value][$attr] = ($result) ? 'Yes' : 'No';
            
            break;

          default:
            break;
        }
      }
    }
  }
}

?>
