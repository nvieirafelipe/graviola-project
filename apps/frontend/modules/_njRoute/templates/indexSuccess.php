<?php slot('title') ?>
  <?php echo 'Online information of routes and itineraries - NoJam'; ?>
<?php end_slot() ?>

<h1>Routes</h1>
<div class="column span-8 box">
    <div class="filter">
      <?php $select = new sfWidgetFormDoctrineChoice(array('model' => 'NjRoute', 'add_empty' => 'Select a route'), array('class'=>'select-box'));
            echo $select->render('nj_route_id'); ?>
      <?php $select = new sfWidgetFormSelect(array('choices' => $buses), array('class'=>'select-box'));
            echo $select->render('buses_from_route'); ?>
    </div>
    <br />
    <hr class="space"/>
    <div>
      <table>
        <thead>
          <th colspan="100%"><h2>Schedules</h2></th>
        </thead>
        <tfoot>
          <th colspan="100%">Schedules</th>
        </tfoot>
        <tbody>
          <?php for($i=0;$i<10;$i++): ?>
            <tr>
              <?php for($j=0;$j<5;$j++): ?>
                <td>
                  <?php echo rand(1, 100); ?>
                </td>
              <?php endfor; ?>
            </tr>
          <?php endfor; ?>
        </tbody>
      </table>
    </div>
</div>
<div class="column span-15 box push-1 last">
  <div id="map_canvas" class="map_canvas"></div>
  <div id="messages_container" class="messages_container"></div>
</div>