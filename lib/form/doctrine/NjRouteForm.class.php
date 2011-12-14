<?php

/**
 * NjRoute form.
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan AraÃºjo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NjRouteForm extends BaseNjRouteForm
{
  // An array to store the trips that should be deleted
  protected $scheduledForDeletion = array(); 
  
  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);

    $this->setWidget('number', new sfWidgetFormInputText());

    $this->setValidator('number', new sfValidatorNumber(array('required' => true)));
    $this->setValidator('name', new sfValidatorString(array('max_length' => 128, 'required' => true)));
    $this->setValidator('description', new sfValidatorString(array('max_length' => 128, 'required' => true)));

//    $this->embedRelation('NjTrips');
  }
  
  /* Add new trip to the route
  public function addTrip($number) 
  {
    $trip = new NjTrip();
    $trip->setNjRoute($this->getObject());
    $trip_form = new NjTripForm($trip);
   
    if(isset($this->embeddedForms['new'])) 
    {
      $this->embeddedForms['new']->embedForm($number, $trip_form);
      $this->embedForm('new', $this->embeddedForms['new']);
    }
    else 
    {
      $new_trips = new BaseForm();

      $new_trips->embedForm($number, $trip_form);
      $this->embedForm('new', $new_trips);
    }
  }

  // Remove trips that have no description and add trips that were marked to the $scheduledForDeletion array
  protected function doBind(array $values)
    {
    if (isset($taintedValues['new'])) 
    {
      if (trim($values['new']['description']) === '')
      {
        unset($values['new'], $this['new']);
      }
    }
    
    if (isset($values['NjTrips']))
    {
      foreach ($values['NjTrips'] as $i => $tripValues)
      {
        if (isset($tripValues['delete']) && $tripValues['id'])
        {
          $this->scheduledForDeletion[$i] = $tripValues['id'];
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
      $new_trips = new BaseForm();
      foreach($taintedValues['new'] as $key => $new_trip){
        $trip = new NjTrip();
        $trip->setNjRoute($this->getObject());
        $trip_form = new NjTripForm($trip);

        $new_trips->embedForm($key,$trip_form);
      }

      $this->embedForm('new',$new_trips);
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
        unset($values['NjTrips'][$index]);
        unset($this->object['NjTrips'][$index]);
        Doctrine::getTable('NjTrip')->findOneById($id)->delete();
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
   */
}