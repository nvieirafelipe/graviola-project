<?php

/**
 * NjNotification module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage NjNotification
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BaseNjNotificationGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getCredentials($action)
  {
    if (0 === strpos($action, '_'))
    {
      $action = substr($action, 1);
    }

    return isset($this->configuration['credentials'][$action]) ? $this->configuration['credentials'][$action] : array();
  }

  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
		//  added show view
	  // return array(  '_delete' => NULL,  '_list' => NULL,  '_show' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  
    return array();
  }

  public function getListObjectActions()
  {
		// =============== Added show view
	  return array(  '_show' => NULL,  '_edit' => NULL,  '_delete' => NULL,);
  
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%=id%% - %%njNotificationType%% - %%njTrip%% - %%njStopTime%% - %%created_at%% - %%updated_at%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Notification List';
  }

  public function getEditTitle()
  {
    return 'Edit NjNotification';
  }

  public function getNewTitle()
  {
    return 'New NjNotification';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => '=id',  1 => 'njNotificationType',  2 => 'njTrip',  3 => 'njStopTime',  4 => 'created_at',  5 => 'updated_at',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'nj_notification_type_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'description' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'detail' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'nj_route_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'nj_trip_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'nj_stop_time_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'average_speed' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'time_delay' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Time',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'sf_guard_users_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'nj_notification_type_id' => array(),
      'description' => array(),
      'detail' => array(),
      'nj_route_id' => array(),
      'nj_trip_id' => array(),
      'nj_stop_time_id' => array(),
      'average_speed' => array(),
      'time_delay' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'sf_guard_users_list' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'nj_notification_type_id' => array(),
      'description' => array(),
      'detail' => array(),
      'nj_route_id' => array(),
      'nj_trip_id' => array(),
      'nj_stop_time_id' => array(),
      'average_speed' => array(),
      'time_delay' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'sf_guard_users_list' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'nj_notification_type_id' => array(),
      'description' => array(),
      'detail' => array(),
      'nj_route_id' => array(),
      'nj_trip_id' => array(),
      'nj_stop_time_id' => array(),
      'average_speed' => array(),
      'time_delay' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'sf_guard_users_list' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'nj_notification_type_id' => array(),
      'description' => array(),
      'detail' => array(),
      'nj_route_id' => array(),
      'nj_trip_id' => array(),
      'nj_stop_time_id' => array(),
      'average_speed' => array(),
      'time_delay' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'sf_guard_users_list' => array(),
    );
  }

  public function getFieldsShow()
  {
    return array(
      'id' => array(),
      'nj_notification_type_id' => array(),
      'description' => array(),
      'detail' => array(),
      'nj_route_id' => array(),
      'nj_trip_id' => array(),
      'nj_stop_time_id' => array(),
      'average_speed' => array(),
      'time_delay' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'sf_guard_users_list' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'nj_notification_type_id' => array(),
      'description' => array(),
      'detail' => array(),
      'nj_route_id' => array(),
      'nj_trip_id' => array(),
      'nj_stop_time_id' => array(),
      'average_speed' => array(),
      'time_delay' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'sf_guard_users_list' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'NjNotificationForm';
  }

  public function getFormOptions()
  {
    return array();
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'NjNotificationFormFilter';
  }

	  protected function getConfig()
  {
    $configuration = parent::getConfig();
    $configuration['show'] = $this->getFieldsShow();
    return $configuration;
  }

  protected function compile()
  {
    parent::compile();
    
    $config = $this->getConfig();
    
    // add configuration for the show view 
    $this->configuration['show'] = array( 'fields'         => array(),
                                          'title'          => $this->getShowTitle(),
                                          'actions'        => $this->getShowActions(),
                                          'display'        => $this->getShowDisplay(),
                                        ) ;

    foreach (array('show') as $context)
    {
      foreach ($this->configuration[$context]['actions'] as $action => $parameters)
      {
        $this->configuration[$context]['actions'][$action] = $this->fixActionParameters($action, $parameters);
      }
    }


  }

  public function getShowActions()
  {
    return array(  '_list' => NULL,  '_edit' => NULL, '_delete' => NULL);
  }

  
  public function getShowTitle()
  {
    return 'View NjNotification';
  }

  public function getShowDisplay()
  {
      return array(  0 => 'id',  1 => 'nj_notification_type_id',  2 => 'description',  3 => 'detail',  4 => 'nj_route_id',  5 => 'nj_trip_id',  6 => 'nj_stop_time_id',  7 => 'average_speed',  8 => 'time_delay',  9 => 'created_at',  10 => 'updated_at',);
  }

  public function getFilterForm($filters)
  {
    $class = $this->getFilterFormClass();

    return new $class($filters, $this->getFilterFormOptions());
  }

  public function getFilterFormOptions()
  {
    return array();
  }

  public function getFilterDefaults()
  {
    return array();
  }

  public function getPager($model)
  {
    $class = $this->getPagerClass();

    return new $class($model, $this->getPagerMaxPerPage());
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }

  public function getConnection()
  {
    return null;
  }
}
