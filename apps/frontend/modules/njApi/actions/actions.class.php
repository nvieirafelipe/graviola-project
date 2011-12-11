<?php

/**
 * api actions.
 *
 * @package    graviola
 * @subpackage api
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class njApiActions extends sfActions
{
  public function executeMaps(sfWebRequest $request) 
  { 
    $this->route = Doctrine_Core::getTable('NjRoute')->find($request->getParameter('route_id'));
    
    $this->trips = $this->route->getNjTrips();
    
    $this->stop_time_coords = array();
    
    $trip_id = $request->getParameter('trip_id');
    
    foreach ($this->trips as $nj_trip) {
      
      if ($nj_trip->getId() == $trip_id) {
        $current_trip = $nj_trip;
      }
    }
    
    if (empty($current_trip)) {
      throw  new sfError404Exception('Trip not found');
    }
    
    
    foreach ($current_trip->getNjStopTimes() as $index => $stop_time) {
      $this->stop_time_coords[] = $stop_time->getNjStop()->getLatitude() . ';' . $stop_time->getNjStop()->getLongitude() . ';<strong>' . $stop_time->getNjStop()->getDescription().'</strong>';
    }
    
    $this->trip_polyline = $current_trip->getPolyline();
    $this->stop_time_coords = implode('|', $this->stop_time_coords);
  }
  
  public function executeTransportList(sfWebRequest $request)
  {
    if(!$this->transports = Doctrine_Core::getTable("njTransportMode")->findAll(DOCTRINE_CORE::HYDRATE_ARRAY)) {
      throw new sfError404Exception('Transports not found.'); 
    }
    
    $this->getResponse()->setContentType('text/javascript; charset=utf-8');
    
    return $this->renderText($this->symfony_to_js($this->transports));
  }

  public function executeLogin(sfWebRequest $request)
  {
    $username = $request->getParameter('username');
    $password = $request->getParameter('password');
    
    // username is ok
    if($user = Doctrine_Core::getTable('sfGuardUser')->retrieveByUsername($username))
    {
      // password is ok?
      if ($user->getIsActive() && $user->checkPassword($password))
        $this->user= $user;
      else
        throw new sfError404Exception('Invalid password.');
    }
    else
      throw new sfError404Exception('Invalid username.');
  }
  
  public function executeRoutesList(sfWebRequest $request) {
    
    $transport_mode_id = $request->getParameter('transport_mode');
    
    if (!empty($transport_mode_id)) {
      $routes = Doctrine_Core::getTable("njRoute")->findBy('nj_transport_mode_id', $transport_mode_id, DOCTRINE_CORE::HYDRATE_ARRAY);
    }
    else {
      $routes = Doctrine_Core::getTable("njRoute")->findAll(DOCTRINE_CORE::HYDRATE_ARRAY);
    }
    
    foreach ($routes as $index => $route) {
      $routes[$index]['trips'] = Doctrine_Core::getTable("njTrip")->findBy('nj_route_id', $route['id'], DOCTRINE_CORE::HYDRATE_ARRAY);
    }
    
    $this->getResponse()->setContentType('text/javascript; charset=utf-8');
    
    return $this->renderText($this->symfony_to_js($routes));
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
