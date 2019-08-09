<?php

namespace Drupal\PackageBooking\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PackageForm extends FormBase {
  public function getFormId() {
    return 'PackageBooking_form';
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
    $form['city']=array(
      '#type'=>'textfield',
      '#title' => t('City '),
      '#default_value' => (isset($record['city'])) ? $record['city']:'',
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
    $form['travellers']= array(
      '#type'=>'textfield',
      '#title'=>t('No. of Persons'),
      '#required'=>TRUE,
      '#default_value'=>(isset($record['travellers']))? $record['travellers']:'',
    );
    if(\Drupal::currentUser()->isAnonymous()){
      $response = new RedirectResponse('/user/login');
      $response->send();
    }
    else{
      $form['submit']=array(
        '#type' => 'submit',
        '#value' => $this->t('Proceed'),
        '#button_type' => 'primary',
      );
      return $form;
    }
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
    $field = $form_state->getValues();
    $name = $field['Name'];
    $dob = $field['dob'];
    $city = $field['city'];
    $number = $field['Mobile_Number'];
    $gender = $field['gender'];
    $email = $field['email'];
    $traveller = $field['travellers'];
    $field  = array(
      'name'=>$name,
      'dob' => $dob,
      'gender' => $gender,
      'Mobile_Number' => $number,
      'email' => $email,
      'city' => $city,
      'Persons' => $traveller,
      'nid' => $nid,
      'uid' => $uid,
    );
    $query = \Drupal::database();
    $query ->insert('PackageBooking')
           ->fields($field)
           ->execute();
    $response = new RedirectResponse("/package-payment");
    $response->send();
  }
}
