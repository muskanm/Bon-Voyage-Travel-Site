<?php
/**
 * @file
 * Contains \Drupal\resume\Form\WorkForm.
 */
namespace Drupal\booking_form\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class BookingForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'booking_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['booking_num'] = array(
      '#type' => 'textfield',
      '#title' => t('Booking No.'),
      '#required' => TRUE,
    );
    $form['actions']['#type'] = 'actions';
       $form['actions']['submit'] = array(
         '#type' => 'submit',
         '#value' => $this->t('Submit'),
         '#button_type' => 'primary',
       );

    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //drupal_set_message($this->t('@emp_name ,Your application is being submitted!', array('@emp_name' => $form_state->getValue('employee_name'))));
  }
}
