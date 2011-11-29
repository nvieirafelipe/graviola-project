<?php

/**
 * NjNotification form base class.
 *
 * @method NjNotification getObject() Returns the current form's model object
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNjNotificationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'nj_notification_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjNotificationType'), 'add_empty' => false)),
      'description'             => new sfWidgetFormInputText(),
      'detail'                  => new sfWidgetFormTextarea(),
      'nj_route_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjRoute'), 'add_empty' => true)),
      'nj_trip_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjTrip'), 'add_empty' => true)),
      'nj_stop_time_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjStopTime'), 'add_empty' => true)),
      'average_speed'           => new sfWidgetFormInputText(),
      'time_delay'              => new sfWidgetFormTime(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
      'sf_guard_users_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nj_notification_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjNotificationType'))),
      'description'             => new sfValidatorString(array('max_length' => 128)),
      'detail'                  => new sfValidatorString(array('required' => false)),
      'nj_route_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjRoute'), 'required' => false)),
      'nj_trip_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjTrip'), 'required' => false)),
      'nj_stop_time_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NjStopTime'), 'required' => false)),
      'average_speed'           => new sfValidatorNumber(),
      'time_delay'              => new sfValidatorTime(array('required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
      'sf_guard_users_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('nj_notification[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjNotification';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['sf_guard_users_list']))
    {
      $this->setDefault('sf_guard_users_list', $this->object->sfGuardUsers->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savesfGuardUsersList($con);

    parent::doSave($con);
  }

  public function savesfGuardUsersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['sf_guard_users_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->sfGuardUsers->getPrimaryKeys();
    $values = $this->getValue('sf_guard_users_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('sfGuardUsers', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('sfGuardUsers', array_values($link));
    }
  }

}
