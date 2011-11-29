<?php

/**
 * sfGuardUser filter form.
 *
 * @package    graviola
 * @subpackage filter
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan AraÃºjo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrinePluginFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserFormFilter extends PluginsfGuardUserFormFilter
{
  public function configure()
  {
      $this->widgetSchema['created_at']->setOption('template', 'de %from_date%<br />a %to_date%');
      $this->widgetSchema['updated_at']->setOption('template', 'de %from_date%<br />a %to_date%');
  }
}
