<?php if ($field->isPartial()): ?>
  <?php include_partial('njStop/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
  <?php include_component('njStop', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
  <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' ui-state-error ui-corner-all' ?>">
    <div class="label ui-helper-clearfix">
      <?php if ($name != 'latitude' && $name != 'longitude') : ?>
        <?php echo $form[$name]->renderLabel($label) ?>
      <?php endif; ?>
      <?php if ($help || $help = $form[$name]->renderHelp()): ?>
        <div class="help">
          <span class="ui-icon ui-icon-help floatleft"></span>
          <?php echo __(strip_tags($help), array(), 'messages') ?>
        </div>
      <?php endif; ?>
    </div>
    
    <?php if ($name == 'latitude' || $name == 'longitude') : ?>
    <div style="display:none;">
      <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
    </div>
    <?php else: ?>
      <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
    <?php endif; ?>
    
    <?php if ($form[$name]->hasError()): ?>
      <div class="errors">
        <span class="ui-icon ui-icon-alert floatleft"></span>
        <?php echo $form[$name]->renderError() ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
