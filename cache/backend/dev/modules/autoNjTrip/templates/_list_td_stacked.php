<td colspan="6">
  <?php echo __('%%description%% - %%njCalendar%% - %%njRoute%% - %%detail%% - %%created_at%% - %%updated_at%%', array('%%description%%' => link_to($Trip->getDescription(), 'nj_trip_edit', $Trip), '%%njCalendar%%' => $Trip->getNjCalendar(), '%%njRoute%%' => $Trip->getNjRoute(), '%%detail%%' => $Trip->getDetail(), '%%created_at%%' => false !== strtotime($Trip->getCreatedAt()) ? format_date($Trip->getCreatedAt(), "f") : '&nbsp;', '%%updated_at%%' => false !== strtotime($Trip->getUpdatedAt()) ? format_date($Trip->getUpdatedAt(), "f") : '&nbsp;'), 'messages') ?>
</td>
