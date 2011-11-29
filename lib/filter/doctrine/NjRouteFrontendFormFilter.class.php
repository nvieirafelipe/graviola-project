<?php

/**
 * NjRoute filter form.
 *
 * @package    graviola
 * @subpackage filter
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan AraÃºjo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NjRouteFrontendFormFilter extends BaseNjRouteFormFilter
{
  public function configure()
  {
      unset($this['created_at'], $this['updated_at'], $this['number'], $this['name'], $this['description'], $this['detail']);
      
      $this->setWidget('nj_transport_mode_id', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjTransportMode'), 'add_empty' => '-- Select an transport mode --')));
  }
}