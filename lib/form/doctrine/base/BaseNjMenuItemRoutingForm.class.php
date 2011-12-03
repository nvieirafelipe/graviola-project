<?php

/**
 * NjMenuItemRouting form base class.
 *
 * @method NjMenuItemRouting getObject() Returns the current form's model object
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNjMenuItemRoutingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'nj_section_routing_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjSectionRouting'), 'add_empty' => true)),
      'menu_order'               => new sfWidgetFormInputText(),
      'description'              => new sfWidgetFormInputText(),
      'detail'                   => new sfWidgetFormTextarea(),
      'routing'                  => new sfWidgetFormInputText(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
      'sf_guard_permission_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nj_section_routing_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjSectionRouting'), 'required' => false)),
      'menu_order'               => new sfValidatorInteger(array('required' => false)),
      'description'              => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'detail'                   => new sfValidatorString(array('required' => false)),
      'routing'                  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
      'sf_guard_permission_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('nj_menu_item_routing[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjMenuItemRouting';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['sf_guard_permission_list']))
    {
      $this->setDefault('sf_guard_permission_list', $this->object->sfGuardPermission->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savesfGuardPermissionList($con);

    parent::doSave($con);
  }

  public function savesfGuardPermissionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['sf_guard_permission_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->sfGuardPermission->getPrimaryKeys();
    $values = $this->getValue('sf_guard_permission_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('sfGuardPermission', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('sfGuardPermission', array_values($link));
    }
  }

}
