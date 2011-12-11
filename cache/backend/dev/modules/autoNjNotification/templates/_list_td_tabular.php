<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Notification->getId(), 'nj_notification_edit', $Notification) ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_nj_notification_type_id">
  <?php echo $Notification->getNjNotificationTypeId() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $Notification->getDescription() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_detail">
  <?php echo $Notification->getDetail() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_nj_route_id">
  <?php echo $Notification->getNjRouteId() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_nj_trip_id">
  <?php echo $Notification->getNjTripId() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_nj_stop_time_id">
  <?php echo $Notification->getNjStopTimeId() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_average_speed">
  <?php echo $Notification->getAverageSpeed() ?>
</td>
<td class="sf_admin_time sf_admin_list_td_time_delay">
  <?php echo $Notification->getTimeDelay() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($Notification->getCreatedAt()) ? format_date($Notification->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($Notification->getUpdatedAt()) ? format_date($Notification->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
