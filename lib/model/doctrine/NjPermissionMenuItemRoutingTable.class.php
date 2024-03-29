<?php

/**
 * NjPermissionMenuItemRoutingTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class NjPermissionMenuItemRoutingTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object NjPermissionMenuItemRoutingTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('NjPermissionMenuItemRouting');
    }
    
    public function getMenuItemsByPermission($permission_ids)
    {
      $query = $this->createQuery('n')
                    ->select('n.nj_menu_item_routing_id, n.sf_guard_permission_id, n3.description, n3.routing, n2.description, n2.detail, n2.routing')
                    ->innerJoin('n.NjMenuItemRouting n2')
                    ->innerJoin('n2.NjSectionRouting n3')
                    ->whereIn('n.sf_guard_permission_id', $permission_ids)
                    ->orderBy('n3.menu_order, n2.menu_order');
      return $query->fetchArray();
    }
}