<?php

/**
 * NjStopTime form base class.
 *
 * @method NjStopTime getObject() Returns the current form's model object
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNjStopTimeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'nj_trip_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjTrip'), 'add_empty' => false)),
      'nj_stop_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjStop'), 'add_empty' => true)),
      'arrival_time'   => new sfWidgetFormTime(),
      'departure_time' => new sfWidgetFormTime(),
      'stop_sequence'  => new sfWidgetFormInputText(),
      'description'    => new sfWidgetFormInputText(),
      'detail'         => new sfWidgetFormTextarea(),
      'dist_traveled'  => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nj_trip_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjTrip'))),
      'nj_stop_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjStop'), 'required' => false)),
      'arrival_time'   => new sfValidatorTime(array('required' => false)),
      'departure_time' => new sfValidatorTime(array('required' => false)),
      'stop_sequence'  => new sfValidatorInteger(),
      'description'    => new sfValidatorString(array('max_length' => 128)),
      'detail'         => new sfValidatorString(array('required' => false)),
      'dist_traveled'  => new sfValidatorNumber(),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('nj_stop_time[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjStopTime';
  }

}
