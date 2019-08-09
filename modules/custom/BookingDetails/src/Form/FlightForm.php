<?php

namespace Drupal\BookingDetails\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\CommandInterface;

class FlightForm extends FormBase {
  public function getFormId() {
    return 'BookingDetails_form';
  }
  public $nid;
  public function buildForm(array $form, FormStateInterface $form_state) {
    $conn=Database::getConnection();
    $record=array();
    $form['#tree'] = true; //Make the form fields a hierachical array*
    $form['#prefix'] = '<div id="sponsorship-form-wrapper">';
    $form['#suffix'] = '</div>';
    $form['Mobile_Number'] = [
      '#type' => 'textfield',
      '#title' => t('Mobile no.'),
      '#placeholder' => $this->t('Mobile No.'),
      '#required'=>TRUE,
      '#title_display' => 'invisible',
    ];
    $form['email'] = [
      '#type'=>'email',
      '#title'=>t("Email id:"),
      '#placeholder' => $this->t('Email Id'),
      '#required'=>TRUE,
      '#title_display' => 'invisible',
    ];
    $form['travellers'] = [
      '#type' => 'textfield',
      '#title' => $this->t('No. of travellers'),
      '#required' =>TRUE,
      '#size' => 1,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Next'),
      '#attributes' => [
      'class' => ['btn btn-full']
    ],
  ];
 return $form;
 }

    /**
    * {@inheritdoc}
    */
 public function validateForm(array &$form, FormStateInterface $form_state) {
   if (strlen($form_state->getValue('Mobile_Number')) < 10) {
     $form_state->setErrorByName('Mobile_Number', $this->t('Mobile number is too short.'));
   }
   if(!preg_match('/^[0-9]{10}+$/', $form_state->getValue('Mobile_Number'))) {
     $form_state->setErrorByName('Mobile_Number', $this->t('Enter digits only.'));
    }

  }

    /**
    * {@inheritdoc}
    */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $current_path = \Drupal::request()->getPathInfo();
    $path_args = explode('/', $current_path);
    $nid = $path_args[2];
    $current_user = \Drupal::currentUser();
    $uid = $current_user->id();
    $field = $form_state->getValues();
    $email = $field['email'];
    $number = $field['Mobile_Number'];
    $traveller = $field['travellers'];
    $field  = array(
      'email' => $email,
      'Mobile_Number' => $number,
      'travellers' => $traveller,
      'nid' => $nid,
      'uid' => $uid,
     );
     $query = \Drupal::database();
     $query ->insert('BookingDetails')
            ->fields($field)
            ->execute();
     $response = new RedirectResponse("/flights-booking-1");
     $response->send();
   }
}
