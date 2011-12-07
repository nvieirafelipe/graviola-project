<?php

/**
 * NjTrip form.
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan AraÃºjo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NjTripForm extends BaseNjTripForm
{
  // An array to store the stop that should be deleted
  protected $scheduledForDeletion = array(); 

  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);

    if ($this->object->exists())  
    {  
       $this->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();  
       $this->validatorSchema['delete'] = new sfValidatorPass();  
    }  
    
    $this->embedRelation('NjStopTimes');
  }
  
  // Add new stop time to the trip
  public function addStopTime($number, $stop = NULL) 
  {
    $stop_time = new NjStopTime();
    $stop_time->setNjTrip($this->getObject());
    if (!empty($stop)) {
      $stop_time->setNjStop($stop);
    }
    $stop_time_form = new NjStopTimeForm($stop_time);
   
    if (isset($this->embeddedForms['new'])) 
    {
      $this->embeddedForms['new']->embedForm($number, $stop_time_form);
      $this->embedForm('new', $this->embeddedForms['new']);
    }
    else 
    {
      $new_stop_times = new BaseForm();

      $new_stop_times->embedForm($number, $stop_time_form);
      $this->embedForm('new', $new_stop_times);
    }
  }

  // Remove stop times that have no description and add stop times that were marked to the $scheduledForDeletion array
  protected function doBind(array $values)
  {
    if (isset($taintedValues['new'])) 
    {
      if (trim($values['new']['description']) === '')
      {
        unset($values['new'], $this['new']);
      }
    }
    
    if (isset($values['NjStopTimes']))
    {
      foreach ($values['NjStopTimes'] as $i => $stopTimeValues)
      {
        if (isset($stopTimeValues['delete']) && $stopTimeValues['id'])
        {
          $this->scheduledForDeletion[$i] = $stopTimeValues['id'];
        }
      }
    }

    parent::doBind($values);
  }

  // Prepare to save the form data
  public function bind(array $taintedValues = null, array $taintedFiles = null) 
  {
    if (isset($taintedValues['new'])) 
    {
      $new_stop_times = new BaseForm();
      foreach($taintedValues['new'] as $key => $new_stop_time){
        $stop_time = new NjStopTime();
        $stop_time->setNjTrip($this->getObject());
        $stop_time_form = new NjStopTimeForm($stop_time);

        $new_stop_times->embedForm($key,$stop_time_form);
      }

      $this->embedForm('new',$new_stop_times);
    }

    parent::bind($taintedValues, $taintedFiles);
  } 
  
  // Remove trips that are in the $scheduledForDeletion array
  protected function doUpdateObject($values)
  {
    if (count($this->scheduledForDeletion))
    {
      foreach ($this->scheduledForDeletion as $index => $id)
      {
        unset($values['NjStopTimes'][$index]);
        unset($this->object['NjStopTimes'][$index]);
        Doctrine::getTable('NjStopTime')->findOneById($id)->delete();
      }
    }

    $this->getObject()->fromArray($values);
  }
  
  // Saves the data
  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if (null === $con)
    {
      $con = $this->getConnection();
    }

    if (null === $forms)
    {
      $forms = $this->embeddedForms;
    }
    
    foreach ($forms as $form)
    {
      if ($form instanceof sfFormObject)
      {
        if (!in_array($form->getObject()->getId(), $this->scheduledForDeletion))
        {
          $form->saveEmbeddedForms($con);
          $form->getObject()->save($con);
        }
      }
      else
      {
        $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
      }
    }
  }
}