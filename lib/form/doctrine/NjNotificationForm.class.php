<?php

/**
 * NjNotification form.
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NjNotificationForm extends BaseNjNotificationForm
{
  public function configure()
  {
     unset($this['created_at'], $this['updated_at'], $this['sf_guard_users_list']);

     $this->setWidget('nj_route_id', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjRoute'), 'add_empty' => true, 'add_empty' => true)));

     $this->setWidget('nj_trip_id', new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('NjTrip'), 'depends' => $this->getRelatedModelName('NjRoute'), 'add_empty' => true)));

     $this->setWidget('nj_stop_time_id', new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('NjStopTime'), 'depends' => $this->getRelatedModelName('NjTrip'), 'add_empty' => true)));
  }
}
