<?php

/**
 * NjSectionRouting filter form base class.
 *
 * @package    graviola
 * @subpackage filter
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNjSectionRoutingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'menu_order'  => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'detail'      => new sfWidgetFormFilterInput(),
      'routing'     => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'menu_order'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description' => new sfValidatorPass(array('required' => false)),
      'detail'      => new sfValidatorPass(array('required' => false)),
      'routing'     => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('nj_section_routing_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjSectionRouting';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'menu_order'  => 'Number',
      'description' => 'Text',
      'detail'      => 'Text',
      'routing'     => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
