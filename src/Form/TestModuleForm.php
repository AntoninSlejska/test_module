<?php

namespace Drupal\test_module\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the test_module entity edit forms.
 */
class TestModuleForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\test_module\Entity\TestEntity $entity */
    $entity = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Filter name'),
      '#default_value' => $entity->label(),
      '#size' => 60,
      '#required' => TRUE,
      '#maxlength' => 100,
      '#description' => $this->t('The name/description of the entity.'),
    );
    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $entity->id(),
      '#required' => TRUE,
      '#disabled' => !$entity->isNew(),
      '#size' => 60,
      '#maxlength' => 100,
      '#machine_name' => array(
        'exists' => ['\Drupal\test_module\Entity\TestEntity', 'load'],
      ),
    );
    $form['number'] = array(
      '#type' => 'select',
      '#title' => $this->t('Number'),
      '#options' => [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
      ],
      '#default_value' => $entity->getNumber(),
      '#required' => TRUE,
      '#description' => $this->t('Number.'),
    );
    $form['string'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Element'),
      '#default_value' => $entity->getString(),
      '#size' => 60,
      '#required' => TRUE,
      '#maxlength' => 100,
      '#description' => $this->t('String'),
    );

    return parent::form($form, $form_state, $entity);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\test_module\Entity\TestEntity $entity */
    $entity = $this->entity;

    // Prevent leading and trailing spaces.
    $entity->set('label', trim($entity->label()));
    $entity->set('number', $form_state->getValue('number'));
    $entity->set('string', $form_state->getValue('string'));
    $status = $entity->save();

    $edit_link = $this->entity->link($this->t('Edit'));
    $action = $status == SAVED_UPDATED ? 'updated' : 'added';

    // Tell the user we've updated their filter.
    drupal_set_message($this->t('test_module Filter %label has been %action.', ['%label' => $entity->label(), '%action' => $action]));
    $this->logger('test_module')->notice('test_module entity %label has been %action.', array('%label' => $entity->label(), 'link' => $edit_link));

    // Redirect back to the list view.
    $form_state->setRedirect('test_module.test_module_list');
  }

  /**
   * {@inheritdoc}
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['submit']['#value'] = ($this->entity->isNew()) ? $this->t('Add Filter') : $this->t('Update Filter');
    return $actions;
  }

}
