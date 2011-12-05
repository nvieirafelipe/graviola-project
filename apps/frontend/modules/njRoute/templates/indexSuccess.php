<h1>Routes</h1>
<div id="routes_filter" class="column span-5 append-1">
    <?php echo $nj_routesFormFilter['nj_transport_mode_id']->render(array('class'=>'select-box')); ?> <br />
    <ul id="routes" class="box">
        <?php foreach ($nj_routes as $index => $nj_route): ?>
            <li>
              <a id="route_link" href="<?php echo url_for('njRoute/show?id='.$nj_route->getId() . '&trip_id='. $default_nj_trip_id[$index]); ?>">
                <?php echo $nj_route->getName() ?>
              </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="column span-12">
    <div class="map_canvas" id  ="map_canvas"></div>
</div>

<div id="notifications_filter" class="column span-6 push-1 last">
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
              <?php $trips = $nj_notification->getNjRoute()->getNjTrips(); ?>
                  <a id="route_link" href="<?php echo url_for('njRoute/show?id='.$nj_notification->getNjRoute()->getId() . '&trip_id='. $trips[0]->getId()); ?>"> 
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