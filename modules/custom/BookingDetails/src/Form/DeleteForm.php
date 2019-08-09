<?php
namespace Drupal\BookingDetails\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\BookingDetails\Controller\DisplayFlightDetails;
use Drupal\Core\Database\Database;
use Drupal\Core\Render\Element;

class DeleteForm extends ConfirmFormBase {
  public function getFormId(){
    return 'delete_form';
  }

  public function getQuestion() {
    return t('Do you want to cancel?');
 }
 public function getCancelUrl() {
    return new Url('BookingDetails.display_table_controller_display');
 }
 public function getDescription() {
    return t('Are you sure?');
  }
 public function getConfirmText() {
    return t('Yes');
  }
  public function getCancelText() {
    return t('No');
  }
  public function buildForm(array $form, FormStateInterface $form_state) {
    $current_user = \Drupal::currentUser();

    $uid = $current_user->id();
    $rows = DisplayFlightDetails::display();
    $data = $rows['table']['#nid'];
    $current_path = \Drupal::request()->getPathInfo();
    $path_args = explode('/', $current_path);
    $nid = $path_args[3];
    //kint($nid);

    return parent::buildForm($form, $form_state);
  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $query = \Drupal::database();
    $current_user = \Drupal::currentUser();
    $uid = $current_user->id();
    $rows = DisplayFlightDetails::display();
    $data = $rows['table']['#nid'];
    $current_path = \Drupal::request()->getPathInfo();
    $path_args = explode('/', $current_path);
    $nid = $path_args[3];

    foreach ($data as $value) {
      if ($value == $nid) {
        $query = \Drupal::database()->query("DELETE  from BookingDetails , TravellerDetails,FlightPayment
          USING BookingDetails INNER JOIN TravellerDetails
         INNER JOIN FlightPayment where BookingDetails.nid = TravellerDetails.nid AND TravellerDetails.nid = FlightPayment.nid
         AND BookingDetails.nid = '$nid' AND BookingDetails.uid = '$uid' "
        );
         $query->execute();
      }
    }


    // $query = \Drupal::database()->query("Delete from BookingDetails where uid='$uid' AND nid='$nid'");
    // $query->execute();
    // $query = \Drupal::database()->delete('TravellerDetails');
    // $query->condition('uid', $uid);
    // $query->condition('nid',$nid );
    // $query->condition('id',9 );
    // $query->execute();
    // $query = \Drupal::database()->delete('FlightPayment');
    // $query->condition('uid', $uid);
    // $query->condition('nid',$nid );
    // $query->condition('id',6 );
    // $query->execute();
  drupal_set_message("succesfully deleted");
  $form_state->setRedirect('<front>');
  }
}
