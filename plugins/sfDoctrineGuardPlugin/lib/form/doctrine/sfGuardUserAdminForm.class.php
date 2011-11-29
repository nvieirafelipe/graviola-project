<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);

    $this->validatorSchema['first_name']->setOption('required', true);
    $this->validatorSchema['email_address'] = new sfValidatorEmail();
    $this->validatorSchema['email_address']->setOption('required', true);
  }
}
