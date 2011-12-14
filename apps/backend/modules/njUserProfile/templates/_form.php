<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<form action="<?php echo url_for('njUserProfile/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(true) ?>
          <a href="<?php echo url_for('njUserProfile/show?id='.$form->getObject()->getId()) ?>" class="link medium">Cancel</a>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <th><?php echo $form->renderGlobalErrors() ?></th>
      </tr>
      <tr>
        <th><?php echo $form['sfGuardUser']['username']->renderLabel() ?></th>
        <td>
          <?php echo $form['sfGuardUser']['username']->renderError() ?>
          <?php echo $form['sfGuardUser']['username'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sfGuardUser']['first_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['sfGuardUser']['first_name']->renderError() ?>
          <?php echo $form['sfGuardUser']['first_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sfGuardUser']['last_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['sfGuardUser']['last_name']->renderError() ?>
          <?php echo $form['sfGuardUser']['last_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sfGuardUser']['email_address']->renderLabel() ?></th>
        <td>
          <?php echo $form['sfGuardUser']['email_address']->renderError() ?>
          <?php echo $form['sfGuardUser']['email_address'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['phone']->renderLabel() ?></th>
        <td>
          <?php echo $form['phone']->renderError() ?>
          <?php echo $form['phone'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['cell']->renderLabel() ?></th>
        <td>
          <?php echo $form['cell']->renderError() ?>
          <?php echo $form['cell'] ?>
        </td>
      </tr>
      <tr>          
        <th><?php echo $form['address']->renderLabel() ?></th>
        <td>
          <?php echo $form['address']->renderError() ?>
          <?php echo $form['address'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['complement']->renderLabel() ?></th>
        <td>
          <?php echo $form['complement']->renderError() ?>
          <?php echo $form['complement'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['district']->renderLabel() ?></th>
        <td>
          <?php echo $form['district']->renderError() ?>
          <?php echo $form['district'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['city']->renderLabel() ?></th>
        <td>
          <?php echo $form['city']->renderError() ?>
          <?php echo $form['city'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['state']->renderLabel() ?></th>
        <td>
          <?php echo $form['state']->renderError() ?>
          <?php echo $form['state'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['country']->renderLabel() ?></th>
        <td>
          <?php echo $form['country']->renderError() ?>
          <?php echo $form['country'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['webpage']->renderLabel() ?></th>
        <td>
          <?php echo $form['webpage']->renderError() ?>
          <?php echo $form['webpage'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['picture']->renderLabel() ?></th>
        <td>
          <?php echo $form['picture']->renderError() ?>
          <?php echo $form['picture'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
