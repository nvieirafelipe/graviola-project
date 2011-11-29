<?php

/**
 * njRoute actions.
 *
 * @package    graviola
 * @subpackage njRoute
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan AraÃºjo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class njRouteActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request) {
     $this->buses = array('' => 'Select a tranport for live tracking');
  }
  
  /**
   * Based on a given route id return its positions(latitude and longitude) and markers(latitude and longitude) 
   * @param sfWebRequest $request 
   */
  public function executeRoute(sfWebRequest $request) {
    $routes = array();
    $this->positions = Doctrine_Core::getTable('NjRoute')->find($request->getParameter('id'));
    
    $poly = explode(';', $this->positions->getPolyline());

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
    
    $this->result = $result;
  }
  
  public function executeTransportsFromRoute(sfWebRequest $request) {
    
    $transports = NjRouteTable::getInstance()->loadTransportsFromRoute($request->getParameter('route_id'));
    $options = array('' => 'Select a tranport for live tracking');
    foreach ($transports as $transport) {
      $options[$transport['id']] = $transport['nj_number'] .' - '. $transport['nj_vehicle_type'];
    }
    
    $this->buses = $options;
  }
  
  public function executeGetTransportCurrentPosition(sfWebRequest $request) {
    //TODO This is for tests only should be replace by correct trasnport position.
    $routes = array();
    $this->positions = Doctrine_Core::getTable('NjRoute')->find($request->getParameter('route_id'));
    
    $poly = explode(';', $this->positions->getPolyline());

    for($i = 0; $i < count($poly)-1; $i++)
    {
      $coords = explode(',', substr(substr($poly[$i], 1, (strlen($poly[$i])-1)),0,(strlen($poly[$i])-2)));
      $lat = $coords[0];
      $lng = substr($coords[1], 1);

      $routes[] = array('lat' => $lat, 'lng' => $lng);
    }
    
    $this->result = $routes[$request->getParameter('index_array')];
  }
  
}
