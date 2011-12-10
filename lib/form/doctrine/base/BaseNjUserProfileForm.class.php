<?php

/**
 * NjUserProfile form base class.
 *
 * @method NjUserProfile getObject() Returns the current form's model object
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNjUserProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'picture'    => new sfWidgetFormInputText(),
      'phone'      => new sfWidgetFormInputText(),
      'cell'       => new sfWidgetFormInputText(),
      'address'    => new sfWidgetFormInputText(),
      'complement' => new sfWidgetFormInputText(),
      'district'   => new sfWidgetFormInputText(),
      'city'       => new sfWidgetFormInputText(),
      'state'      => new sfWidgetFormInputText(),
      'country'    => new sfWidgetFormInputText(),
      'webpage'    => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'picture'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'phone'      => new sfValidatorInteger(array('required' => false)),
      'cell'       => new sfValidatorInteger(array('required' => false)),
      'address'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'complement' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'district'   => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'city'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'state'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'country'    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'webpage'    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('nj_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NjUserProfile';
  }

}
