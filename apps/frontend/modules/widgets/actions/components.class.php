<?php

/**
 * main actions.
 *
 * @package    graviola
 * @subpackage main
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan AraÃºjo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class widgetsComponents extends sfComponents {
  public function executeMainmenu(sfWebRequest $request) {
    $menu = new Menu($this->getUser(), Menu::FRONTEND_APP);    

    $menu->loadMenu();
    $this->menu = $menu->generateMenu();
  }
}
