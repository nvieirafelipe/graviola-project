<?php

require_once(dirname(__FILE__).'/../../../lib/vendor/symfony/lib/helper/UrlHelper.php');
/**
 * NjUserProfile form.
 *
 * @package    graviola
 * @subpackage form
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NjUserProfileForm extends BaseNjUserProfileForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['nj_notifications_subscribed_list']);
    
    $this->setValidator('picture', new sfValidatorFile(array(
      'mime_types' => 'web_images',
      'path' => sfConfig::get('sf_upload_dir').'/profile-pictures/',
      'required' => false,
    )));

    $this->setWidget('picture', new sfWidgetFormInputFileEditable(array(
          'file_src'    => public_path(sfConfig::get('app_uploads_profile_pictures').$this->getObject()->picture, true),
          'edit_mode'   => !$this->isNew(),
          'is_image'    => true,
          'with_delete' => true,
    )));
    
    $this->setWidget('user_id', new sfWidgetFormInputHidden());
    
    $this->embedRelation('sfGuardUser');
  }
}