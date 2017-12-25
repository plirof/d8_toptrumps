<?php

namespace Drupal\d8_toptrumps01\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Top trumps category entity entity.
 *
 * @ingroup d8_toptrumps01
 *
 * @ContentEntityType(
 *   id = "top_trumps_category_entity",
 *   label = @Translation("Top trumps category entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\d8_toptrumps01\TopTrumpsCategoryEntityListBuilder",
 *     "views_data" = "Drupal\d8_toptrumps01\Entity\TopTrumpsCategoryEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\d8_toptrumps01\Form\TopTrumpsCategoryEntityForm",
 *       "add" = "Drupal\d8_toptrumps01\Form\TopTrumpsCategoryEntityForm",
 *       "edit" = "Drupal\d8_toptrumps01\Form\TopTrumpsCategoryEntityForm",
 *       "delete" = "Drupal\d8_toptrumps01\Form\TopTrumpsCategoryEntityDeleteForm",
 *     },
 *     "access" = "Drupal\d8_toptrumps01\TopTrumpsCategoryEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\d8_toptrumps01\TopTrumpsCategoryEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "top_trumps_category_entity",
 *   admin_permission = "administer top trumps category entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode", 
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/top_trumps_category_entity/{top_trumps_category_entity}",
 *     "add-form" = "/admin/structure/top_trumps_category_entity/add",
 *     "edit-form" = "/admin/structure/top_trumps_category_entity/{top_trumps_category_entity}/edit",
 *     "delete-form" = "/admin/structure/top_trumps_category_entity/{top_trumps_category_entity}/delete",
 *     "collection" = "/admin/structure/top_trumps_category_entity",
 *   },
 *   field_ui_base_route = "top_trumps_category_entity.settings"
 * )
 */
class TopTrumpsCategoryEntity extends ContentEntityBase implements TopTrumpsCategoryEntityInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Top trumps category entity entity.'))
      ->setRevisionable(FALSE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(FALSE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Top trumps category entity entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Top trumps category entity is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
