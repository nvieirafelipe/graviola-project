<?php use_helper('I18N') ?>
<?php slot('title') ?>
  <?php echo 'Welcome to NoJam - Create your account'; ?>
<?php end_slot() ?>

<div class="column span-6 colborder">
<h1><?php echo __('Register', null, 'sf_guard') ?></h1>
<?php echo get_partial('sfGuardRegister/form', array('form' => $form)) ?>
</div>
<!--
<div class="column span-14 liquid-right last">
    <fb:registration
        fields="[{'name':'name'}, {'name':'email'},
        {'name':'password','description':'Password',
        'type':'text'}]" redirect-uri="http://felipenv.dyndns.org:8098/graviola/web/register">
  </fb:registration>
</div>
-->
