<?php

namespace Drupal\BookingDetails\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;


class DisplayFlightDetails extends ControllerBase {
  public function display() {
    $conn = Database::getConnection();
    $record = array();
    $current_user = \Drupal::currentUser();
    $uid = $current_user->id();



    $header_table = array(
      'field_journey_date_value' => t('Journey Date'),
      'field_company_value' => t('Airline'),
      'field_depart_city_target_id '=>  t('Depart City'),
      'field_depart_time_value' => t('Depart Time'),
      'field_arrival_city_target_id ' => t('Arrival City'),
      'field_arrival_time_value' => t('Arrival Time'),
      'Mobile_Number' => t('Mobile Number'),
      'email'=> t('Email'),
      'travellers'=> t('No. of Tickets'),
      'opt' => t(' '),
      'opt1' => t(' '),
    );

    $query = \Drupal::database()->query("SELECT * from node__field_depart_city as a
      INNER JOIN BookingDetails as b ON a.entity_id=b.nid INNER JOIN node__field_company as c ON a.entity_id=c.entity_id INNER JOIN node__field_journey_date as d ON
      c.entity_id=d.entity_id INNER JOIN node__field_arrival_city  as e ON d.entity_id=e.entity_id INNER JOIN
      node__field_arrival_time as f ON e.entity_id=f.entity_id INNER JOIN
      node__field_depart_time as g ON f.entity_id=g.entity_id where b.uid = $uid"
    );
    $results = $query->fetchAll();
    $rows = array();

    foreach($results as $data){
      $terms = \Drupal\taxonomy\Entity\Term::load($data->field_depart_city_target_id);
      $depart_city=$terms->getName();
      $terms = \Drupal\taxonomy\Entity\Term::load($data->field_arrival_city_target_id);
      $arrival_city = $terms->getName();
      $journeydate = date( "Y-m-d", strtotime( "$data->field_journey_date_value  -5:30" ) );
      $dtime = gmdate(' H:i',$data->field_depart_time_value);
      $nid[] = $data->nid;
      $atime = gmdate('H:i',$data->field_arrival_time_value);
      $delete = Url::fromUserInput('/flightbooking/delete/'.$data->nid);
      $show = Url::fromUserInput('/flightbooking/travellerdetails/'.$data->nid);
      $rows[] = array(
        'field_journey_date_value' => $journeydate,
        'field_company_value'=>$data->field_company_value,
        'field_depart_city_target_id' =>  $depart_city ,
         'field_depart_time_value' => $dtime,
         'field_arrival_city_target_id' => $arrival_city,
         'field_arrival_time_value' => $atime,
         'Mobile_Number' => $data->Mobile_Number,
         'email' => $data->email,
         'travellers' => $data->travellers ,
         \Drupal::l('Cancel', $delete),
         \Drupal::l('Show Details',$show),

       );
     }

      $form['table'] = [
        '#empty' => t('No Bookings found'),
        '#type' => 'table',
        '#nid' => $nid,
        '#header' => $header_table,
        '#rows' => $rows,
        '#attributes' => [
            'class' => ['tableview']
          ],
        ];
        return $form;
      }
}
