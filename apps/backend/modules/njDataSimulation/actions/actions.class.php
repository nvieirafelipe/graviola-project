<?php

/**
 * njDataSimulation actions.
 *
 * @package    graviola
 * @subpackage njDataSimulation
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class njDataSimulationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    // Create a form so the user can enter a date range to generate simulated data
    $this->form = new sfForm();

    $this->form->setWidget('periodo', new sfWidgetFormDateRange(array('from_date' => new sfWidgetFormJQueryDate(), 'to_date'   => new sfWidgetFormJQueryDate(), 'template' => 'From %from_date% to %to_date%')));
    $this->form->setValidator('periodo', new sfValidatorDateRange(array('from_date' => new sfValidatorDate(), 'to_date'   => new sfValidatorDate())));

  }
  
 /**
  * Executes new action
  *
  * @param sfRequest $request A request object
  */
  public function executeNew(sfWebRequest $request) 
  {
    set_time_limit(0);
    // Retrieves the date range the user filled in the index action
    $periodo = $request->getParameter('periodo');
    $start_date = date ('Y-m-d', strtotime($periodo['from']['year'].'-'.$periodo['from']['month'].'-'.$periodo['from']['day']));
    $end_date = date ('Y-m-d', strtotime($periodo['to']['year'].'-'.$periodo['to']['month'].'-'.($periodo['to']['day'])));
    $check_date = $start_date;
    
    // Counters to store runs registered, and runs that were deleted
    $this->deleted_runs_count = 0;
    $this->runs_count = 0;

    // Deletes all records of runs within the data range entered by the user
    $this->deleted_runs_count = Doctrine::getTable('NjRun')
      ->createQuery()
      ->delete()
      ->where('created_at >= ?', $start_date)
      ->andWhere('created_at <= ?', $end_date)
      ->execute();
    
    // Do the loop to enter runs for each day
    do 
    {
      // Discover the day of the week
      $day_of_week = strtolower(date('l', strtotime($check_date)));
      
      // Retrieves the trips that are active on a specific day of the week
      $q = Doctrine_Core::getTable('NjTrip')
        ->createQuery('t')
        ->innerJoin('t.NjCalendar c')
        ->where('c.'.$day_of_week.' = true');
 
      $trips = $q->execute();
      
      foreach($trips as $trip) 
      {
        $current_amount = 0;
        
        // Retrieves the stop times for each trip already sorted by stop sequence
        $stop_times = $trip->getNjStopTimes();
        foreach($stop_times as $stop_time) 
        {
          /* Check if is not the last stop time
           * If is the last stop time the current number of passengers on the trip must be reset 
           * and the number of passengers entering the vehicle must be zero
           */
          if($stop_time != $stop_times->getLast()) 
          {
            $step_out = -rand(0 , $current_amount);
            $step_into = rand(0, (50 - $current_amount));
          }
          else
          {
            $step_out = -$current_amount;
            $step_into = 0;
          }
          
          /* Generate a number within the range of -30 to 30 and adds this value to the departure time of th stop time 
           * To simulate the time that the run is being recorded. 
           */
          $date_time = date('Y-m-d H:i:s', strtotime(rand(-30,30).' minutes', strtotime($check_date.' '.$stop_time->getDepartureTime())));

          // Inserts run in the database
          $nj_run = new NjRun();
          
          $nj_run->setNjTripId($trip->getId());
          $nj_run->setNjStopId($stop_time->getNjStopId());
          $nj_run->setStepInto($step_into);
          $nj_run->setStepOut($step_out);
          $nj_run->setCreatedAt($date_time);
          $nj_run->setUpdatedAt($date_time);
          
          $nj_run->save();
          $this->runs_count += 1;
          
          
          // Increases the current number of passengers on the trip
          $current_amount += ($step_into + $step_out);
        }
      }

      // Increment the check_date
      $check_date = date ('Y-m-d', strtotime('+1 day', strtotime($check_date)));
    } while($check_date != $end_date);
  } 

}
