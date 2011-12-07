<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('NjMenuItemRouting', 'doctrine');

/**
 * BaseNjMenuItemRouting
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $nj_section_routing_id
 * @property integer $menu_order
 * @property string $description
 * @property string $detail
 * @property string $routing
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property NjSectionRouting $NjSectionRouting
 * @property Doctrine_Collection $sfGuardPermission
 * @property Doctrine_Collection $NjPermissionMenuItemRouting
 * 
 * @method integer             getId()                          Returns the current record's "id" value
 * @method integer             getNjSectionRoutingId()          Returns the current record's "nj_section_routing_id" value
 * @method integer             getMenuOrder()                   Returns the current record's "menu_order" value
 * @method string              getDescription()                 Returns the current record's "description" value
 * @method string              getDetail()                      Returns the current record's "detail" value
 * @method string              getRouting()                     Returns the current record's "routing" value
 * @method timestamp           getCreatedAt()                   Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()                   Returns the current record's "updated_at" value
 * @method NjSectionRouting    getNjSectionRouting()            Returns the current record's "NjSectionRouting" value
 * @method Doctrine_Collection getSfGuardPermission()           Returns the current record's "sfGuardPermission" collection
 * @method Doctrine_Collection getNjPermissionMenuItemRouting() Returns the current record's "NjPermissionMenuItemRouting" collection
 * @method NjMenuItemRouting   setId()                          Sets the current record's "id" value
 * @method NjMenuItemRouting   setNjSectionRoutingId()          Sets the current record's "nj_section_routing_id" value
 * @method NjMenuItemRouting   setMenuOrder()                   Sets the current record's "menu_order" value
 * @method NjMenuItemRouting   setDescription()                 Sets the current record's "description" value
 * @method NjMenuItemRouting   setDetail()                      Sets the current record's "detail" value
 * @method NjMenuItemRouting   setRouting()                     Sets the current record's "routing" value
 * @method NjMenuItemRouting   setCreatedAt()                   Sets the current record's "created_at" value
 * @method NjMenuItemRouting   setUpdatedAt()                   Sets the current record's "updated_at" value
 * @method NjMenuItemRouting   setNjSectionRouting()            Sets the current record's "NjSectionRouting" value
 * @method NjMenuItemRouting   setSfGuardPermission()           Sets the current record's "sfGuardPermission" collection
 * @method NjMenuItemRouting   setNjPermissionMenuItemRouting() Sets the current record's "NjPermissionMenuItemRouting" collection
 * 
 * @package    graviola
 * @subpackage model
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNjMenuItemRouting extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('nj_menu_item_routing');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('nj_section_routing_id', 'integer', 8, array(
             'type' => 'integer',
             'unsigned' => true,
             'length' => 8,
             ));
        $this->hasColumn('menu_order', 'integer', 8, array(
             'type' => 'integer',
             'unsigned' => true,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('description', 'string', 128, array(
             'type' => 'string',
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 128,
             ));
        $this->hasColumn('detail', 'string', null, array(
             'type' => 'string',
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('routing', 'string', 128, array(
             'type' => 'string',
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 128,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
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
        $this->hasOne('NjSectionRouting', array(
             'local' => 'nj_section_routing_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasMany('sfGuardPermission', array(
             'refClass' => 'NjPermissionMenuItemRouting',
             'local' => 'nj_menu_item_routing_id',
             'foreign' => 'sf_guard_permission_id'));

        $this->hasMany('NjPermissionMenuItemRouting', array(
             'local' => 'id',
             'foreign' => 'nj_menu_item_routing_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}