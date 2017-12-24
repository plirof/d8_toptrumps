<?php

namespace Drupal\d8_toptrumps01;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Top trumps cards entity entity.
 *
 * @see \Drupal\d8_toptrumps01\Entity\TopTrumpsCardsEntity.
 */
class TopTrumpsCardsEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\d8_toptrumps01\Entity\TopTrumpsCardsEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished top trumps cards entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published top trumps cards entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit top trumps cards entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete top trumps cards entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add top trumps cards entity entities');
  }

}
