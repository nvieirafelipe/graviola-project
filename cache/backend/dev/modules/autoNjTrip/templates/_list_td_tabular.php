<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo link_to($Trip->getDescription(), 'nj_trip_edit', $Trip) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_njCalendar">
  <?php echo $Trip->getNjCalendar() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_njRoute">
  <?php echo $Trip->getNjRoute() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_detail">
  <?php echo $Trip->getDetail() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($Trip->getCreatedAt()) ? format_date($Trip->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($Trip->getUpdatedAt()) ? format_date($Trip->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
