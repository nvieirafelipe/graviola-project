<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardFormSignin extends BasesfGuardFormSignin
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    $this->widgetSchema['username'] = new sfWidgetFormInput(array(), array('class' => 'text'));
    $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array('type' => 'password'), array('class' => 'text'));
    $this->widgetSchema['remember'] = new sfWidgetFormInputCheckbox(array(), array('class' => 'checkbox'));
  }
}
