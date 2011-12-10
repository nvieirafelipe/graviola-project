<div><ul id="routes" class="box">
    <?php foreach ($nj_routes as $nj_route): ?>
    <?php $trips = $nj_route->getNjTrips(); ?>
        <li>
          <a href="<?php echo url_for('njRoute/show?id='.$nj_route->getId()  . '&trip_id='. $trips[0]->getId()) ?>">
            <?php echo $nj_route->getName() ?>
          </a>
        </li>
    <?php endforeach; ?>
</ul>

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
            <a id="route_link" href="<?php echo url_for('njRoute/show?id='.$nj_notification->getNjRoute()->getId()  . '&trip_id='. $trips[0]->getId()) ?>"> 
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