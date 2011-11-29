<?php use_helper('I18N', 'Date') ?>
<?php include_partial('njRoute/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('View NjRoute', array(), 'messages') ?></h1>
  </div>

  <div class="sf_admin_actions_block ui-widget">
      <?php include_partial('njRoute/show_actions', array('form' => $form, 'Route' => $Route, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div class="ui-helper-clearfix"></div>

  <?php include_partial('show', array('form' => $form, 'Route' => $Route, 'configuration' => $configuration)) ?>

  <?php include_partial('njRoute/themeswitcher') ?>
</div>
