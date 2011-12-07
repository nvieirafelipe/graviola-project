<?php

/**
 * NjEstimatedArrivalTime filter form base class.
 *
 * @package    graviola
 * @subpackage filter
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNjEstimatedArrivalTimeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nj_trip_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjTrip'), 'add_empty' => true)),
      'nj_stop_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjStop'), 'add_empty' => true)),
      'arrival_time' => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nj_trip_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjTrip'), 'column' => 'id')),
      'nj_stop_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjStop'), 'column' => 'id')),
      'arrival_time' => new sfValidatorPass(array('required' => false)),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('nj_estimated_arrival_time_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjEstimatedArrivalTime';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'nj_trip_id'   => 'ForeignKey',
      'nj_stop_id'   => 'ForeignKey',
      'arrival_time' => 'Text',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
