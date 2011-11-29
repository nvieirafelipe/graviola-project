<?php

  class NjTemporaryTripForm extends sfForm
{
  public function configure()
  {
     $this->setWidget('nj_route_id', new sfWidgetFormDoctrineChoice(array('model' => 'NjRoute', 'add_empty' => true, 'add_empty' => true)));
     $this->setValidator('nj_route_id', new sfValidatorDoctrineChoice(array('model' => 'NjRoute')));
  }
}
