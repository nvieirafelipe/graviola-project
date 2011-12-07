<?php

/**
 * NjPermissionMenuItemRouting form base class.
 *
 * @method NjPermissionMenuItemRouting getObject() Returns the current form's model object
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNjPermissionMenuItemRoutingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nj_menu_item_routing_id' => new sfWidgetFormInputHidden(),
      'sf_guard_permission_id'  => new sfWidgetFormInputHidden(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'nj_menu_item_routing_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('nj_menu_item_routing_id')), 'empty_value' => $this->getObject()->get('nj_menu_item_routing_id'), 'required' => false)),
      'sf_guard_permission_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('sf_guard_permission_id')), 'empty_value' => $this->getObject()->get('sf_guard_permission_id'), 'required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('nj_permission_menu_item_routing[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjPermissionMenuItemRouting';
  }

}
