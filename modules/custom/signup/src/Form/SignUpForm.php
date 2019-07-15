<?php
/**
 * @file
 * Contains \Drupal\resume\Form\ResumeForm.
 */
namespace Drupal\signup\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;


class SignUpForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'signup_form';
  }
  public function buildForm(array $form, FormStateInterface $form_state) {
    $conn = Database::getConnection();
    $record = array();
    if (isset($_GET['num'])) {
       $query = $conn->select('signup', 'm')
           ->condition('id', $_GET['num'])
           ->fields('m');
       $record = $query->execute()->fetchAssoc();
   }

    $form['candidate_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Candidate Name:'),
      '#required' => TRUE,
      '#default_value' => (isset($record['name']) && $_GET['num']) ? $record['name']:'',
    );

    $form['candidate_mail'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
      '#default_value' => (isset($record['email']) && $_GET['num']) ? $record['email']:'',
    );
    $form['candidate_number'] = array (
      '#type' => 'tel',
      '#title' => t('Mobile no'),
      '#required'=>TRUE,
      '#default_value' => (isset($record['mobilenumber']) && $_GET['num']) ? $record['mobilenumber']:'',
    );
    $form['candidate_username'] = array (
      '#type' => 'textfield',
      '#title' => t('Username'),
      '#required'=>TRUE,
    //  '#default_value' => (isset($record['username']) && $_GET['num']) ? $record['username']:'',
    );

    $form['candidate_dob'] = array (
      '#type' => 'date',
      '#title' => t('DOB'),
      '#required' => TRUE,
      '#default_value' => (isset($record['dob']) && $_GET['num']) ? $record['dob']:'',
    );
    $form['candidate_gender'] = array (
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'Female' => t('Female'),
        'male' => t('Male'),
        '#default_value' => (isset($record['gender']) && $_GET['num']) ? $record['gender']:'',
      ),
    );
    $form['candidate_confirmation'] = array (
      '#type' => 'radios',
      '#title' =>t ('Are you above 18 years old?'),
      '#options' => array(
        'Yes' =>t('Yes'),
        'No' =>t('No')
      ),
    );
    $form['candidate_password'] = array (
      '#type' => 'password',
      '#title' => t('Create Password'),
      '#required'=>TRUE,
    //  '#default_value' => (isset($record['password']) && $_GET['num']) ? $record['password']:'',

    );
    $form['candidate_password_confirmed'] = array (
      '#type' => 'password',
      '#title' => t('Confirmed Password'),
      '#required'=>TRUE,
  //     '#default_value' => (isset($record['confirm_password']) && $_GET['num']) ? $record['confirm_password']:'',

    );
    $form['candidate_copy'] = array(
      '#type' => 'checkbox',
      '#title' => t('Send me a copy of the application.'),
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
      if (strlen($form_state->getValue('mobilenumber')) < 10) {
        $form_state->setErrorByName('mobilenumber', $this->t('Mobile number is too short.'));
      }
        if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password"]) === 0){
          $form_state->setErrorByName('name',$this->t('Invalid Password'));
        }
        if (int (strcmp ( $form_state->getValue('password'), $form_state->getValue('confirm_password') ))==0){
             $form_state->setErrorByName('name',$this->t('Password not matched'));
        }
      }


public function submitForm(array &$form, FormStateInterface $form_state) {
   drupal_set_message($this->t('@can_name ,WELCOME!', array('@can_name' => $form_state->getValue('candidate_name'))));
  // foreach ($form_state->getValues() as $key => $value) {
  //   drupal_set_message($key . ': ' . $value);

     $field=$form_state->getValues();
     $name=$field['candidate_name'];
     $number=$field['candidate_number'];
     $email=$field['candidate_mail'];
     $dob=$field['candidate_dob'];
     $gender=$field['candidate_gender'];
     $password=$field['candidate_password'];
     $pass=$field['candidate_password_confirmed'];
     $user=$field['candidate_username'];
    /* if (isset($_GET['num'])) {
           $field  = array(
             'name'   => $name,
             'mobilenumber' =>  $number,
             'email' =>  $email,
             'dob' => $dob,
             'gender' => $gender,

          );
         $query = \Drupal::database();
          $query->update('resume')
              ->fields($field)
              ->condition('id', $_GET['num'])
              ->execute();
          drupal_set_message("succesfully updated");
          $form_state->setRedirect('resume_display_table_controller_display');
      }
      else
     {*/
        $field  = array(
              'name'   =>  $name,
              'mobilenumber' =>  $number,
              'email' =>  $email,
              'dob' => $dob,
              'gender' => $gender,
              'password'=>$password,
              'confirm_password'=>$pass,
              'username'=>$user,
            );
          $query = \Drupal::database();
          $query ->insert('signup')
             ->fields($field)
             ->execute();
      //   drupal_set_message("succesfully saved");
          //$response = new RedirectResponse("/resume/form/table");

          //$response->send();
    //    }

   }

}
