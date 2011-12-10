<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Notification->getId(), 'nj_notification_edit', $Notification) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_njNotificationType">
  <?php echo $Notification->getNjNotificationType() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_njTrip">
  <?php echo $Notification->getNjTrip() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_njStopTime">
  <?php echo $Notification->getNjStopTime() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($Notification->getCreatedAt()) ? format_date($Notification->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($Notification->getUpdatedAt()) ? format_date($Notification->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
