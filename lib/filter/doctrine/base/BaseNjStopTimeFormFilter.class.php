<?php

/**
 * NjStopTime filter form base class.
 *
 * @package    graviola
 * @subpackage filter
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNjStopTimeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nj_trip_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjTrip'), 'add_empty' => true)),
      'nj_stop_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjStop'), 'add_empty' => true)),
      'arrival_time'   => new sfWidgetFormFilterInput(),
      'departure_time' => new sfWidgetFormFilterInput(),
      'stop_sequence'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'detail'         => new sfWidgetFormFilterInput(),
      'dist_traveled'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nj_trip_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjTrip'), 'column' => 'id')),
      'nj_stop_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjStop'), 'column' => 'id')),
      'arrival_time'   => new sfValidatorPass(array('required' => false)),
      'departure_time' => new sfValidatorPass(array('required' => false)),
      'stop_sequence'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'    => new sfValidatorPass(array('required' => false)),
      'detail'         => new sfValidatorPass(array('required' => false)),
      'dist_traveled'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('nj_stop_time_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjStopTime';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'nj_trip_id'     => 'ForeignKey',
      'nj_stop_id'     => 'ForeignKey',
      'arrival_time'   => 'Text',
      'departure_time' => 'Text',
      'stop_sequence'  => 'Number',
      'description'    => 'Text',
      'detail'         => 'Text',
      'dist_traveled'  => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
