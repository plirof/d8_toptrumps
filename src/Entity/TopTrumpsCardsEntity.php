<?php

namespace Drupal\d8_toptrumps01\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Top trumps cards entity entity.
 *
 * @ingroup d8_toptrumps01
 *
 * @ContentEntityType(
 *   id = "top_trumps_cards_entity",
 *   label = @Translation("Top trumps cards entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\d8_toptrumps01\TopTrumpsCardsEntityListBuilder",
 *     "views_data" = "Drupal\d8_toptrumps01\Entity\TopTrumpsCardsEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\d8_toptrumps01\Form\TopTrumpsCardsEntityForm",
 *       "add" = "Drupal\d8_toptrumps01\Form\TopTrumpsCardsEntityForm",
 *       "edit" = "Drupal\d8_toptrumps01\Form\TopTrumpsCardsEntityForm",
 *       "delete" = "Drupal\d8_toptrumps01\Form\TopTrumpsCardsEntityDeleteForm",
 *     },
 *     "access" = "Drupal\d8_toptrumps01\TopTrumpsCardsEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\d8_toptrumps01\TopTrumpsCardsEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "top_trumps_cards_entity",
 *   admin_permission = "administer top trumps cards entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode", 
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/top_trumps_cards_entity/{top_trumps_cards_entity}",
 *     "add-form" = "/admin/structure/top_trumps_cards_entity/add",
 *     "edit-form" = "/admin/structure/top_trumps_cards_entity/{top_trumps_cards_entity}/edit",
 *     "delete-form" = "/admin/structure/top_trumps_cards_entity/{top_trumps_cards_entity}/delete",
 *     "collection" = "/admin/structure/top_trumps_cards_entity",
 *   },
 *   field_ui_base_route = "top_trumps_cards_entity.settings"
 * )
 */
class TopTrumpsCardsEntity extends ContentEntityBase implements TopTrumpsCardsEntityInterface {

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
      ->setDescription(t('The user ID of author of the Top trumps cards entity entity.'))
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

    $fields['category_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('category'))
      ->setDescription(t('The category that this belongs to .'))
      ->setRevisionable(FALSE)
      ->setSetting('target_type', 'top_trumps_category_entity')
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
      ->setDescription(t('The name of the Top trumps cards entity entity.'))
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


    $fields['fields_values'] = BaseFieldDefinition::create('string')
      ->setLabel(t('fields values'))
      ->setDescription(t('The field values of the Top trumps cards entity. Use this form : [21,342,5523,52,666] - RESTexport MUST display it as "fields"'))
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

    $fields['image'] = BaseFieldDefinition::create('string')
      ->setLabel(t('image path'))
      ->setDescription(t('The image of the Top trumps cards entity. '))
      ->setSettings([
        'max_length' => 150,
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
      ->setDescription(t('A boolean indicating whether the Top trumps cards entity is published.'))
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
