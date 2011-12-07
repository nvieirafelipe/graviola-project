<?php

/**
 * NjCalendar form base class.
 *
 * @method NjCalendar getObject() Returns the current form's model object
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNjCalendarForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'description' => new sfWidgetFormInputText(),
      'detail'      => new sfWidgetFormTextarea(),
      'monday'      => new sfWidgetFormInputCheckbox(),
      'tuesday'     => new sfWidgetFormInputCheckbox(),
      'wednesday'   => new sfWidgetFormInputCheckbox(),
      'thursday'    => new sfWidgetFormInputCheckbox(),
      'friday'      => new sfWidgetFormInputCheckbox(),
      'saturday'    => new sfWidgetFormInputCheckbox(),
      'sunday'      => new sfWidgetFormInputCheckbox(),
      'end_date'    => new sfWidgetFormDate(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 128)),
      'detail'      => new sfValidatorString(array('required' => false)),
      'monday'      => new sfValidatorBoolean(),
      'tuesday'     => new sfValidatorBoolean(),
      'wednesday'   => new sfValidatorBoolean(),
      'thursday'    => new sfValidatorBoolean(),
      'friday'      => new sfValidatorBoolean(),
      'saturday'    => new sfValidatorBoolean(),
      'sunday'      => new sfValidatorBoolean(),
      'end_date'    => new sfValidatorDate(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('nj_calendar[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjCalendar';
  }

}
