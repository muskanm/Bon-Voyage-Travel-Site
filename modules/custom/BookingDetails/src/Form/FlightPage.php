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

class FlightPage extends FormBase {
  public function getFormId() {
    return 'default_form';
  }

  /**
   * {@inheritdoc}
   */
   public function buildForm(array $form, FormStateInterface $form_state) {
     $conn = Database::getConnection();
     $record = array();
     $query = $conn->select('BookingDetails', 'B')
           ->fields('B',['id','travellers','nid'])
          ->orderBy('id', 'DESC');
     $record = $query->execute()->fetchAssoc('travellers');
     $traveller = (int)$record['travellers'];
     $form['#theme'] = 'sponsorship_form';
       $form['#tree'] = true; //Make the form fields a hierachical array*
       $form['#prefix'] = '<div id="sponsorship-form-wrapper">';
       $form['#suffix'] = '</div>';
       $form['sponsees'] = [
          '#type' => 'container',
          '#prefix' => '<div id="sponsees-fieldset-wrapper" class="quick-contact__form col-xs-12 col-md-6">',
          '#suffix' => '</div>',
       ];
       for ($i = 0; $i < $traveller; $i++) {
         $form['sponsees'][$i]['sponsee'] = [
           '#type' => 'fieldset',
           '#title' => $this->t('Traveller @i Details',['@i'=>$i + 1]),
         ];
         $form['sponsees'][$i]['sponsee']['firstname'] = [
           '#prefix' => '<div class="formdetails-containHead">',
           '#suffix' => '</div>',
           '#type' => 'textfield',
           '#title' => $this->t('Firstname'),
           '#placeholder' => $this->t('First Name'),
           '#maxlength' => 64,
           '#size' => 64,
            '#required' => TRUE,
           '#title_display' => 'invisible',
           '#attributes' => [
               'class' => ['formDetails--civility']
            ]
         ];
         $form['sponsees'][$i]['sponsee']['Lastname'] = [
           '#type' => 'textfield',
           '#title' => $this->t('Name'),
           '#placeholder' => $this->t('Last Name'),
           '#maxlength' => 64,
           '#size' => 64,
            '#required' => TRUE,
           '#title_display' => 'invisible',
           ];
           $form['sponsees'][$i]['sponsee']['gender'] = [
             '#type' => 'select',
             '#title' => $this->t('Gender'),
             '#options' => array('Male' => $this->t('Male'), 'Female' => $this->t('Female')),
             '#required' => TRUE,
              '#size' => 1,
           ];
           $form['sponsees'][$i]['sponsee']['dob'] = [
             '#type' => 'date',
             '#title' => $this->t('Date-Of-Birth'),
             '#required' => TRUE,
           ];
          }
          $form['sponsees']['submit']=[
            '#type'=>'submit',
            '#value'=>t('Submit'),
          ];
          return $form;
       }

   /**
    * {@inheritdoc}
    */
   public function validateForm(array &$form, FormStateInterface $form_state) {
       parent::validateForm($form, $form_state);
     }

   /**
    * {@inheritdoc}
    */
   public function submitForm(array &$form, FormStateInterface $form_state) {
     $conn = Database::getConnection();
     $record = array();
     $query = $conn->select('BookingDetails', 'B')
            ->fields('B',['id','travellers','nid'])
            ->orderBy('id', 'DESC');
     $record = $query->execute()->fetchAssoc('travellers','nid');
     $traveller = (int)$record['travellers'];
     $nid = $record['nid'];
     $current_user = \Drupal::currentUser();
     $uid = $current_user->id();
     for ($i = 0; $i < $traveller; $i++) {
       $field = $form_state->getValues();
       $fname = $field['sponsees'][$i]['sponsee']['firstname'];
       $lname = $field['sponsees'][$i]['sponsee']['Lastname'];
       $gender = $field['sponsees'][$i]['sponsee']['gender'];
       $dob = $field['sponsees'][$i]['sponsee']['dob'];
       $field  = array(
         'first_name'=>$fname,
         'last_name'=>$lname,
         'gender' => $gender,
         'dob' => $dob,
         'uid' => $uid,
         'nid' => $nid,
       );
       $query = \Drupal::database();
       $query ->insert('TravellerDetails')
              ->fields($field)
              ->execute();
      }
       $response = new RedirectResponse("/flights-payment");
       $response->send();
     }
 }
