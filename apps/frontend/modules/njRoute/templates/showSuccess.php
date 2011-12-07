<div class="column span-6">
    <h1><?php echo $nj_route->getName() ?> - </h1>
    <input type="hidden" id="nj_route_id" value="<?php echo $nj_route->getId() ?>">
    <div class="box">
        <ul id="tabs" class="direction-tabs">
                <li>
                    <a href="#trip" class="link medium">Trip</a>
                </li>
                <li>
                    <a href="#return-trip" class="link medium">Return trip</a>
                </li>
        </ul>
        <div class="tabContents">
            <?php include_partial('schedules', array('nj_schedules' => $sf_data->getRaw('nj_schedules'), 'direction_id' => 0, 'route_id' => $nj_route->getId())); ?>
            <?php include_partial('schedules', array('nj_schedules' => $sf_data->getRaw('nj_schedules'), 'direction_id' => 1, 'route_id' => $nj_route->getId())); ?>
        </div>
    </div>
</div>

<div class="column span-12">
    <div id="map_canvas" class="map_canvas"></div>
</div>

<!--- TEM QUE CARREGAR AQUI A POLYLINE lat;lng,lat;lng--->
<textarea style="display:none" class="path-polyline"><?php print $polyline_text; ?></textarea>

<!--- TEM QUE CARREGAR AQUI OS STOPS NO FORMATO lat;lng;textstop(pode ser html), lat;lng;textstop(pode ser html)--->
<textarea style="display:none" class="path-stops"><?php print $stop_time_coords; ?></textarea>

<div id="notifications_filter" class="column span-6 push-1 last">
  <?php if ($sf_user->isAuthenticated()) : ?>
    <?php if(!$subscriber): ?>
      <a id="subscribe" class="link subscribe">Subscribe now</a>
      <a id="unsubscribe" class="link unsubscribe" style="display:none;">Unsubscribe</a>
    <? else: ?>
      <a id="subscribe" class="link subscribe" style="display:none;">Subscribe now</a>
      <a id="unsubscribe" class="link unsubscribe">Unsubscribe</a>
    <?php endif; ?>  
  <?php endif; ?>  
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
                <a id="route_link" href="<?php echo url_for('njRoute/show?id='.$nj_notification->getNjRoute()->getId() . '&trip_id='. $trips[0]->getId()) ?>"> 
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
          <br />
      <?php endforeach;?>
  <?php endif; ?>  
</div>

<div class="column span-24 last">
    <a href="<?php echo url_for('njRoute/index') ?>" class="link">Back</a>
</div>
