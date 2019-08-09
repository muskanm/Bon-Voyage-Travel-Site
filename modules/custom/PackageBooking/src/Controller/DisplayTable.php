<?php

namespace Drupal\PackageBooking\Controller;

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
       'package_name' => t('Package Name'),
        'destination' => t('Destination'),
        'start_date' => t('Start Date'),
        'end_date' => t('End Date'),
        'hotel_name' => t('Hotel Name'),
        'start_flight' => t('Depart Flight'),
        'return_flight' => t('Return Flight'),
        'name' => t('Name'),
        'Mobile_Number' => t('Mobile Number'),
        'persons' => t('No. of Persons'),
        'opt' => t(''),
    );
    $query = \Drupal::database()->query("SELECT * from node__field_destination  as a
      INNER JOIN PackageBooking as b ON a.entity_id=b.nid INNER JOIN node__field_hotel_  as c ON a.entity_id=c.entity_id INNER JOIN node__field_start_date as d ON
      c.entity_id=d.entity_id INNER JOIN  node__field_end_date  as e ON d.entity_id=e.entity_id INNER JOIN
      node__field_depart_flight as f ON e.entity_id=f.entity_id INNER JOIN
      node__field_return_flight as g ON f.entity_id=g.entity_id  where b.uid='$uid'"
    );
    $results = $query->fetchAll();
    $rows=array();
    foreach($results as $data) {
      $terms = \Drupal\taxonomy\Entity\Term::load($data->field_destination_target_id);
      $destination=$terms->getName();
      $nid[] = $data->nid;
      $node0=Node::load($data->nid)->getTitle();
      $node=Node::load($data->field_hotel__target_id )->getTitle();
      $node1=Node::load($data->field_depart_flight_target_id )->getTitle();
      $node2=Node::load($data->field_return_flight_target_id )->getTitle();

      $delete = Url::fromUserInput('/packagebooking/delete/'.$data->nid);
      $rows[] = array(
        'package_name' => $node0,
        'destination' => $destination,
        'start_date' => $data->field_start_date_value,
        'end_date' => $data->field_end_date_value,
        'hotel_name' => $node,
        'start_flight' => $node1,
        'return_flight' => $node2,
        'name' => $data->name,
        'Mobile_Number' => $data->Mobile_Number ,
        'persons' => $data->Persons,

        \Drupal::l('Cancel', $delete),
      );
    }
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
