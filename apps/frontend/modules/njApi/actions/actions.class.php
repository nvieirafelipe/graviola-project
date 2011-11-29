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
    
  }
  
  public function executeTransportFilter(sfWebRequest $request)
  {
    if(!$this->vehicleTypes = Doctrine_Core::getTable("njVehicleType")->findAll(DOCTRINE_CORE::HYDRATE_ARRAY))
      throw new sfError404Exception('Vehicle types not found.');
              
    if(!$this->routes = Doctrine_Core::getTable("njRoute")->findAll(DOCTRINE_CORE::HYDRATE_ARRAY))
      throw new sfError404Exception('Routes not found.');
    
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
}
