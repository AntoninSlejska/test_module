<?php

namespace Drupal\test_module\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Interface for test_module.
 */
interface TestEntityInterface extends ConfigEntityInterface {

  /**
   * {@inheritdoc}
   */
  public function getNumber();

  /**
   * {@inheritdoc}
   */
  public function getString();

}
