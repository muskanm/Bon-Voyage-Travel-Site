<?php

namespace Drupal\hotelbooking\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\node\NodeInterface;
use Drupal\node\Entity;
use Drupal\Core\Url;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\CommandInterface;

class HotelForm extends FormBase {
  public function getFormId() {
    return 'hotelbooking_form';
  }
  public $nid;
  public function buildForm(array $form,FormStateInterface $form_state) {
    $conn=Database::getConnection();
    $record=array();
    $form['Name']=array(
      '#type'=>'textfield',
      '#title'=>t('Name'),
      '#required'=>TRUE,
      '#default_value'=>(isset($record['Name']))? $record['Name']:'',
    );
      $form['dob'] = array (
        '#type' => 'date',
        '#title' => t('Date-Of-Birth'),
        '#required' => TRUE,
        '#default_value' => (isset($record['dob'])) ? $record['dob']:'',
      );
      $form['gender'] = array (
        '#type' => 'select',
        '#title' => ('Gender'),
        '#options' => array(
          'Female' => t('Female'),
          'male' => t('Male'),
          '#default_value' => (isset($record['gender'])) ? $record['gender']:'',
        ),
      );
      $form['message'] = array(
       '#type' => 'markup',
       '#markup' => '<div class="result_message"></div>'
     );
      $form['Mobile_Number']=array(
        '#type'=>'textfield',
        '#title' => t('Mobile no'),
        '#default_value' => (isset($record['Mobile_Number'])) ? $record['Mobile_Number']:'',
      );
      $form['email']=array(
        '#type'=>'email',
        '#title'=>t("Email id:"),
        '#required'=>TRUE,
        '#default_value'=>(isset($record['email']))?$record['email']:'',
      );
      $form['check_in']=array(
            '#type'=>'date',
            '#title'=>t('Check In'),
            '#required'=>TRUE,
            '#default_value' => (isset($record['check_in'])) ? $record['check_in']:'',
      );
      $form['check_out']=array(
          '#type'=>'date',
          '#title'=>t('Check Out'),
          '#required'=>TRUE,
          '#default_value'=>(isset($record['check_out']))? $record['check_out']:'',
      );
      $form['rooms']= array(
        '#type'=>'textfield',
        '#title'=>t('No. of Rooms required'),

        '#required'=>TRUE,
        '#default_value'=>(isset($record['rooms']))? $record['rooms']:'',
      );

      $form['submit']=array(
        '#type' => 'submit',
        '#value' => $this->t('Continue'),
        '#button_type' => 'primary',
      );
      return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state) {
      if (strlen($form_state->getValue('Mobile_Number')) < 10) {
        $form_state->setErrorByName('Mobile_Number', $this->t('Mobile number is too short.'));
      }
      if(!preg_match('/^[0-9]{10}+$/', $form_state->getValue('Mobile_Number'))) {
        $form_state->setErrorByName('Mobile_Number', $this->t('Enter digits only.'));
      }
    }
    public function submitForm(array &$form, FormStateInterface $form_state) {
      $current_path = \Drupal::request()->getPathInfo();
      $path_args = explode('/', $current_path);
      $nid = $path_args[2];
      $current_user = \Drupal::currentUser();
      $uid = $current_user->id();
      $field=$form_state->getValues();
      $name = $field['Name'];
      $dob = $field['dob'];
      $number = $field['Mobile_Number'];
      $gender = $field['gender'];
      $email = $field['email'];
      $checkin = $field['check_in'];
      $checkout = $field['check_out'];
      $rooms = $field['rooms'];
      $field  = array(
        'name' => $name,
        'dob' => $dob,
        'gender' => $gender,
        'Mobile_Number' => $number,
        'email' => $email,
        'checkin' => $checkin,
        'checkout' => $checkout,
        'rooms' => $rooms,
        'nid' => $nid,
        'uid' => $uid,
      );
      $query = \Drupal::database();
      $query ->insert('HotelBooking')
             ->fields($field)
             ->execute();
      $response = new RedirectResponse("/payment");
      $response->send();
    }
}
