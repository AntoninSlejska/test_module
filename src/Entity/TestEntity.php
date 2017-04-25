<?php

namespace Drupal\test_module\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Test module entity.
 *
 * The ball entity stores information about a snooker ball.
 *
 * @ConfigEntityType(
 *   id = "test_module",
 *   label = @Translation("Test module"),
 *   module = "test_module",
 *   config_prefix = "test_module",
 *   admin_permission = "administer site configuration",
 *   handlers = {
 *     "storage" = "Drupal\test_module\TestModuleStorage",
 *     "list_builder" = "Drupal\test_module\TestModuleListBuilder",
 *     "form" = {
 *       "default" = "Drupal\test_module\Form\TestModuleForm",
 *       "delete" = "Drupal\test_module\Form\TestModuleDeleteForm"
 *     },
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/test_module/manage/{test_module}",
 *     "delete-form" = "/admin/config/test_module/manage/{test_module}/delete"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "number" = "number"
 *   },
 *   config_export = {
 *     "id" = "id",
 *     "label" = "label",
 *     "number" = "number",
 *     "string" = "string",
 *   }
 * )
 */
class TestEntity extends ConfigEntityBase implements TestEntityInterface {

  /**
   * The test_module machine name.
   *
   * @var string
   */
  protected $id;

  /**
   * The human readable name of this test_module.
   *
   * @var string
   */
  protected $label;

  /**
   * The value of number of this test_module/filter.
   *
   * @var string
   */
  protected $number;

  /**
   * The value of string of this test_module/filter.
   *
   * @var string
   */
  protected $string;

  /**
   * {@inheritdoc}
   */
  public function getNumber() {
    return $this->number;
  }

  /**
   * {@inheritdoc}
   */
  public function getString() {
    return $this->string;
  }

}
