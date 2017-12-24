<?php

/**
 * @file
 * Contains top_trumps_category_entity.page.inc.
 *
 * Page callback for Top trumps category entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Top trumps category entity templates.
 *
 * Default template: top_trumps_category_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_top_trumps_category_entity(array &$variables) {
  // Fetch TopTrumpsCategoryEntity Entity Object.
  $top_trumps_category_entity = $variables['elements']['#top_trumps_category_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
