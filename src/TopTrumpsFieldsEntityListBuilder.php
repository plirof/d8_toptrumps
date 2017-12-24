<?php

namespace Drupal\d8_toptrumps01;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Top trumps fields entity entities.
 *
 * @ingroup d8_toptrumps01
 */
class TopTrumpsFieldsEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Top trumps fields entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\d8_toptrumps01\Entity\TopTrumpsFieldsEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.top_trumps_fields_entity.edit_form',
      ['top_trumps_fields_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
