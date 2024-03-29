<?php

/**
 * njRoute actions.
 *
 * @package    graviola
 * @subpackage njRoute
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
                 Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class njRouteActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
     $this->nj_routesFormFilter = new NjRouteFrontendFormFilter();

     $this->nj_routes = Doctrine_Core::getTable('NjRoute')->findAll();
     
     $this->default_nj_trip_id = array();
     
     foreach ($this->nj_routes as $index => $nj_route) {
       $nj_route_temp = Doctrine_Core::getTable('NjRoute')->find(array($nj_route->getId()));
       $default_nj_trip = $nj_route_temp->getNjTrips();
       $this->default_nj_trip_id[$index] = $default_nj_trip[0]->getId(); 
     }
     
     $routes_ids = $this->nj_routes->getPrimaryKeys();
     
     $this->nj_notifications = Doctrine_Core::getTable('NjNotification')->getRoutesNotifications($routes_ids);
  }
  
  public function executeFilter(sfWebRequest $request) 
  {
     if ($request->getParameter('transport_mode_id') != "") {
       $this->nj_routes = Doctrine_Core::getTable('NjRoute')->findByNjTransportModeId($request->getParameter('transport_mode_id'));
     }
     else {
       $this->nj_routes = Doctrine_Core::getTable('NjRoute')->findAll();
     }
     $routes_ids = $this->nj_routes->getPrimaryKeys();
     $this->nj_notifications = Doctrine_Core::getTable('NjNotification')->getRoutesNotifications($routes_ids);

     return  $this->renderPartial('filterResults');
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->nj_route = Doctrine_Core::getTable('NjRoute')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->nj_route);

    $route_id = $this->nj_route->getId();
    
    $trip_time = $request->getParameter('trip_id');
    
    $this->nj_notifications = Doctrine_Core::getTable('NjNotification')->findByNjRouteId($route_id);
    
    $this->nj_trips = $this->nj_route->getNjTrips();
    
    $this->stop_time_coords = array();
    
    $this->stop_times = array();
    
    foreach ($this->nj_trips as $nj_trip) {
      if ($nj_trip->getId() == $trip_time) {
        $current_trip = $nj_trip;
      }
    }
    
    foreach ($current_trip->getNjStopTimes() as $index => $stop_time) {
      $this->stop_time_coords[] = $stop_time->getNjStop()->getLatitude() . ';' . $stop_time->getNjStop()->getLongitude() . ';<strong>' . $stop_time->getNjStop()->getDescription().'</strong>';
    }

    #TODO pegar o $this->stop_times e colocar na info window
    
    $this->stop_time_coords = implode('|', $this->stop_time_coords);
    
    $this->polyline_text = $current_trip->getPolyline();
    
    $this->nj_calendars = Doctrine_Core::getTable('NjCalendar')->findAll();
    
    $this->nj_schedules = array();
    foreach($this->nj_calendars as $nj_calendar) 
    {
      $this->nj_schedules[$nj_calendar->getDescription()] = Doctrine_Core::getTable('NjCalendar')->getSchedule($route_id, $nj_calendar->getId());
    }
    
/*    $this->nj_stop_times = new Doctrine_Collection('NjStopTime');
    $this->nj_calendars = new Doctrine_Collection('NjCalendar');
    $this->nj_calendars_trips = array();
    foreach($this->nj_trips as $trip)
    {
          $this->nj_calendars[$trip->getId()] = $trip->getNjCalendar();
          $this->nj_stop_times[$trip->getId()] = $trip->getNjStopTimes();
      if (!$this->nj_calendars_trips[$trip->getNjCalendar()->getDescription()]) {
        $this->nj_calendars_trips = array($trip->getNjCalendar()->getDescription() => array());
      }
      
      array_push($this->nj_calendars_trips[$trip->getNjCalendar()->getDescription()], $trip->getNjStopTimes());
    }
*/
    if($this->getUser()->isAuthenticated()) 
    {
        $user_id = $this->getUser()->getGuardUser()->getId();
        $this->subscriber = Doctrine_Core::getTable('NjNotificationSubscriber')->isSubscriber($user_id, $route_id);
    }
  }

  public function executeSubscribe(sfWebRequest $request) 
  {
     $route_id = $request->getParameter('nj_route_id');
     $user_id = $this->getUser()->getGuardUser()->getId();

     $nj_notification_subscriber = new NjNotificationSubscriber();
     $nj_notification_subscriber->setNjRouteId($route_id);
     $nj_notification_subscriber->setUserId($user_id);
     $nj_notification_subscriber->save();
     
     return $this->renderText("Successfully subscribed");
  }

  public function executeUnsubscribe(sfWebRequest $request) 
  {
     $route_id = $request->getParameter('nj_route_id');
     $user_id = $this->getUser()->getGuardUser()->getId();
     
     $nj_notification_subscriber = Doctrine_Core::getTable('NjNotificationSubscriber')->getNjNotificationSubscriber($user_id, $route_id) ;
     $nj_notification_subscriber->delete();
     
     return $this->renderText("Successfully unsubscribed");
  }
  
  public function executeRouteJson(sfWebRequest $request) {
    /*$routes = array();
;
    $this->route = Doctrine_Core::getTable('NjRoute')->find($request->getParameter('id'));
    
    $poly = explode(';', $this->route->getNjTrips()->getFirst()->getPolyline());
    for($i = 0; $i < count($poly)-1; $i++)
    {
      $coords = explode(',', substr(substr($poly[$i], 1, (strlen($poly[$i])-1)),0,(strlen($poly[$i])-2)));
      $lat = $coords[0];
      $lng = substr($coords[1], 1);

      $routes[$lat] = $lng;
    }
    
    //Get Stops
    $this->stops = Doctrine_Core::getTable('NjStop')->getStopsFromRoute($request->getParameter('id'));
    $markers = array();

    foreach ($this->stops as $stop)
    {
      $markers[] = array('position' => array('lat' => $stop->getLatitude(), 'lng' => $stop->getLongitude()), 'address' => $stop->getDescription());
      //$markers[$stop->getLatitude()] = $stop->getLongitude();
    }
    
    $result = array('route' => $routes, 'markers' => $markers);
    
    $this->result = $result;*/
    $this->route = Doctrine_Core::getTable('NjRoute')->find($request->getParameter('route_id'));
    print_r($this->route->getData());
    exit();
  }
  
  public function symfony_to_js($var) {
    switch (gettype($var)) {
      case 'boolean':
        return $var ? 'true' : 'false'; // Lowercase necessary!
      case 'integer':
      case 'double':
        return $var;
      case 'resource':
      case 'string':
        return '"'. str_replace(array("\r", "\n", "<", ">", "&"),
                                array('\r', '\n', '\x3c', '\x3e', '\x26'),
                                addslashes($var)) .'"';
      case 'array':
        // Arrays in JSON can't be associative. If the array is empty or if it
        // has sequential whole number keys starting with 0, it's not associative
        // so we can go ahead and convert it as an array.
        if (empty ($var) || array_keys($var) === range(0, sizeof($var) - 1)) {
          $output = array();
          foreach ($var as $v) {
            $output[] = $this->symfony_to_js($v);
          }
          return '[ '. implode(', ', $output) .' ]';
        }
        // Otherwise, fall through to convert the array as an object.
      case 'object':
        $output = array();
        foreach ($var as $k => $v) {
          $output[] = $this->symfony_to_js(strval($k)) .': '. $this->symfony_to_js($v);
        }
        return '{ '. implode(', ', $output) .' }';
      default:
        return 'null';
    }
  }
}
