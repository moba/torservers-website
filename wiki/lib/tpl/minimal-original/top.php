<?php html_msgarea() ?>

<?php
if (tpl_getConf('topbar') == 'never') {
    $top_bar = false;
} else if (tpl_getConf('topbar') == 'connected' && empty($_SERVER['REMOTE_USER'])) {
    $top_bar = false;
} else {
    $top_bar = true;
}
?>

<?php if (class_exists('Ld_Ui') && method_exists('Ld_Ui', 'top_bar') && $top_bar) : ?>
    <?php
    $loginUrl = Ld_Ui::getAdminUrl(array(
        'module' => 'default', 'controller' => 'auth', 'action' => 'login',
    ));
    if (empty($loginUrl)) {
        $loginUrl = wl($ID,'do=login&amp;sectok='.getSecurityToken());
    }
    if (empty($logoutUrl)) {
        $logoutUrl = wl($ID,'do=logout&amp;sectok='.getSecurityToken());
    }
    ?>
    <?php Ld_Ui::top_bar(array('loginUrl' => $loginUrl, 'logoutUrl' => $logoutUrl)); ?>
<?php else : ?>
  <div class="user-info">
      <?php tpl_userinfo()?>
      <?php tpl_actionlink('subscription') ?>
      <?php tpl_actionlink('profile') ?>
      <?php tpl_actionlink('admin') ?>
      <?php tpl_actionlink('login'); ?>
  </div>
<?php endif ?>
