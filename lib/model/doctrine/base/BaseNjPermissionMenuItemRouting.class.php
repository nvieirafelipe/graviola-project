<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('NjPermissionMenuItemRouting', 'doctrine');

/**
 * BaseNjPermissionMenuItemRouting
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $nj_menu_item_routing_id
 * @property integer $sf_guard_permission_id
 * @property NjMenuItemRouting $NjMenuItemRouting
 * @property sfGuardPermission $sfGuardPermission
 * 
 * @method integer                     getNjMenuItemRoutingId()     Returns the current record's "nj_menu_item_routing_id" value
 * @method integer                     getSfGuardPermissionId()     Returns the current record's "sf_guard_permission_id" value
 * @method NjMenuItemRouting           getNjMenuItemRouting()       Returns the current record's "NjMenuItemRouting" value
 * @method sfGuardPermission           getSfGuardPermission()       Returns the current record's "sfGuardPermission" value
 * @method NjPermissionMenuItemRouting setNjMenuItemRoutingId()     Sets the current record's "nj_menu_item_routing_id" value
 * @method NjPermissionMenuItemRouting setSfGuardPermissionId()     Sets the current record's "sf_guard_permission_id" value
 * @method NjPermissionMenuItemRouting setNjMenuItemRouting()       Sets the current record's "NjMenuItemRouting" value
 * @method NjPermissionMenuItemRouting setSfGuardPermission()       Sets the current record's "sfGuardPermission" value
 * 
 * @package    graviola
 * @subpackage model
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNjPermissionMenuItemRouting extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('nj_permission_menu_item_routing');
        $this->hasColumn('nj_menu_item_routing_id', 'integer', 8, array(
             'type' => 'integer',
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('sf_guard_permission_id', 'integer', 8, array(
             'type' => 'integer',
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('NjMenuItemRouting', array(
             'local' => 'nj_menu_item_routing_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('sfGuardPermission', array(
             'local' => 'sf_guard_permission_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}