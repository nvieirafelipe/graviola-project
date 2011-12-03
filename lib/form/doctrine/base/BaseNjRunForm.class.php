<?php

/**
 * NjRun form base class.
 *
 * @method NjRun getObject() Returns the current form's model object
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNjRunForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nj_trip_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjTrip'), 'add_empty' => false)),
      'nj_stop_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjStop'), 'add_empty' => true)),
      'step_into'  => new sfWidgetFormInputText(),
      'step_out'   => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nj_trip_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjTrip'))),
      'nj_stop_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjStop'), 'required' => false)),
      'step_into'  => new sfValidatorInteger(array('required' => false)),
      'step_out'   => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('nj_run[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjRun';
  }

}
