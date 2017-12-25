<?php

namespace Drupal\d8_toptrumps01\Controller;

use Drupal\Core\Controller\ControllerBase;

class TopTrumpsController extends ControllerBase {

  public function get_top_trumps_game() {
    $element = array(

    '#type' => 'inline_template',
    '#template' => '
          <table border=2>

<tr><td colspan=1>
    


    
    <label for="afm">Παρακαλώ επιλέξτε επίθετο εκπαιδευτικού: </label>
    <div id="selectize">Loading...selectize afm</div><br>
   </td><td>

       <label for="afm">Παρακαλώ επιλέξτε παραρτημα: </label>
    <div id="selectize_building">Loading...selectize parartima_id</div><br> 
    </td></tr>    


    
    </table>
                  <BR>
                  <div id="cardgame">LOADING cardgame</div>
                  <!--<div id="example-table">Loading... sample-tabulator table</div><br> -->
                  
              ',
      //'#allowed_tags' => ['html'],          
      '#attached' => array(
        'library' => array(
          'd8_toptrumps01/app'
        )
      )
    );
    return $element;
  }

}
?>