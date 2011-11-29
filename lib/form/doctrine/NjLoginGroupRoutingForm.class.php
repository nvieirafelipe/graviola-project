<?php

/**
 * NjLoginGroupRouting form.
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan AraÃºjo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NjLoginGroupRoutingForm extends BaseNjLoginGroupRoutingForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);

    $this->setValidator('sf_guard_group_id', new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardGroup'), 'required' => true)));
    $this->setValidator('routing', new sfValidatorString(array('max_length' => 128, 'required' => true)));
  }
}
