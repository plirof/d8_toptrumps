<?php

namespace Drupal\d8_toptrumps01\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Top trumps fields entity entities.
 *
 * @ingroup d8_toptrumps01
 */
interface TopTrumpsFieldsEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Top trumps fields entity name.
   *
   * @return string
   *   Name of the Top trumps fields entity.
   */
  public function getName();

  /**
   * Sets the Top trumps fields entity name.
   *
   * @param string $name
   *   The Top trumps fields entity name.
   *
   * @return \Drupal\d8_toptrumps01\Entity\TopTrumpsFieldsEntityInterface
   *   The called Top trumps fields entity entity.
   */
  public function setName($name);

  /**
   * Gets the Top trumps fields entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Top trumps fields entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Top trumps fields entity creation timestamp.
   *
   * @param int $timestamp
   *   The Top trumps fields entity creation timestamp.
   *
   * @return \Drupal\d8_toptrumps01\Entity\TopTrumpsFieldsEntityInterface
   *   The called Top trumps fields entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Top trumps fields entity published status indicator.
   *
   * Unpublished Top trumps fields entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Top trumps fields entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Top trumps fields entity.
   *
   * @param bool $published
   *   TRUE to set this Top trumps fields entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\d8_toptrumps01\Entity\TopTrumpsFieldsEntityInterface
   *   The called Top trumps fields entity entity.
   */
  public function setPublished($published);

}
