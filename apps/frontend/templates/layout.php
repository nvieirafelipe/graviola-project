<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $sf_user->getCulture() ?>" lang="<?php echo $sf_user->getCulture() ?>">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <!--[if lt IE 8]>
      <link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection">
    <![endif]-->
    <?php include_javascripts() ?>
    <?php if (!get_slot('title')): ?>
      <?php include_title(); ?>
    <?php else: ?>
      <title><?php include_slot('title') ?></title>
    <?php endif ?>
  </head>
  <body class="frontend <?php echo $sf_request->getParameterHolder()->get('module'); ?> <?php echo $sf_user->isAuthenticated() ? "logged" : "not-logged";  ; ?>">
    <div class="header">
      <div class="container">
        <div class="column span-24 header-top last">
          <?php include_partial('global/header_top'); ?>
        </div>
        <div class="column span-24 header-bottom last">
          <?php include_partial('global/header_bottom'); ?>
        </div>
      </div>
    </div>
    <div class="container">
      <?php echo $sf_content ?>
    </div>
    <div class="footer">
      <div class="container">
        <div class="column span-24 footer-top last">
          <?php include_partial('global/footer_top'); ?>
        </div>
        <div class="column span-24 footer-bottom last">
          <?php include_partial('global/footer_bottom'); ?>
        </div>
      </div>
    </div>
  </body>
</html>