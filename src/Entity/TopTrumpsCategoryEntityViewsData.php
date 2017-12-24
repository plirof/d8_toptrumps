<?php

namespace Drupal\d8_toptrumps01\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Top trumps category entity entities.
 */
class TopTrumpsCategoryEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
