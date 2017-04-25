<?php

namespace Drupal\test_module\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a deletion confirmation form for test_module entity.
 */
class TestModuleDeleteForm extends EntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete the entity %name?', array('%name' => $this->entity->label()));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('test_module.test_module_list');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();
    $this->logger('sample_config_entity')->notice('Entity %name has been deleted.', array('%name' => $this->entity->label()));
    drupal_set_message($this->t('Entity %name has been deleted.', array('%name' => $this->entity->label())));
    $form_state->setRedirectUrl($this->getCancelUrl());
  }

}
