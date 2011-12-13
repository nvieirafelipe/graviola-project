<td colspan="3">
  <?php echo __('%%id%% - %%description%% - %%detail%%', array('%%id%%' => link_to($Vehicle->getId(), 'nj_vehicle_edit', $Vehicle), '%%description%%' => $Vehicle->getDescription(), '%%detail%%' => $Vehicle->getDetail()), 'messages') ?>
</td>
