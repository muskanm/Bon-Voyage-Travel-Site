<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\ArticleBlock.
 */
namespace Drupal\booking\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "booking",
 *   admin_label = @Translation("Booking block"),
 *   category = @Translation("Custom Booking block example")
 * )
 */
class BookingBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\booking_form\Form\BookingForm');
    return $form;
   }
}
