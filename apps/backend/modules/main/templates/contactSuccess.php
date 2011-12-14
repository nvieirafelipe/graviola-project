<?php slot('title') ?>
  <?php echo __('Contact', null, 'messages').' - NoJam'; ?>
<?php end_slot() ?>
<h1><?php echo __('Contact', null, 'messages'); ?></h1>
<form method="get" action="#">
  <label for="Name" style="width:100px; display: inline-block"><?php echo __('Name', null, 'messages'); ?>:</label>
  <input type="text" name="Name" id="Name" placeholder="NAME_FULL" title="heuristic type: NAME_FULL
server type: NO_SERVER_DATA
field signature: 502192749
form signature: 1541123618731142864
experiment id: &quot;&quot;"><br />
  <label for="City" style="width:100px;; display: inline-block"><?php echo __('City', null, 'messages'); ?>:</label>
  <input type="text" name="City" id="City" placeholder="ADDRESS_HOME_CITY" title="heuristic type: ADDRESS_HOME_CITY
server type: NO_SERVER_DATA
field signature: 1853872792
form signature: 1541123618731142864
experiment id: &quot;&quot;"><br />
  <label for="Email" style="width:100px; display: inline-block">Email:</label>
  <input type="text" name="Email" id="Email" placeholder="EMAIL_ADDRESS" title="heuristic type: EMAIL_ADDRESS
server type: NO_SERVER_DATA
field signature: 2687998122
form signature: 1541123618731142864
experiment id: &quot;&quot;"><br /><br />
  <label for="Message" style="width:100px; display: inline-block"><?php echo __('Message', null, 'messages'); ?>:</label><br />
  <textarea name="Message" rows="20" cols="20" id="Message"></textarea><br />
  <input type="submit" name="submit" value="<?php echo __('Submit', null, 'messages'); ?>" class="submit-button">
</form>