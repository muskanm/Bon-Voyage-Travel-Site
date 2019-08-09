<?php
namespace Drupal\PackageBooking\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\PackageBooking\Controller\DisplayTable;
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
    return new Url('PackageBooking.display_table_controller_display');
 }
 public function getDescription() {
    return t('Are You Sure?');
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
    $rows = DisplayTable::display();
    $data = $rows['table']['#nid'];
    $current_path = \Drupal::request()->getPathInfo();
    $path_args = explode('/', $current_path);
    $nid = $path_args[3];

    return parent::buildForm($form, $form_state);
  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $query = \Drupal::database();
    $current_user = \Drupal::currentUser();
    $uid = $current_user->id();
    $rows = DisplayTable::display();
    $data = $rows['table']['#nid'];
    $current_path = \Drupal::request()->getPathInfo();
    $path_args = explode('/', $current_path);
    $nid = $path_args[3];
   //kint($data);die;
    foreach ($data as $value) {
      if ($value == $nid) {
        $query = \Drupal::database()->query("DELETE  from PackageBooking ,PackagePayment
          USING PackageBooking INNER JOIN PackagePayment
          where PackageBooking.nid = PackagePayment.nid
         AND PackageBooking.nid = '$nid' AND PackageBooking.uid = '$uid' "
        );
         $query->execute();
      }
    }
     drupal_set_message("succesfully deleted");
     $form_state->setRedirect('<front>');
   }
}
