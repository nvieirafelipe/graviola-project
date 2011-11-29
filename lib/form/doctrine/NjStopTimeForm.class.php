<?php

/**
 * NjStopTime form.
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NjStopTimeForm extends BaseNjStopTimeForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['nj_trip_id']);
    //if ($this->object->exists())  
   //{
       $this->widgetSchema['nj_stop_id'] = new sfWidgetFormInputText(array(), array('value' => $this->getObject()->getNjStop()->getId ()));
       $this->validatorSchema['nj_stop_id'] = new sfValidatorString();

       $this->widgetSchema['nj_stop_latitude'] = new sfWidgetFormInputText(array(), array('value' => $this->getObject()->getNjStop()->getLatitude()));
       $this->validatorSchema['nj_stop_latitude'] = new sfValidatorString();
                      
       $this->widgetSchema['nj_stop_longitude'] = new sfWidgetFormInputText(array(), array('value' => $this->getObject()->getNjStop()->getLongitude()));  
       $this->validatorSchema['nj_stop_longitude'] = new sfValidatorString();        

       $this->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();  
       $this->validatorSchema['delete'] = new sfValidatorPass();
    //}  

  }
}
