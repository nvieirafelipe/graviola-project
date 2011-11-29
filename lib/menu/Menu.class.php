<?php
/**
 * Generate menus according user group.
 * 
 * @package    graviola
 * @subpackage menu
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan AraÃºjo          <yohanaraujo07@gmail.com>;
  * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class Menu 
{

  const FRONTEND_APP = 'frontend';
  const BACKEND_APP = 'backend';

  protected
    $user = NULL,
    $items = NULL,
    $current_app = NULL;
  public function  __construct($user, $current_app) 
  {
    $this->initialize($user, $current_app);
  }

  public function initialize($user, $current_app) 
  {
    $this->user = $user;
    $this->items = array();
    $this->current_app = $current_app;
  }

  public function loadMenu() 
  {
    $groupsAssociated = $this->user->getGroupNames();

    $groupsAssociated = empty($groupsAssociated) ? array('AnonymousUser') : $groupsAssociated;
    if (!empty ($groupsAssociated))
    {
      $items = array();
      foreach ($groupsAssociated as $groupAssociated) 
      {
        $permissions = sfGuardGroupTable::getInstance()->getPermissionsByGroup($groupAssociated);

        if (!empty($permissions[0]['sfGuardGroupPermission']))
        {
          $permission_ids = array();
          foreach ($permissions[0]['sfGuardGroupPermission'] as $permission)
          {
            $permission_ids[] = $permission['permission_id'];
          }
          $menu_items = NjPermissionMenuItemRoutingTable::getInstance()->getMenuItemsByPermission($permission_ids);
          foreach ($menu_items as $menu_item)
          {
            $item = new stdClass();
            $item->section = $menu_item['NjMenuItemRouting']['NjSectionRouting']['description'];
            $item->section_routing = $menu_item['NjMenuItemRouting']['NjSectionRouting']['routing'];
            $item->text = $menu_item['NjMenuItemRouting']['description'];
            $item->routing = $menu_item['NjMenuItemRouting']['routing'];
            $items[] = $item;
          }
        }
      }
    }
    $this->setItems($items);
  }

  public function setItems($items)
  {
    $this->items = $items;
  }

  public function getItems()
  {
    return $this->items;
  }

  public function setCurrentApp($current_app)
  {
    $this->current_app = $current_app;
  }

  public function getCurrentApp()
  {
    return $this->current_app;
  }

  public function generateMenu() 
  {
    $menu = new ioMenu();
    if ($this->getCurrentApp() == Menu::FRONTEND_APP) 
    {
      $routings = sfYaml::load(sfConfig::get('sf_apps_dir') .'/'. Menu::FRONTEND_APP .'/config/routing.yml');
    }
    else
    {
      $routings = sfYaml::load(sfConfig::get('sf_apps_dir') .'/'. Menu::BACKEND_APP .'/config/routing.yml');
    }

    foreach ($this->getItems() as $item)
    {
      foreach ($routings as $key => $routing)
      {
        if ("@". $key == $item->routing)
        {
          if (!empty($item->section)) 
          {
            //Set class "active" if the item is a link to the current page
            if ($menu->getChild($item->section, false) == null) 
              $menu->addChild($item->section, $item->section_routing)->setLinkOptions(array('class'=>'link'));

            $menu->getChild($item->section)->addChild($item->text, $item->routing)->setLinkOptions(array('class'=>'link large'));
          }
          else 
          {
            //Set class "active" if the item is a link to the current page
            $menu->addChild($item->text, $item->routing)->setLinkOptions(array('class'=>'link'));
          }
        }
      }
      
    }
    return $menu;
  }
}
?>
