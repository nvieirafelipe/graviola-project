<div class="column span-6 left">
  <div id="graph_canvas" class="graph_canvas_dashboard"></div>
</div>
<div class="column span-12 left">
    <div id="map_canvas" class="map_canvas"></div>
</div>
<div id="notifications_filter" class="column span-6 right">
  <h1>Notifications</h1>
  <?php if(!$nj_notifications->count()>0):?>
      <div id="notifications" class="box">
        <h2>Halo!</h2>
        <hr class="space" />
        <p>
            Sorry, but there is no notifications for you.
        </p>
      </div>
  <? else: ?> 
      <?php foreach($nj_notifications as $nj_notification):?>
        <div id="notifications" class="box <?php echo $nj_notification->getNjNotificationType(); ?>">
              <h2><?php echo $nj_notification->getDescription(); ?></h2>
              <?php if ($nj_notification->getNjRoute()->count() > 0): ?>
                  <a id="route_link" href="<?php echo url_for('njRoute/show?id='.$nj_notification->getNjRoute()->getId()) ?>"> 
                      <h3>
                          <?php echo $nj_notification->getNjRoute()->getDescription(); ?> 
                          <?php if ($nj_notification->getNjStopTime()): ?>
                              <?php echo ' - '.$nj_notification->getNjStopTime()->getNjStop()->getDescription(); ?>
                           <?php endif; ?>
                      </h3> 
                  </a>
              <?php endif; ?>  
              <hr class="space" />
              <p><?php echo $nj_notification->getDetail(); ?></p>
        </div>
      <?php endforeach;?>
  <?php endif; ?>  
</div>
<div class="column span-4 box left ">
  <table>
    <thead>
      <th colspan="100%">
        Free vehicles
      </th>
    </thead>
    <tbody>    
  <?php foreach($nj_free_vehicles as $nj_free_vehicle): ?>
    <tr>
        <td>
          <? echo $nj_free_vehicle->getNjTransportMode()->getDescription(); ?>
        </td>
        <td>
          <? echo $nj_free_vehicle->getDescription(); ?>
        </td>
      </tr>
  <?php endforeach;?>
    </tbody>
    <tfoot>
      <th colspan="100%">
        There is <? echo $nj_free_vehicles->count(); ?> vehicle(s) free.
      </th>
    </tfoot>
  </table>
</div>