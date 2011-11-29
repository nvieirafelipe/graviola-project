<table>
  <tbody>
    <?php foreach ($form as $field): ?>
      <tr class="form-field">
        <?php if ($field->getName() != 'id'): ?>
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
<div class="operations-wrapper">
  <a href="#save-stop-time" title="Save stop time">Save stop time</a></br>
  <a href="#delete-stop-time" title="Delete stop time">Delete stop time</a>
</div>