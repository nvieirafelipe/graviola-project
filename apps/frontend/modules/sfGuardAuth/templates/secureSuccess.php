<?php use_helper('I18N') ?>
<?php slot('title') ?>
  <?php echo 'The page is secure - NoJam'; ?>
<?php end_slot() ?>

<div class="column span-8 last">
  <h2><?php echo __('Oops! The page you asked for is secure and you do not have proper credentials.', null, 'sf_guard') ?></h2>
</div>