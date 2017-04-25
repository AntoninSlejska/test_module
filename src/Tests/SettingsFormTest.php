<?php

namespace Drupal\test_module\Tests;

use Drupal\simpletest\WebTestBase;
use Drupal\user\Entity\Role;

/**
 * Test the settings form.
 *
 * @group test_module
 */
class SettingsFormTest extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('test_module');

  /**
   * The role anonymous user.
   *
   * @var \Drupal\user\Entity\Role
   */
  private $guest;

  /**
   * Permissions to grant admin user.
   *
   * @var array
   */
  private $adminPermissions;

  /**
   * Permissions to grant guest user.
   *
   * @var array
   */
  private $guestPermissions;

  /**
   * An user with administration permissions.
   *
   * @var \Drupal\user\UserInterface
   */
  private $adminUser;

  /**
   * An user with guest permissions.
   *
   * @var \Drupal\user\UserInterface
   */
  private $guestUser;

  /**
   * Perform any initial set up tasks that run before every test method.
   *
   * Info to administrator permissions:
   * http://drupal.stackexchange.com/q/233416/72107
   */
  public function setUp() {
    parent::setUp();

    $this->guest = Role::load('anonymous');
    $this->guestPermissions = $this->guest->getPermissions();
    $this->guestUser = $this->drupalCreateUser($this->guestPermissions);

    $this->adminPermissions = array_keys(\Drupal::service(
      'user.permissions')->getPermissions()
    );
    $this->adminUser = $this->drupalCreateUser($this->adminPermissions);
  }

  /**
   * Test if the settings form exist and contains the correct values.
   */
  public function testSettingsFormAsAdmin() {
    $this->drupalLogin($this->adminUser);

    $this->drupalGet('admin/config/test_module');
    $this->assertResponse(200);
    $this->assertText(
      'Test module',
      'Correct title is shown.'
    );
  }

}
