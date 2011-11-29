<?php

/**
 * NjNotification filter form base class.
 *
 * @package    graviola
 * @subpackage filter
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNjNotificationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nj_notification_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjNotificationType'), 'add_empty' => true)),
      'description'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'detail'                  => new sfWidgetFormFilterInput(),
      'nj_route_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjRoute'), 'add_empty' => true)),
      'nj_trip_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjTrip'), 'add_empty' => true)),
      'nj_stop_time_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjStopTime'), 'add_empty' => true)),
      'average_speed'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'time_delay'              => new sfWidgetFormFilterInput(),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'sf_guard_users_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'nj_notification_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjNotificationType'), 'column' => 'id')),
      'description'             => new sfValidatorPass(array('required' => false)),
      'detail'                  => new sfValidatorPass(array('required' => false)),
      'nj_route_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjRoute'), 'column' => 'id')),
      'nj_trip_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjTrip'), 'column' => 'id')),
      'nj_stop_time_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjStopTime'), 'column' => 'id')),
      'average_speed'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'time_delay'              => new sfValidatorPass(array('required' => false)),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'sf_guard_users_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('nj_notification_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addSfGuardUsersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.NjNotificationSubscriber NjNotificationSubscriber')
      ->andWhereIn('NjNotificationSubscriber.user_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'NjNotification';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'nj_notification_type_id' => 'ForeignKey',
      'description'             => 'Text',
      'detail'                  => 'Text',
      'nj_route_id'             => 'ForeignKey',
      'nj_trip_id'              => 'ForeignKey',
      'nj_stop_time_id'         => 'ForeignKey',
      'average_speed'           => 'Number',
      'time_delay'              => 'Text',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
      'sf_guard_users_list'     => 'ManyKey',
    );
  }
}
