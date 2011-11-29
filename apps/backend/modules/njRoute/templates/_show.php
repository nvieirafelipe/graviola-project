<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<div class="sf_admin_form column span-12 liquid-center colborder">
  <?php 
  $count = 0;
  foreach ($configuration->getFormFields($form, 'show') as $fieldset => $fields):
    $count++;
  endforeach;
  ?>
  <div id="sf_admin_form_tab_menu">
    <?php if ($count > 1): ?>
      <ul>
        <?php foreach ($configuration->getFormFields($form, 'show') as $fieldset => $fields): ?>
          <?php $count++ ?>
          <li><a href=<?php echo "#sf_fieldset_" . preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>><?php echo __($fieldset, array(), $this->getI18nCatalogue()) ?></a></li>
        <?php endforeach; ?>
      </ul>
    <?php endif ?>

    <?php foreach ($configuration->getFormFields($form, 'show') as $fieldset => $fields): ?>
      <div id="<?php echo "sf_fieldset_" . preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
        <?php foreach ($fields as $name => $field): ?>
          <?php $attributes = $field->getConfig('attributes', array()); ?>
          <?php if ($field->isPartial()): ?>
            <?php include_partial($this->getModuleName() . '/' . $name, array($this->getSingularName() => ${$this->getSingularName()}, 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
          <?php elseif ($field->isComponent()): ?>
            <?php include_component($this->getModuleName(), $name, array($this->getSingularName() => ${$this->getSingularName()}, 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
          <?php else: ?>
            <div class="sf_admin_form_row">
              <?php $label = $field->getConfig('label') ? $field->getConfig('label') : $field->getName(); ?>
              <label><?php echo $label; ?>:</label>
              <!-- For polyline a map should be showed -->
              <?php if ($label == 'id'){ ?>
                <input type="hidden" id="nj_route_id" value="<?php echo $form->getObject()->get($name); ?>" />
                <?php echo $form->getObject()->get($name) ? $form->getObject()->get($name) : "&nbsp;" ?>
              <?php }elseif ($label == 'polyline') {  ?>
                <div class="space"></div>
                <div id="map_canvas" class="map_canvas clear clearfix"></div>
              <?php } else {?>
                <?php echo $form->getObject()->get($name) ? $form->getObject()->get($name) : "&nbsp;" ?>
              <?php }; ?>
            </div>
          <?php endif; ?>

        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>