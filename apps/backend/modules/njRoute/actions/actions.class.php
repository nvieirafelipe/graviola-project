<?php

require_once dirname(__FILE__).'/../lib/njRouteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/njRouteGeneratorHelper.class.php';

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
class njRouteActions extends autoNjRouteActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->Route = Doctrine::getTable('NjRoute')->find($request->getParameter('id'));

    $this->forward404Unless($this->Route);
    //$this->form = $this->configuration->getForm($this->Route);
    $this->form = new NjRouteForm($this->Route);
  }

  public function executeJson(sfWebRequest $request)
  {
    $routes = array();
    $poly = Doctrine_Core::getTable('NjRoute')->find($request->getParameter('id'))->getPolyline();
    $poly = explode(';', $poly);

    for($i = 0; $i < count($poly)-1; $i++)
    {
      $coords = explode(',', substr(substr($poly[$i], 1, (strlen($poly[$i])-1)),0,(strlen($poly[$i])-2)));
      $lat = $coords[0];
      $lng = substr($coords[1],1);

      $routes[$lat]=$lng;
    }
    
    //Get Stops
    $this->stops = Doctrine_Core::getTable('NjStop')->getStopsFromRoute($request->getParameter('id'));
    $markers = array();

    foreach ($this->stops as $stop)
    {
      $markers[$stop->getLatitude()]=$stop->getLongitude();
    }
    
    $result = array('route' => $routes, 'markers' => $markers);
    
    $this->result = $result;
  }

  public function executeAddTrip(sfWebRequest $request) 
  {
    $number = $request->getParameter('num');
    $route = Doctrine_Core::getTable('NjRoute')->find($request->getParameter('id'));
    $form = new NjRouteForm($route);

    $form->addTrip($number);
    return $this->renderPartial('newTrip',array('form' => $form, 'num' => $number));
  }
}
