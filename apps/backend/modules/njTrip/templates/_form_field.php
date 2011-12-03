<?php if ($field->isPartial()): ?>
  <?php include_partial('njTrip/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
  <?php include_component('njTrip', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif($name != 'delete'): ?>
  <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' ui-state-error ui-corner-all' ?>">
    <div class="label ui-helper-clearfix">
      <?php if ($name != 'NjStopTimes'):  ?>
        <?php echo $form[$name]->renderLabel($label) ?>
      <?php endif; ?>
      
      <?php if ($help || $help = $form[$name]->renderHelp()): ?>
        <div class="help">
          <span class="ui-icon ui-icon-help floatleft"></span>
          <?php echo __(strip_tags($help), array(), 'messages') ?>
        </div>
      <?php endif; ?>
    </div>

    <?php if($name == 'polyline'): ?>
      <!-- TODO The first two lines should be in action. -->
      <div class="add-stop-wrapper">
        <?php $oneFieldForm = new sfForm(); ?>
        <?php $oneFieldForm->setWidget('nj_stop_id', new sfWidgetFormDoctrineChoice(array('model' => 'NjStop', 'add_empty' => false))); ?>
        <?php $oneFieldForm->setWidget('nj_stop_lat_lng', new sfWidgetFormDoctrineChoice(array('model' => 'NjStop', 'method' => 'getLatitudeLongitude', 'add_empty' => false))); ?>
        <?php echo $oneFieldForm['nj_stop_id']->render(); ?>
        <div class="nj_stop_lat_lng_wrapper" style="display:none;">
          <?php echo $oneFieldForm['nj_stop_lat_lng']->render(); ?>
        </div>   
        <a href="#add-stop" title="Add Stop" class="btn-add-stop">Add Stop</a>
      </div>
      <div class="map_wrapper">
        <div style="display:none;" class="map_path_data">
          <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
        </div>
        <div id="map_canvas" class="map_canvas"></div>
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
