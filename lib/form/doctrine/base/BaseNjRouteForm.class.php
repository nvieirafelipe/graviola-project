<?php

/**
 * NjRoute form base class.
 *
 * @method NjRoute getObject() Returns the current form's model object
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNjRouteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'nj_transport_mode_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjTransportMode'), 'add_empty' => false)),
      'number'               => new sfWidgetFormInputText(),
      'name'                 => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormInputText(),
      'detail'               => new sfWidgetFormTextarea(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nj_transport_mode_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjTransportMode'))),
      'number'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'name'                 => new sfValidatorString(array('max_length' => 128)),
      'description'          => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'detail'               => new sfValidatorString(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('nj_route[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjRoute';
  }

}
