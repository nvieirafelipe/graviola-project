<div class="sfTMessageContainer sfTAlert"> 
  <?php echo image_tag('/images/error404/error-icon1.png', array('alt' => 'page not found', 'class' => 'sfTMessageIcon', 'size' => '58x58')) ?>
  <div class="sfTMessageWrap">
    <h2>Error 404</h2>
    <h3>Sorry. The page was not found.</h3>
  </div>
</div>

<br>

<dl class="sfTMessageInfo">
  <dd>You may have typed the address (URL) incorrectly. Check it to make sure you've got the exact right spelling, capitalization, etc.</dd>

  <dd>If you reached this page from another part of this site, please email us at <?php echo mail_to('contact@nojam.com') ?> so we can correct our mistake.</dd>
</dl>

<dl class="sfTMessageInfo">
    <div class="sfTLinkMessage">
      <a href="javascript:history.go(-1)" class="link small">
        <?php echo image_tag('/images/error404/arrow-back.png', array('alt' => 'arrow back', 'class' => 'sfTMessageIcon', 'size' => '38x38')) ?>
        <dt>Try going back to previous page</dt>
      </a>
    </div>

    <div class="sfTLinkMessage">
      <a href="<?php echo url_for('homepage'); ?>" class="link small">
        <?php echo image_tag('/images/error404/home-88.png', array('alt' => 'go to home', 'class' => 'sfTMessageIcon', 'size' => '38x38')) ?>
        <dt>Go to Homepage</dt>
      </a>
    </div>
</dl>


