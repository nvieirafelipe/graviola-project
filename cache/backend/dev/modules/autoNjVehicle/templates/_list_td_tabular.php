<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Vehicle->getId(), 'nj_vehicle_edit', $Vehicle) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $Vehicle->getDescription() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_detail">
  <?php echo $Vehicle->getDetail() ?>
</td>
