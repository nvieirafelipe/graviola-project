<?php use_helper('I18N'); ?>

<div class="logo left">
  <a href="<?php echo url_for('homepage'); ?>"><?php echo image_tag(image_path('logo176x190.png', true), array('class'=>'njLogo')); ?></a>
</div>

<?php $routes = $sf_context->getRouting()->getRoutes(); ?>
<!--Menu Area-->
<?php include_component('widgets', 'mainmenu'); ?>

<!--Welcome message block-->
<?php if ($sf_user->isAuthenticated()) { ?>
  <div class="right last">
    Welcome, 
    <a href="<?php echo url_for('njUserProfile/show?id='.$sf_user->getProfile()->getId()); ?>" class="link medium">
      <?php if($sf_user->getProfile()->getPicture()): ?>
        <?php echo image_tag(public_path(sfConfig::get('app_uploads_profile_pictures').$sf_user->getProfile()->getPicture()), 
                                 array('alt'=>$sf_user->getName().' profile picture', 'title'=>$sf_user->getName().'Profile Picture', 
                                 'class' => 'prepend-3', 'style'=>'max-width:80px; max-height:45px;')); ?>
      <?php endif; ?> 
    <br />
    <strong><?php echo $sf_user->getUsername(); ?></a></strong>
      <ul class="dropdown-menu column right">
        <ul>
            <li><a href="<?php echo url_for('njUserProfile/edit?id='.$sf_user->getProfile()->getId()); ?>" class="link small edit_profile" title="Edit Profile">Edit Profile</a></li>
            <li><?php echo link_to2('Logout', 'sf_guard_signout', array(), array('class'=>'link small logout', 'title' => 'Log Out')); ?></li>
        </ul>
      </ul>
  </div>
<?php } else { ?>
  <div class="welcome-message right last">
    <p>New to NoJam?
    <?php if (isset($routes['sf_guard_register'])): ?>
      <a class="quiet" href="<?php echo url_for('@sf_guard_register'); ?>"><?php echo __('Join today!', null, 'sf_guard') ?></a>
    <?php endif; ?>
    </p>
    <?php if ($sf_request->getParameter('module') != 'sfGuardAuth'): ?>
    <div class="signin">
      <?php echo include_partial('global/signin_form', array('form' => new sfGuardFormSignin)) ?>
    </div>
    <?php endif; ?>
  </div>
<?php } ?>