<?php

namespace Drupal\BookingDetails\Controller;
//require_once  DRUPAL_ROOT . '/modules/custom/BookingDetails/src/Controller/DisplayFlightDetails.php';
//module_load_include('php','custom','src/Controller/DisplayFlightDetails');
//include "DisplayFlightDetails.php";

use Drupal\BookingDetails\Controller\DisplayFlightDetails;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

class DisplayTravellerDetails extends ControllerBase {

  // public $uid;
  public function display() {

    $rows = DisplayFlightDetails::display();
    $current_user = \Drupal::currentUser();
    $uid = $current_user->id();
    //kint($uid);
    $conn = Database::getConnection();
    $data = $rows['table']['#nid'];
    $current_path = \Drupal::request()->getPathInfo();
    $path_args = explode('/', $current_path);
    $nid = $path_args[3];
    foreach ($data as $value) {
      if ($value == $nid) {
        $query = \Drupal::database()->query("SELECT * from TravellerDetails as t where t.nid = '$nid' AND t.uid = '$uid' "
        );
        $results = $query->fetchAll();
      }
    }

    $header_table = array(
      'first_name' => t('First Name'),
      'last_name' => t('Last Name'),
      'gender' => t('Gender'),
      'dob' => t('Date-of-Birth'),
    );
    $rows=array();
    foreach($results as $data) {


      $rows[] = array(
        'first_name' => $data->first_name,
        'last_name ' => $data->last_name  ,
        'gender' => $data->gender,
        'dob' => $data->dob,
     );
   }
    $form['table'] = [
      '#type' => 'table',
      '#empty' => t('No Bookings found'),
      '#header' => $header_table,
      '#rows' => $rows,

      '#attributes' => [
        'class' => ['tableview']
      ],
    ];
    return $form;
    }
}
