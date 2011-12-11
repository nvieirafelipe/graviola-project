<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<div class="sf_admin_form">
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
          <li><a href="#sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>"><?php echo __($fieldset, array(), 'messages') ?></a></li>
        <?php endforeach; ?>
      </ul>
    <?php endif ?>

    <?php foreach ($configuration->getFormFields($form, 'show') as $fieldset => $fields): ?>
      <?php //include_partial('njTrip/form_fieldset', array('Trip' => $Trip, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>

      <div id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">

        <?php foreach ($fields as $name => $field): ?>
          <?php $attributes = $field->getConfig('attributes', array()); ?>
          <?php if ($field->isPartial()): ?>
            <?php include_partial('njTrip/' . $name, array('Trip' => $Trip, 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
          <?php elseif ($field->isComponent()): ?>
            <?php include_component('njTrip', $name, array('Trip' => $Trip, 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
          <?php else: ?>
            <div class="sf_admin_form_row">
              <?php if ($field->getName() == 'id'): ?>
                <input type="hidden" id="nj_route_id" value="<?php echo $form->getObject()->get($name); ?>" />
                <?php echo $form->getObject()->get($name) ? $form->getObject()->get($name) : "&nbsp;" ?>
              <?php elseif ($field->getName() == 'polyline'): ?>
                <div class="space"></div>
                <div class="map_wrapper">
                  <div class="map_path_data" style="display:none;">
                    <textarea class="polyline-coords"><?php echo $form->getObject()->get($name) ? $form->getObject()->get($name) : "&nbsp;" ?></textarea>
                    <div class="stops-coords"><?php echo html_entity_decode($stop_time_coords); ?></div>
                  </div>
                  <div id="map_canvas" class="map_canvas"></div>
                </div>
              <?php else: ?>
                <label><?php echo $field->getConfig('label') ? $field->getConfig('label') : $field->getName() ?>:</label>
                <?php echo $form->getObject()->get($name) ? $form->getObject()->get($name) : "&nbsp;" ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>

        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>
