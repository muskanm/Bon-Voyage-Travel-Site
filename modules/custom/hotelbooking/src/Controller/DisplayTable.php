<?php

namespace Drupal\hotelbooking\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Drupal\node\Entity\Node;

class DisplayTable extends ControllerBase {
  public function display() {
    $conn = Database::getConnection();
    $record = array();
    $current_user = \Drupal::currentUser();
    $uid = $current_user->id();


    $header_table = array(
      'Hotel_Name' => t('Hotel Name'),
      'name' => t('Name'),
      'Mobile_Number' => t('Mobile Number'),
      'checkin' => t('Check In'),
      'checkout' => t('Check Out'),
      'rooms' => t('No. of Rooms Booked'),
      'opt' => t(''),
    );
    $query  = \Drupal::database()->query("SELECT * from HotelBooking Where uid = '$uid'");
    $data = $query->fetchAll();

    $rows = array();
    foreach($data as $result) {
      $nid[] = $result->nid;

      $delete = Url::fromUserInput('/hotelbooking/delete/'.$result->nid);

      $node = Node::load($result->nid)->getTitle();
      //kint($node);
      $rows[] = array(
        'Hotel_Name' => $node,
        'name' => $result->name,
        'Mobile_Number' => $result->Mobile_Number,
        'checkin' => $result->checkin,
        'checkout' => $result->checkout,
        'rooms' => $result->rooms,

        \Drupal::l('Cancel', $delete),
      );
    }
    //kint($nid);
    //kint($rows);
    $form['table'] = [
      '#type' => 'table',
      '#header' => $header_table,
      '#nid' => $nid,
      '#rows' => $rows,
      '#empty' => t('No Bookings found'),
      '#attributes' => [
        'class' => ['tableview']
      ],
    ];
    return $form;
  }
}
