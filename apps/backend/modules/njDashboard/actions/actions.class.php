<?php

/**
 * njDashboard actions.
 *
 * @package    graviola
 * @subpackage njDashboard
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class njDashboardActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
     $this->nj_notifications = Doctrine_Core::getTable('NjNotification')->findAll();
     
     $this->nj_free_vehicles = Doctrine_Core::getTable('NjVehicle')->getFreeVehicles();
     
     $this->form = new NjTemporaryTripForm();
  }
}
