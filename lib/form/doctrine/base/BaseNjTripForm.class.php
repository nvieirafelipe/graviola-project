<?php

/**
 * NjTrip form base class.
 *
 * @method NjTrip getObject() Returns the current form's model object
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNjTripForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'nj_calendar_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjCalendar'), 'add_empty' => false)),
      'nj_route_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjRoute'), 'add_empty' => false)),
      'nj_vehicle_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjVehicle'), 'add_empty' => false)),
      'direction_id'   => new sfWidgetFormInputCheckbox(),
      'description'    => new sfWidgetFormInputText(),
      'detail'         => new sfWidgetFormTextarea(),
      'polyline'       => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nj_calendar_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjCalendar'))),
      'nj_route_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjRoute'))),
      'nj_vehicle_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjVehicle'))),
      'direction_id'   => new sfValidatorBoolean(),
      'description'    => new sfValidatorString(array('max_length' => 128)),
      'detail'         => new sfValidatorString(array('required' => false)),
      'polyline'       => new sfValidatorString(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('nj_trip[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjTrip';
  }

}
