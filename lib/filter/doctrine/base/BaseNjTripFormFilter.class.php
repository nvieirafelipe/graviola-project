<?php

/**
 * NjTrip filter form base class.
 *
 * @package    graviola
 * @subpackage filter
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNjTripFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nj_calendar_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjCalendar'), 'add_empty' => true)),
      'nj_route_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjRoute'), 'add_empty' => true)),
      'nj_vehicle_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjVehicle'), 'add_empty' => true)),
      'direction_id'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'description'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'detail'         => new sfWidgetFormFilterInput(),
      'polyline'       => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nj_calendar_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjCalendar'), 'column' => 'id')),
      'nj_route_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjRoute'), 'column' => 'id')),
      'nj_vehicle_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjVehicle'), 'column' => 'id')),
      'direction_id'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'description'    => new sfValidatorPass(array('required' => false)),
      'detail'         => new sfValidatorPass(array('required' => false)),
      'polyline'       => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('nj_trip_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjTrip';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'nj_calendar_id' => 'ForeignKey',
      'nj_route_id'    => 'ForeignKey',
      'nj_vehicle_id'  => 'ForeignKey',
      'direction_id'   => 'Boolean',
      'description'    => 'Text',
      'detail'         => 'Text',
      'polyline'       => 'Text',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
