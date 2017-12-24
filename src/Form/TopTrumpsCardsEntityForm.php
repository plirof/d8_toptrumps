<?php

namespace Drupal\d8_toptrumps01\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Top trumps cards entity edit forms.
 *
 * @ingroup d8_toptrumps01
 */
class TopTrumpsCardsEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\d8_toptrumps01\Entity\TopTrumpsCardsEntity */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Top trumps cards entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Top trumps cards entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.top_trumps_cards_entity.canonical', ['top_trumps_cards_entity' => $entity->id()]);
  }

}
