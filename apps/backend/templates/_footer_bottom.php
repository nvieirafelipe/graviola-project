<div class="column span-24 last"> 
  <p class="copyright quiet right">2011 - No jam for me.</p>
</div>
<div class="column span-4 colborder">
  <h3 class="">Ellentesque placerat suscipit justo.</h3>
  <p class="">Curabitur sit amet elit ipsum. Pellentesque dignissim, purus ut scelerisque tristique, lacus tellus dictum lacus, rutrum fringilla leo dolor in nunc. Morbi nisl nisl</p>
</div>
<div class="column <?php echo ($sf_user->isAuthenticated() && $sf_user->isSuperAdmin())? 'span-6 colborder': 'span-12 last' ; ?>">
  <h3 class="">Donec sed placerat nulla.</h3>
  <p class="">Donec sed ligula risus. Morbi quis eros mauris. Etiam malesuada dolor vel libero vehicula condimentum.</p>
</div>
<?php if($sf_user->isAuthenticated() && $sf_user->isSuperAdmin()): ?>
  <div class="column span-6 colborder">
    <h3 class="">App config.</h3>
    <p>Would like to configure the application ? <a href="<?php echo url_for('app_config'); ?>" class="inline link small" style="padding: 0;">click here</a>.</p>
    <p><a class="link medium block" href="<?php echo url_for('nj_section_routing'); ?>">Manage sections</a><br />
       <a class="link medium block" href="<?php echo url_for('nj_menu_item_routing'); ?>">Manage menu items</a><br />
       <a class="link medium block" href="<?php echo url_for('nj_login_group_routing'); ?>">Manage login-group routing</a></p>
    <?php include_component('language', 'language') ?>
  </div>
  <div class="column span-4 last">
    <h3 class="">Data simulation.</h3>
    <p>Would like to test our powerful application with a significant amount of data? So <a href="<?php echo url_for('nj_data_simulation'); ?>" class="inline link small" style="padding: 0;">click here</a> to enter simulation data in the system.</p>
  </div>
<?php endif;?>
