<?php if($direction_id == 0): ?>
  <div id="trip" class="tabContent">
<?php else: ?>
  <div id="return-trip" class="tabContent hide">
<?php endif; ?>

<?php foreach($nj_schedules as $key => $values): ?>
    <table>
      <thead>
          <th colspan="100%"><strong><? echo $key ?></strong>:<br /></th>
      </thead>
      <tbody>
        <tr>
            <?php foreach($values as $value): ?>
              <?php foreach($value['NjTrips'] as $trip): ?>
                <?php if($trip['direction_id'] == $direction_id): ?>
                  <?php foreach($trip['NjStopTimes'] as $stop_times): ?>
                    <td><a href="<?php echo url_for('njRoute/show?id='. $route_id . '&trip_id='. $trip['id']); ?>" title="<?php echo($stop_times['departure_time']); ?>"><?php echo($stop_times['departure_time']); ?></a></td>
                  <?php endforeach; ?>
                <?php endif; ?>
             <?php endforeach; ?>
            <?php endforeach; ?>
        </tr>
      </tbody>
      <tfoot><th colspan="100%"><hr /></th></tfoot>
    </table>
<?php endforeach; ?>
  </div>
