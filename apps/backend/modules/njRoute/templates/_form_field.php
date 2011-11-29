<?php if ($field->isPartial()): ?>
  <?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
  <?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
  <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' ui-state-error ui-corner-all' ?>">
    <div class="label ui-helper-clearfix clear">

    <?php if ($name != 'NjTrips'):  ?>
      <?php echo $form[$name]->renderLabel($label,array('id' => $name)) ?>
    <?php endif; ?>

    <?php if ($help || $help = $form[$name]->renderHelp()): ?>
      <div class="help">
        <span class="ui-icon ui-icon-help floatleft"></span>
      </div>
    <?php endif; ?>
    </div>
    <?php if ($name == 'NjTrips'):  ?>
      <!--<a class="link right" id="addTrip">Add new trip</a>-->
    <?php endif; ?>
    <?php if ($name == 'NjTrips' || $name == 'new') :  ?>
<!--     <table style="display: none;">
      <tbody>
      <?php /*foreach($form[$name] as $njTripForm): ?>
        <?php foreach($njTripForm as $njTripFormFields): ?>
          <tr>
          <?php if ($njTripFormFields->getName() == 'polyline'): ?>
              <th>
                <?php echo $form[$name][$njTripForm->getName()][$njTripFormFields->getName()]->renderLabel(); ?>
                <?php echo $form[$name][$njTripForm->getName()][$njTripFormFields->getName()]->renderError(); ?>
              </th>
              <td>
                <div class="map_wrapper">
                  <div style="display:none;" class="map_path_data">
                    <?php echo $form[$name][$njTripForm->getName()][$njTripFormFields->getName()]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
                  </div>
                  <div id="map_canvas" class="map_canvas"></div>
                </div>  
                <a href="<?php echo url_for('nj_trip_edit', array('id' => $form[$name][$njTripForm->getName()]['id']->getValue())); ?>" class="link text">Add Stop Times</a>
              </td>
          <?php elseif($njTripFormFields->getName() == 'id'): ?> 
            <th>
              <?php echo $form[$name][$njTripForm->getName()][$njTripFormFields->getName()]->renderError(); ?>
            </th>
            <td>
              <?php echo $form[$name][$njTripForm->getName()][$njTripFormFields->getName()]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>        
            </td>
          <?php elseif($njTripFormFields->getName() != 'NjStopTimes'): ?> 
            <th>
              <?php echo $form[$name][$njTripForm->getName()][$njTripFormFields->getName()]->renderLabel(); ?>
              <?php echo $form[$name][$njTripForm->getName()][$njTripFormFields->getName()]->renderError(); ?>
            </th>
            <td>
              <?php echo $form[$name][$njTripForm->getName()][$njTripFormFields->getName()]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>        
            </td>
          <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      <?php endforeach; */ ?>
      </tbody>
    </table>-->

    <?php else :  ?>
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
