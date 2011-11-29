<?php use_helper('I18N') ?>
<?php slot('title') ?>
  <?php echo 'Reset Password - NoJam'; ?>
<?php end_slot() ?>

<div class="column span-6">
  <h1><?php echo __('Forgot your password?', null, 'sf_guard') ?></h1>

  <p>
    <?php echo __('Do not worry, we can help you get back in to your account safely!', null, 'sf_guard') ?>
    <?php echo __('Fill out the form below to request an e-mail with information on how to reset your password.', null, 'sf_guard') ?>
  </p>

  <form action="<?php echo url_for('@sf_guard_forgot_password') ?>" method="post">
    <table>
      <tbody>
        <?php echo $form ?>
      </tbody>
      <tfoot><tr><td colspan="2"><input class="liquid-right button" type="submit" name="change" value="<?php echo __('Request', null, 'sf_guard') ?>" /></td></tr></tfoot>
    </table>
  </form>
</div>
<div class="column span-14 liquid-right last">
  <?php echo image_tag(image_path('logo466x504.png', true), array('class'=>'njLogo')); ?>
</div>