<table>
  <tbody>
    <?php foreach($form['new'][$num] as $field): ?>
      <tr>
        <?php if($field->getName() == 'polyline'): ?>
          <th>
            <?php echo $field->renderLabel(); ?>
            <?php echo $field->renderError(); ?>
          </th>
        <?php elseif($field->getName() != 'id'): ?>
          <th>
            <?php echo $field->renderLabel(); ?>
            <?php echo $field->renderError(); ?>
          </th>
          <td>
            <?php echo $field->render(); ?>
          </td>
        <?php else: ?>
          <th>
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