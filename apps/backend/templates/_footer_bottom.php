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
    <p><?php echo __('Would like to configure the application ?', null, 'message').' <a href="'.url_for("app_config").'" class="inline link small" style="padding: 0;">'.__('click here', null, 'messages').'</a>.' ?></p>
    <p><a class="link medium block" href="<?php echo url_for('nj_section_routing'); ?>"><?php echo __('Manage sections', null, 'messages'); ?></a><br />
       <a class="link medium block" href="<?php echo url_for('nj_menu_item_routing'); ?>"><?php echo __('Manage menu items', null, 'messages'); ?></a><br />
       <a class="link medium block" href="<?php echo url_for('nj_login_group_routing'); ?>"><?php echo __('Manage login-group routing', null, 'messages'); ?></a></p>
    <?php include_component('language', 'language') ?>
  </div>
  <div class="column span-4 last">
    <h3 class=""><?php echo __('Data simulation', null, 'messages')?></h3>
    <p><?php echo __('Would like to test our powerful application with a significant amount of data? So', null, 'messages').' <a href="'.url_for("nj_data_simulation").'" class="inline link small" style="padding: 0;">'.__('click here', null, 'messages').',</a> '.__('to enter simulation data in the system', null, 'messages').'.'; ?></p>
  </div>
<?php endif;?>
