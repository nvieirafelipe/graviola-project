<?php

require_once dirname(__FILE__).'/../lib/njTripGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/njTripGeneratorHelper.class.php';

/**
 * njTrip actions.
 *
 * @package    graviola
 * @subpackage njTrip
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class njTripActions extends autoNjTripActions
{
  public function executeAddStopTime(sfWebRequest $request) 
  {
    $number = $request->getParameter('num');
    $trip = Doctrine_Core::getTable('NjTrip')->find($request->getParameter('id'));
    
    $stop = Doctrine_Core::getTable('NjStop')->find($request->getParameter('stop_id'));
    
    $form = new NjTripForm($trip);

    $form->addStopTime($number, $stop);
    
    return $this->renderPartial('newStopTime', array('form' => $form, 'num' => $number));
  }
  
  public function executeAddStop(sfWebRequest $request) 
  {
    
    $stop = Doctrine_Core::getTable('NjStop')->find($request->getParameter('nj_stop_id'));
    $stopArray = $stop->toArray();
    
    $this->getResponse()->setContentType('text/javascript; charset=utf-8');
    
    $stopArray['stopTimeForm'] = json_encode($this->getPartial('newStopStructure', array('form' => new NjStopTimeForm())), TRUE);
    
    return $this->renderText($this->symfony_to_js($stopArray)); 
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
