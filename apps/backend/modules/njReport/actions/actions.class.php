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
  
  public function executeJson(sfWebRequest $request)
  {
/*
    $from_date = date("Y-m-d");
    $from_date = strtotime(date("Y-m-d", strtotime($from_date)) . " -15 day");
    
    $tripLoads = Doctrine_Core::getTable('NjRun')->tripLoad($from_date);
*/

    $tripLoads = Doctrine_Core::getTable('NjRun')->onlineTripLoad();
    
    if($tripLoads == null) 
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
      foreach($tripLoads as $tripLoad)
      {
          // Vergonha de ter colocado esse abs(), mais agora não é hora de resolver cagada dos outros.
          $result .= '{"c":[
                        {"v":"'.$tripLoad['route'].'","f":null},
                        {"v":'.(double)$tripLoad['trip_load'].',"f":null},
                        {"v":'.abs((double)$tripLoad['return_trip_load']).',"f":null}]},';
      }
      $result = substr($result, 0, -1);
      $result .= ']}';

  /*
       $result = '{"cols": [
                          {"id":"bairro","label":"Bairro","pattern":"","type":"string"},
                          {"id":"media_valor_venal","label":"Valor Médio  Valor Venal (R$)","pattern":"","type":"number"},
                          {"id":"media_valor_venal_corrigido","label":"Valor Médio  Valor Venal Corrigido (R$)","pattern":"","type":"number"},
                          {"id":"media_oferta_imobiliaria","label":"Valor Médio  Oferta Imobiliaria (R$)","pattern":"","type":"number"},
                          {"id":"iv","label":"IV  ","pattern":"","type":"number"},
                          {"id":"iv_fator_valorizacao","label":"IV  Fator Valorizacao ","pattern":"","type":"number"}
                        ],"rows": [
                          {"c":[
                            {"v":"Alphaville","f":null},
                            {"v":984.595115447434,"f":null},
                            {"v":1981.90464197809,"f":null},
                            {"v":10,"f":null},
                            {"v":2.01291333958877,"f":null},
                            {"v":10,"f":null}]}]}';
  */    

      $this->getResponse()->setContentType('application/json');
      return $this->renderText(json_encode($result));
    }
  }
}
