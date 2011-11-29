<table>
  <tbody>
    <?php foreach($form['new'][$num] as $field): ?>
      <tr>
        <?php if($field->getName() == 'polyline'): ?>
          <th>
            <?php echo $field->renderLabel(); ?>
            <?php echo $field->renderError(); ?>
          </th>
          <td>
            <div class="map_wrapper">
              <div style="display:none;" class="map_path_data">
                <?php echo $field->render(); ?>
              </div>
              <div id="map_canvas" class="map_canvas"></div>
            </div>  
          </td>
        <?php elseif($field->getName() == 'id'): ?>
          <th>
            <?php echo $field->renderError(); ?>
          </th>
          <td>
            <?php echo $field->render(); ?>
          </td>
        <?php elseif($field->getName() != 'NjStopTimes'): ?>
          <th>
            <?php echo $field->renderLabel(); ?>
            <?php echo $field->renderError(); ?>
          </th>
          <td>
            <?php echo $field->render(); ?>
          </td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>