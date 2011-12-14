<?php use_helper('I18N'); ?>

<ul class="menu medium" >
  <li><a href="<?php echo url_for('termAndConditions'); ?>" class = 'link medium' title = 'NoJam <?php echo __('Terms and Conditions', null, 'messages'); ?>'><?php echo __('Terms and Conditions', null, 'messages'); ?></a></li>
  <li><a href="<?php echo url_for('privacyStatement'); ?>" class = 'link medium' title = 'NoJam <?php echo __('Privacy Statement', null, 'messages'); ?>'><?php echo __('Privacy Statement', null, 'messages'); ?></a></li>
  <li><a href="<?php echo url_for('advertise'); ?>" class = 'link medium' title = 'NoJam <?php echo __('Advertise', null, 'messages'); ?>'><?php echo __('Advertise', null, 'messages'); ?></a></li>
  <li><a href="<?php echo url_for('about'); ?>" class = 'link medium' title = '<?php echo __('About', null, 'messages'); ?> Nojam for me'><?php echo __('About', null, 'messages'); ?> NoJam for me</a></li>
  <li><a href="<?php echo url_for('contact'); ?>" class = 'link medium' title = '<?php echo __('Contact', null, 'messages'); ?>'><?php echo __('Contact', null, 'messages'); ?></a></li>
</ul>