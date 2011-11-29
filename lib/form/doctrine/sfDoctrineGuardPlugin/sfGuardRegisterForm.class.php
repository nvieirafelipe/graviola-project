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
class sfGuardRegisterForm extends PluginsfGuardRegisterForm
{
  public function configure()
  {
     $this->widgetSchema['first_name'] = new sfWidgetFormInput(array(), array('class' => 'text'));
     $this->widgetSchema['last_name'] = new sfWidgetFormInput(array(), array('class' => 'text'));
     $this->widgetSchema['email_address'] = new sfWidgetFormInput(array(), array('class' => 'text'));
     $this->widgetSchema['username'] = new sfWidgetFormInput(array(), array('class' => 'text'));
     $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(),array('class' => 'text'));
     $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword(array(),array('class' => 'text'));


     $this->setValidator('first_name', new sfValidatorString(array('max_length' => 255, 'required' => true)));
     $this->setValidator('email_address', new sfValidatorEmail(array('required' => true)));
  }
}
