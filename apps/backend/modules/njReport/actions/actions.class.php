<?php

/**
 * njReport actions.
 *
 * @package    graviola
 * @subpackage njReport
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class njReportActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }
  
  public function executeRouteJson(sfWebRequest $request)
  {
    $routeLoads = Doctrine_Core::getTable('NjRun')->onlineRouteLoad();
    
    if($routeLoads == null) 
    {
      $this->getResponse()->setStatusCode(404, 'No data found');
      $this->getResponse()->setContentType('application/json');
      return $this->renderText('There is no data for this report.');
    }
    else
    {
      $result = '{"cols": [
                     {"id":"route","label":"Route","pattern":"","type":"string"},
                     {"id":"trip_load","label":"Trip Load","pattern":"","type":"number"},
                     {"id":"return_trip_load","label":"Return Trip Load","pattern":"","type":"number"}
                  ],"rows": [';
      foreach($routeLoads as $routeLoad)
      {
          // Vergonha de ter colocado esse abs(), mais agora não é hora de resolver cagada dos outros.
          $result .= '{"c":[
                        {"v":"'.$routeLoad['route'].'","f":null},
                        {"v":'.(double)$routeLoad['trip_load'].',"f":null},
                        {"v":'.abs((double)$routeLoad['return_trip_load']).',"f":null}]},';
      }
      $result = substr($result, 0, -1);
      $result .= ']}';

      $this->getResponse()->setContentType('application/json');
      return $this->renderText(json_encode($result));
    }
  }
 
  public function executeTripJson(sfWebRequest $request)
  {
    $tripLoads = Doctrine_Core::getTable('NjRun')->onlineTripLoad(6);
    
    if($tripLoads == null) 
    {
      $this->getResponse()->setStatusCode(404, 'No data found');
      $this->getResponse()->setContentType('application/json');
      return $this->renderText('There is no data for this report.');
    }
    else
    {
      $result = '{"cols": [
                     {"id":"trip","label":"Trip","pattern":"","type":"string"},
                     {"id":"trip_load","label":"Trip Load","pattern":"","type":"number"},
                     {"id":"return_trip_load","label":"Return Trip Load","pattern":"","type":"number"}
                  ],"rows": [';
      foreach($tripLoads as $tripLoad)
      {
          // Vergonha de ter colocado esse abs(), mais agora não é hora de resolver cagada dos outros.
          $result .= '{"c":[
                        {"v":"'.$tripLoad['trip'].'","f":null},
                        {"v":'.(double)$tripLoad['trip_load'].',"f":null},
                        {"v":'.abs((double)$tripLoad['return_trip_load']).',"f":null}]},';
      }
      $result = substr($result, 0, -1);
      $result .= ']}';

      $this->getResponse()->setContentType('application/json');
      return $this->renderText(json_encode($result));
    }
  }
}
