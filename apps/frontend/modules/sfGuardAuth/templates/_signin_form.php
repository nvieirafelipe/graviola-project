<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table class="column span-6 box">
    <tbody>
      <tr>
        <th>
          <?php echo $form['username']->renderLabel(); ?>
        </th>
        <td>
          <?php echo $form['username']->renderError(); ?>
          <?php echo $form['username']->render(array('class'=>'text')); ?>
        </td>
      </tr>
      <tr>
        <th>
          <?php echo $form['password']->renderLabel(); ?>
        </th>
        <td>
          <?php echo $form['password']->renderError(); ?>
          <?php echo $form['password']->render(array('class'=>'text')); ?>
        </td>
      </tr>
      <tr>
        <th>
          &nbsp;
        </th>
        <td>
          <?php echo $form['remember']->renderError(); ?>
          <?php echo $form['remember']->render(array('class'=>'small')); ?>
          <?php echo $form['remember']->renderLabel(); ?>
        </td>
      <tr>
      <tr>
        <?php echo $form->renderHiddenFields(); ?>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td>&nbsp;</td>
        <td>
          
          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
          <input type="submit" class="link small" value="<?php echo __('Log In', null, 'sf_guard') ?>" />
          or
          <?php if (isset($routes['sf_guard_register'])): ?>
            &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Sign up for NoJam', null, 'sf_guard') ?></a>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
          <?php if (isset($routes['sf_guard_forgot_password'])): ?>
            <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
          <?php endif; ?>
      </tr>
    </tfoot>
  </table>
</form>