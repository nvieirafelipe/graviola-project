<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@nj_stop') ?>

  <div class="sf_admin_actions_block ui-widget">
    <?php include_partial('njStop/form_actions', array('Stop' => $Stop, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div class="ui-helper-clearfix"></div>

  <?php echo $form->renderHiddenFields() ?>

  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>


  <?php
  $count = 0;
  foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields):
    $count++;
  endforeach;
  ?>


  <div id="sf_admin_form_tab_menu">
    <?php if ($count > 1): ?>
      <ul>
        <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
          <?php $count++ ?>
          <li><a href="#sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>"><?php echo __($fieldset, array(), 'messages') ?></a></li>
        <?php endforeach; ?>
      </ul>
    <?php endif ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('njStop/form_fieldset', array('Stop' => $Stop, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>
    <div class="map_wrapper">
      <div id="map_canvas" class="map_canvas"></div>
    </div>
  </div>


  <div class="sf_admin_actions_block ui-widget ui-helper-clearfix">
    <?php include_partial('njStop/form_actions', array('Stop' => $Stop, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

</form>
</div>
