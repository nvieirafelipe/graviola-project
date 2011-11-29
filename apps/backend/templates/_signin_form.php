<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <div>
    <?php echo $form['username']->renderRow(array('class'=>'text small')); ?>
  </div>
  <div>
    <?php echo $form['password']->renderRow(array('class'=>'text small')); ?>
  </div>
  <div class="buttons">
    <input type="submit" class="link small" value="Login" />
  </div>
  <div class="extra">
    <?php echo $form['remember']->render(array('class'=>'small')); ?>
    <?php echo $form['remember']->renderLabel(); ?>
    <?php echo $form['remember']->renderError(); ?>
    <?php $routes = $sf_context->getRouting()->getRoutes() ?>
    <?php if (isset($routes['sf_guard_forgot_password'])): ?>
      <a class="quiet small prepend-2" href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
    <?php endif; ?>
  </div>

  <?php echo $form->renderHiddenFields(); ?>
</form>