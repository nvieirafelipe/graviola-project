<a href="<?php echo url_for('njUserProfile/edit?id='.$sf_user->getProfile()); ?>" class="link small edit_profile" title="Edit Profile">Edit Profile</a><br />
<div class="column box block">
  <?php if($nj_user_profile->getPicture()): ?>
    <?php echo image_tag(public_path(sfConfig::get('app_uploads_profile_pictures').$nj_user_profile->getPicture()), 
                                                            array('alt'=>$nj_user_profile->getSfGuardUser()->getName().' profile picture', 
                                                                  'title'=>$nj_user_profile->getSfGuardUser()->getName().'Profile Picture', 
                                                                  'style'=>'max-width:480px; max-height:720px')); ?>
  <?php else:?>
    Profile picture.
  <?php endif;?>
  <br />
</div>
<div class="column span-10 prepend-1">
  <table class="user_profile">
   <tr>
     <th>
       Username:
     </th>
     <th>
        <p class="user_profile"><?php echo $nj_user_profile->getSfGuardUser() ?> </p>
     </th>
   </tr>
   <tr>
     <th>
        First Name:
     </th>
     <th>
        <p class="user_profile"><?php echo $nj_user_profile->getSfGuardUser()->getFirstName(); ?> </p>
     </th>
   </tr>
   <tr>
      <th>
        Last Name:
      </th>
      <th>
        <p class="user_profile"><?php echo $nj_user_profile->getSfGuardUser()->getLastName(); ?></p>
      </th>
   </tr>
   <tr>
      <th>
         E-mail:
      </th>
      <th>
         <p class="user_profile"><?php echo $nj_user_profile->getSfGuardUser()->getEmailAddress(); ?></p>
      </th>
   </tr>
      <tr>
      <th>
         Phone:
      </th>
      <th>
         <p class="user_profile"><?php echo $nj_user_profile->getPhone(); ?></p>
      </th>
   </tr>
      <tr>
      <th>
         Cell:
      </th>
      <th>
         <p class="user_profile"><?php echo $nj_user_profile->getCell(); ?></p>
      </th>
   </tr>
   <tr>
      <th>
         Address:
      </th>
      <th>
         <p class="user_profile"> <?php echo $nj_user_profile->getAddress(); ?></p>
      </th>
    </tr>
    <tr>
       <th>
          Complement:
       </th>
       <th>
          <p class="user_profile"><?php echo $nj_user_profile->getComplement(); ?></p>
       </th>
    </tr>
    <tr>
       <th>
          District:
       </th>
       <th>
         <p class="user_profile"><?php echo $nj_user_profile->getDistrict(); ?> </p>
       </th>
    </tr>
    <tr>
       <th>
          City:
       </th>
       <th>
          <p class="user_profile"><?php echo $nj_user_profile->getCity(); ?> </p>
       </th>
    </tr>
    <tr>
       <th>
          State:
       </th>
       <th>
          <p class="user_profile"><?php echo $nj_user_profile->getState(); ?> </p>
       </th>
    </tr>
       <th>
          Country:
       </th>
       <th>
          <p class="user_profile"><?php echo $nj_user_profile->getCountry(); ?></p>
       </th>
    </tr>
    <tr>
       <th>
          Web Page:
       </th>
       <th>
          <p class="user_profile"><?php echo $nj_user_profile->getWebpage(); ?></p>
       </th>
       </tr>
  </table>
</div>
<div class="column span-24">
  <p class="user_profile">
    Last login:
    <?php echo $nj_user_profile->getSfGuardUser()->getLastLogin(); ?>
  </p>
  <p class="user_profile">
    Created at:
    <?php echo $nj_user_profile->getCreatedAt() ?>
    , Updated At:
    <?php echo $nj_user_profile->getUpdatedAt() ?>.
  </p>
</div>