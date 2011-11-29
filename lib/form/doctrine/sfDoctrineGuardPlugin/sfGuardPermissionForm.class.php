<?php

/**
 * sfGuardPermission form.
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan AraÃºjo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardPermissionForm extends PluginsfGuardPermissionForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);
    
    $this->widgetSchema['groups_list']->setLabel('Groups');
    $this->widgetSchema['users_list']->setLabel('Users');

    $this->setValidator('name', new sfValidatorString(array('max_length' => 255, 'required' => true)));
    $this->setValidator('description', new sfValidatorString(array('max_length' => 1000, 'required' => true)));
  }
}
