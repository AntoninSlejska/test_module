<?php

namespace Drupal\test_module;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\Core\Config\Entity\DraggableListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a class to build a listing of user test_module entities.
 *
 * @see \Drupal\user\Entity\test_module
 */
class TestModuleListBuilder extends DraggableListBuilder {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'test_module_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = t('Label');
    $header['number'] = t('Number');
    $header['string'] = t('String');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $this->getLabel($entity);
    $row['number'] = $entity->getNumber();
    $row['string'] = $entity->getString();
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultOperations(EntityInterface $entity) {
    $operations = parent::getDefaultOperations($entity);

    if ($entity->hasLinkTemplate('edit-form')) {
      $operations['edit'] = array(
        'title' => t('Edit entity'),
        'weight' => 20,
        'url' => $entity->urlInfo('edit-form'),
      );
    }
    return $operations;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    drupal_set_message(t('The entity settings have been updated.'));
  }

}
