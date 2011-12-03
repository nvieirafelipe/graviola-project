<?php

/**
 * NjMenuItemRouting filter form base class.
 *
 * @package    graviola
 * @subpackage filter
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNjMenuItemRoutingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nj_section_routing_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NjSectionRouting'), 'add_empty' => true)),
      'menu_order'               => new sfWidgetFormFilterInput(),
      'description'              => new sfWidgetFormFilterInput(),
      'detail'                   => new sfWidgetFormFilterInput(),
      'routing'                  => new sfWidgetFormFilterInput(),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'sf_guard_permission_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
    ));

    $this->setValidators(array(
      'nj_section_routing_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NjSectionRouting'), 'column' => 'id')),
      'menu_order'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'              => new sfValidatorPass(array('required' => false)),
      'detail'                   => new sfValidatorPass(array('required' => false)),
      'routing'                  => new sfValidatorPass(array('required' => false)),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'sf_guard_permission_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('nj_menu_item_routing_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addSfGuardPermissionListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.NjPermissionMenuItemRouting NjPermissionMenuItemRouting')
      ->andWhereIn('NjPermissionMenuItemRouting.sf_guard_permission_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'NjMenuItemRouting';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'nj_section_routing_id'    => 'ForeignKey',
      'menu_order'               => 'Number',
      'description'              => 'Text',
      'detail'                   => 'Text',
      'routing'                  => 'Text',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'sf_guard_permission_list' => 'ManyKey',
    );
  }
}
