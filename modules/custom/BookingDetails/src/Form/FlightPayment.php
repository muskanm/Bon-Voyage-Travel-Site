<?php

namespace Drupal\BookingDetails\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\node\NodeInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\CommandInterface;
use Drupal\node\Entity\Node;

class FlightPayment extends FormBase {
  public function getFormId() {
    return 'flight_payment_form';
  }
  public function buildForm(array $form,FormStateInterface $form_state) {
    $conn = Database::getConnection();
    $record = array();
    $query = $conn->select('BookingDetails', 'b')
                  ->fields('b',['id','travellers','nid'])
                  ->orderBy('id', 'DESC');
    $record = $query->execute()->fetchAssoc('travellers');
    $traveller=(int)$record['travellers'];
    $node = Node::load($record['nid']);
    if ($node instanceof NodeInterface) {
      if ($node->hasField('field_price') && $node->field_price->value) {
        $price = $node->field_price->value;
      }
    }
     $value = $price;
     $onlyNumeric = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
     $n = (int)$onlyNumeric;
     drupal_set_message("Amount to pay is ₹".$n*$traveller);
     $form['card'] = array (
       '#type' => 'select',
       '#title' => ('Select Card Type'),
       '#options' => array(
         'credit' => t('Credit Card'),
         'debit' => t('Debit Card'),
         '#default_value' => (isset($record['card'])) ? $record['card']:'',
       ),
     );

      $form['bank'] = array(
        '#type' => 'textfield',
        '#title' => t('Enter Your Bank Name:'),
        '#required' => TRUE,
        '#default_value' => (isset($record['bank'])) ? $record['bank']:'',
      );
      $form['noc'] = array(
        '#type'=>'textfield',
        '#title'=>t('Name on Card:'),
        '#required'=>TRUE,
        '#default_value'=>(isset($record['noc'])) ? $record['noc']:'',
      );
      $form['card_no'] = array(
         '#type' => 'textfield',
         '#title' => t('Card No:'),
         '#required' => TRUE,
         '#default_value' => (isset($record['card_no'])) ? $record['card_no']:'',
       );
       $form['cvv'] = array(
         '#type' => 'password',
         '#title' => t('CVV:'),
         '#required' => TRUE,
         '#default_value' => (isset($record['cvv'])) ? $record['cvv']:'',
       );
       $form['doe'] = array (
         '#type' => 'date',
         '#title' => t('Date-Of-Expiry'),
         '#required' => TRUE,
         '#default_value' => (isset($record['doe'])) ? $record['doe']:'',
       );
       $form['message'] = array(
         '#type' => 'markup',
         '#markup' => '<div class="result_message"></div>'
       );
       $form['submit']=array(
         '#type' => 'submit',
         '#value'=> $this->t('Pay'),
         '#button_type' => 'primary',
         '#ajax'=> array(
           'callback'=>'::setMessage',
           'progress' => [
             'type' => 'throbber',
             'message' => $this->t('Verifying entry...'),
             ],
           ),
         );
         return $form;
       }
       public function setMessage(array $form, FormStateInterface $form_state) {
         $response = new AjaxResponse();
         $response->addCommand(
           new HtmlCommand(
             '.result_message',
             '<div class="my_top_message">' . t('Payment is successfully done. Thank You!') . '</div>' )
           );
           return $response;
         }
         public function validateForm(array &$form, FormStateInterface $form_state) {
           parent::validateForm($form, $form_state);
         }
         public function submitForm(array &$form, FormStateInterface $form_state) {
           $conn = Database::getConnection();
           $record = array();
           $query = $conn->select('BookingDetails', 'B')
                  ->fields('B',['id','travellers','nid'])
                  ->orderBy('id', 'DESC');
           $record = $query->execute()->fetchAssoc('travellers','nid');
           $nid = $record['nid'];
           $current_user = \Drupal::currentUser();
           $uid = $current_user->id();
           $field = $form_state->getValues();
           $cardtype = $field['card'];
           $bank = $field['bank'];
           $name = $field['noc'];
           $cardno = $field['card_no'];
           $cvv = $field['cvv'];
           $doe = $field['doe'];
           $field  = array(
             'card_type' => $cardtype,
             'bank' => $bank,
             'name_on_card' => $name,
             'card_no' => $cardno,
             'cvv' => $cvv,
             'card_expiry' => $doe,
             'nid' => $nid,
             'uid' => $uid,
           );
           $query = \Drupal::database();
           $query ->insert('FlightPayment')
                  ->fields($field)
                  ->execute();
          $form_state->setRedirect('<front>');
          }
    }
