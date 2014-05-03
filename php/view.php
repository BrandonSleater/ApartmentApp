<?php

include 'model.php';  // Connect with our database

/**
 * A class to control html output
 */
class view extends model {
  
  //public $model;    // Data from our model

  /**
   * On creation, hook up our model and outputs
   * 
   * @param [array] $args [config passed to the model]
   */
  function __construct($args = NULL) {

    // Run our model and return back results
    parent::__construct($args['post'], $args['type']);

    // Specifically make sure its a create, else we just search
    if ($this->data['type'] == 'single') {
      $this->buildSingleResultHTMLContainer($this->data['results']);
    } else {
      $this->buildMultiResultHTMLContainer($this->data['results']);
    }
  }


  /**
   * [buildMultiResultHTMLContainer description]
   * 
   * @param  [type] $data [description]
   * @return [type]       [description]
   */
  public function buildMultiResultHTMLContainer($data) {

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
            <img src="images/'.$img.'.png" alt="apartment image" class="img-rounded" width="95%" height="180px" style="box-shadow: 0 0 6px #000">
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


  public function buildSingleResultHTMLContainer($data) {

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
          <img src="images/'.$img.'.png" alt="apartment image" class="img-rounded" width="95%" height="180px" style="box-shadow: 0 0 6px #000">
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

?>
