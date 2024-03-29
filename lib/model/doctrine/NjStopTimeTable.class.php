<?php

/**
 * NjStopTimeTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class NjStopTimeTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object NjStopTimeTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('NjStopTime');
    }
        
    /**
     * Returns an NjStopTime of a given NjTrip and NjStop
     * 
     * @return object NjStopTimeTable
     */
    public function getNjStopTime($trip_id, $stop_id)
    {
        return $this->createQuery('stopt')
            ->where('stopt.nj_trip_id = ?', $trip_id)
            ->andWhere('stopt.nj_stop_id = ?', $stop_id)
            ->orderBy('stopt.stop_sequence')
            ->fetchOne();
    }

    /**
     * Returns next NjStopTimes of a NjTrip
     * 
     * @return object NjStopTimeTable
     */
    public function getNextNjStopTimes($trip_id, $stop_sequence)
    {
        return $this->createQuery('stopt')
            ->where('stopt.nj_trip_id = ?', $trip_id)
            ->andWhere('stopt.stop_sequence > ?', $stop_sequence)
            ->execute();
    }

    /**
     * Returns the first NjStopTimes of a NjTrip
     * 
     * @return object NjStopTimeTable
     */
    public function getFirstNjStopTime($trip_id)
    {
        return $this->createQuery('stopt')
            ->select('departure_time AS departure_time')
            ->where('stopt.nj_trip_id = ?', $trip_id)
            ->andWhere('stopt.stop_sequence = 0')
            ->fetchArray();
    }

}