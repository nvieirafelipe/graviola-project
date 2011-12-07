<a href="<?php echo url_for('nj_user_profile_edit'); ?>" class="link small edit_profile" title="Edit Profile">Edit Profile</a>
<br />
<div class="column box block">
  <?php if($nj_user_profile->getPicture()): ?>
    <?php echo image_tag(public_path(sfConfig::get('app_uploads_profile_pictures').$nj_user_profile->getPicture()), 
                                                            array('alt'=>$nj_user_profile->getSfGuardUser()->getName().' profile picture', 
                                                                  'title'=>$nj_user_profile->getSfGuardUser()->getName().'Profile Picture', 
                                                                  'style'=>'max-width:480px; max-height:720px')); ?>
  <?php else: ?>
    Profile picture.
  <?php endif;?>
  <br />
</div>
<div class="column span-10 prepend-1">
  <p>
    User:
    <?php echo $nj_user_profile->getSfGuardUser() ?>
  </p>
  <p>
    First Name:
    <?php echo $nj_user_profile->getSfGuardUser()->getFirstName(); ?>
  </p>
  <p>
    Last Name:
    <?php echo $nj_user_profile->getSfGuardUser()->getLastName(); ?>
  </p>
  <p>
    E-mail:
    <?php echo $nj_user_profile->getSfGuardUser()->getEmailAddress(); ?>
  </p>
  <p>
    Username:
    <?php echo $nj_user_profile->getSfGuardUser()->getUsername(); ?>
  </p>
  <p>
    Address:
    <?php echo $nj_user_profile->getAddress(); ?>
  </p>
  <p>
    Complement:
    <?php echo $nj_user_profile->getComplement(); ?>
  </p>
  <p>
    District:
    <?php echo $nj_user_profile->getDistrict(); ?>
  </p>
  <p>
    City:
    <?php echo $nj_user_profile->getCity(); ?>
  </p>
  <p>
    State:
    <?php echo $nj_user_profile->getState(); ?>
  </p>
  <p>
    Country:
    <?php echo $nj_user_profile->getCountry(); ?>
  </p>
  <p>
    Web Page:
    <?php echo $nj_user_profile->getWebpage(); ?>
  </p>
</div>
<div class="column span-24">
  <p>
    Last Login:
    <?php echo $nj_user_profile->getSfGuardUser()->getLastLogin(); ?>
  </p>
  <p>
    Profile created at:
    <?php echo $nj_user_profile->getCreatedAt() ?>
    , last updated at:
    <?php echo $nj_user_profile->getUpdatedAt() ?>.
  </p>
</div>
