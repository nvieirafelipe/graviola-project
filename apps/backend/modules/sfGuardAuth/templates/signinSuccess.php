<?php use_helper('I18N') ?>
<?php slot('title') ?>
  <?php echo 'Log in to NoJam'; ?> 
<?php end_slot() ?>

<div class="column span-12">
  <?php echo image_tag(image_path('logo466x504.png', true), array('class'=>'njLogo')); ?>
</div>
<div class="column liquid-right last">
  <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>
</div>
