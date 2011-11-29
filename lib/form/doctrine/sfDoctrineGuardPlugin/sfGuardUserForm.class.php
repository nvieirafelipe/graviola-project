<?php

/**
 * sfGuardUser form.
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan AraÃºjo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
    //widgets and validators are set in plugins/sfDoctrineGuardPlugin/lib/form/doctrine/sfGuardUserAdminForm
    unset($this['created_at'], 
            $this['updated_at'], 
            $this['password'], 
            $this['salt'], 
            $this['algorithm'], 
            $this['is_active'], 
            $this['is_super_admin'],             
            $this['last_login']);
 }
}