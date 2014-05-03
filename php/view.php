<?php

include 'model.php';  // Connect with our database

/**
 * A class to control html output
 */
class view extends model {

  /**
   * On creation, hook up our model and outputs
   * 
   * @param [array] $args [config passed to the model]
   */
  function __construct($args = NULL) {

    // Run our model and return back results
    parent::__construct($args['post'], $args['type']);

    // Specifically make sure its a create (single), else we just search (multi)
    if ($this->data['type'] == 'single') {
      $this->buildSingleResultHTMLContainer($this->data['results']);
    } else {
      $this->buildMultiResultHTMLContainer($this->data['results']);
    }
  }


  /**
   * A two column layout for displaying 
   * our search results. Each container 
   * displays apartments specific information
   * 
   * @param  [array] $data [cleaned up sql results]
   */
  public function buildMultiResultHTMLContainer($data) {

    // Determine if we got any results back from the search query
    if (! empty($data)) {

      // Search results container
      $html   = '<div class="col-sm-12">';

      // Button to generate a modal that show the specific search query
      $html  .= '<button class="btn btn-primary btn-sm" data-toggle="modal" style="position: absolute; left: 10px; top: -80px" data-target="#sqlModal">SQL Code</button>';

      // Counter for box switching
      $switch = 1;

      // Go through each row of data we received
      foreach($data as $value => $key) {

        // Which sides the box is on
        $side  = ($switch) ? 'left' : 'right';

        $html .= ($switch) ? '<div class="row" style="padding-bottom: 40px">' : '';

        // Apartment container
        $html .= '<div class="col-sm-5 cont-border apt-cont pull-'.$side.'" style="margin-'.$side.': 70px">';

        // Build our container that holds the apartment information display
        $html .= $this->generateResultContainer($key);

        // End apartment container
        $html .= '</div>';

        // Determine if we are at the end of the row or not
        $html .= (! $switch) ? '</div>' : '';

        // Handles flipping between sides
        $switch = ($switch) ? 0 : 1;
      }

      // End search results container
      $html .= '</div>';
    } else {

      // We didn't receive any data from the search query
      $html = '<div class="col-md-12 text-center" style="padding-bottom: 20px">No Apartments Found</div>';
    }

    // This holds and displays the specific query used to gather the results
    $html .= $this->generateModal($this->squery, 'Search');

    // Send our html to the client
    echo $html;
  }


  /**
   * A one column layout for 
   * displaying our new apartment.
   * 
   * @param  [array] $data [information on the newly created aparment]
   */
  public function buildSingleResultHTMLContainer($data) {

    // Search results container
    $html = '<button class="btn btn-primary btn-sm" data-toggle="modal" style="position: absolute; right: 0; top: -70px" data-target="#sqlModal">SQL Code</button>';

    // Counter for box switching
    $switch = 1;

    // Go through each row of data we received
    foreach($data as $value => $key) {

      // Build our container that holds the apartment information display
      $html .= $this->generateResultContainer($key);
    }

    // This holds and displays the specific query used to gather the results
    $html .= $this->generateModal($this->cquery, 'Insert');

    // Send our html to the client
    echo $html;
  }


  /**
   * This builds our modal that displays 
   * the sql query we used to gather the results
   * 
   * @param  [string] $query [the entire sql query]
   * @param  [string] $title [the type of query it was]
   * @return [string] $html  [html code for the modal]
   */
  public function generateModal($query, $title) {

    // A modal that slides down from the top
    $html = '
      <div class="modal fade" id="sqlModal" tabindex="-1" role="dialog" aria-labelledby="sql-query-code" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              
              <h4 class="modal-title" id="myModalLabel" style="color: #34495e">SQL '.$title.' Query</h4>
            </div>
            
            <div class="modal-body" style="color: #34495e">
              '.$query.'
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>';

    // Hand it back to our layout
    return $html;
  }


  /**
   * This is the container that holds and displays 
   * the information on the specific apartment
   * 
   * @param  [array] $data [cleaned values from the sql]
   * @return [string]      [html container display]
   */
  public function generateResultContainer($data) {

    // Determine which photo we are using
    switch ($data['floorplan']) {
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

    // Data on the new apartment
    $html = '
      <div class="row text-center" id="apt-image">
        <img src="static/images/'.$img.'.png" alt="apartment image" class="img-rounded" width="95%" height="180px" style="box-shadow: 0 0 6px #000">
      </div>

      <div class="row text-center" id="apt-floorplan"> 
        <h3>'.$data["floorplan"].' - '.$data["price"].'/month</h3><hr style="width: 70%">
      </div>

      <div class="row text-center" id="apt-direction-internet"> 
        <span style="font-size: 17px">Direction Facing: <span style="color: #3498db; font-weight: bold">'.$data["build_name"].'</span>
        <span style="border-left: 1px solid #999; margin: 0 20px 0 20px"></span>
        Has Internet?: <span style="color: #3498db; font-weight: bold">'.$data["has_internet"].'</span></span>
      </div><BR>

      <div class="row text-center" id="apt-direction-internet"> 
        <span style="font-size: 17px">Has Microwave?: <span style="color: #3498db; font-weight: bold">'.$data["has_microwave"].'</span>
        <span style="border-left: 1px solid #999; margin: 0 20px 0 20px"></span>
        Has Patio?: <span style="color: #3498db; font-weight: bold">'.$data["has_patio"].'</span></span>
      </div><BR>

      <div class="row text-center" id="apt-direction-internet"> 
        <span style="font-size: 17px">Has Dishwasher: <span style="color: #3498db; font-weight: bold">'.$data["has_dishwasher"].'</span>
        <span style="border-left: 1px solid #999; margin: 0 20px 0 20px"></span>
        Has Washer/Dryer?: <span style="color: #3498db; font-weight: bold">'.$data["has_washdry"].'</span></span>
      </div>';

    // Send back to our layout
    return $html;
  }
}

?>
