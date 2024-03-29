<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('NjTripRating', 'doctrine');

/**
 * BaseNjTripRating
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $nj_trip_id
 * @property string $description
 * @property string $detail
 * @property string $picture
 * @property integer $rating
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Doctrine_Collection $NjTrip
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method integer             getNjTripId()    Returns the current record's "nj_trip_id" value
 * @method string              getDescription() Returns the current record's "description" value
 * @method string              getDetail()      Returns the current record's "detail" value
 * @method string              getPicture()     Returns the current record's "picture" value
 * @method integer             getRating()      Returns the current record's "rating" value
 * @method timestamp           getCreatedAt()   Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()   Returns the current record's "updated_at" value
 * @method Doctrine_Collection getNjTrip()      Returns the current record's "NjTrip" collection
 * @method NjTripRating        setId()          Sets the current record's "id" value
 * @method NjTripRating        setNjTripId()    Sets the current record's "nj_trip_id" value
 * @method NjTripRating        setDescription() Sets the current record's "description" value
 * @method NjTripRating        setDetail()      Sets the current record's "detail" value
 * @method NjTripRating        setPicture()     Sets the current record's "picture" value
 * @method NjTripRating        setRating()      Sets the current record's "rating" value
 * @method NjTripRating        setCreatedAt()   Sets the current record's "created_at" value
 * @method NjTripRating        setUpdatedAt()   Sets the current record's "updated_at" value
 * @method NjTripRating        setNjTrip()      Sets the current record's "NjTrip" collection
 * 
 * @package    graviola
 * @subpackage model
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNjTripRating extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('nj_trip_rating');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('nj_trip_id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('description', 'string', 128, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 128,
             ));
        $this->hasColumn('detail', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('picture', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('rating', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('NjTrip', array(
             'local' => 'nj_trip_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}