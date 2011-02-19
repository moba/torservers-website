<?php

if (!defined('H6E_CSS')) {
  if (file_exists(dirname(__FILE__) . '/h6e-minimal')) {
    define('H6E_CSS', DOKU_URL . 'lib/tpl/minimal');
  } else {
    define('H6E_CSS', 'http://h6e.net/css');
  }
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>" lang="<?php echo $conf['lang']?>" dir="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo hsc($lang['mediaselect']) ?> - <?php echo strip_tags($conf['title']) ?></title>
  
  <link rel="stylesheet" media="screen" href="<?php echo H6E_CSS ?>/h6e-minimal/h6e-minimal.css" />

  <?php tpl_metaheaders()?>

  <style type="text/css">
  .h6e-main-content {
      width:<?php echo tpl_getConf('width') ?>;
      padding-left:2.5em;
      padding-right:2.5em;
  }
  .h6e-post-content {
      font-size:<?php echo tpl_getConf('font-size') ?>;
  }
  .h6e-entry-title, .h6e-entry-title a, .h6e-entry-title a:visited, .do-page h1, .content-page h2 {
      color:<?php echo tpl_getConf('title-color') ?>;
  }
  </style>
</head>

<body>
<div id="media__manager" class="dokuwiki h6e-main-content">

    <div id="media__left">

        <?php html_msgarea()?>

        <h2 class="h6e-entry-title"><?php echo hsc($lang['mediaselect'])?></h2>

        <?php /* keep the id! additional elements are inserted via JS here */?>
        <div id="media__opts"></div>

        <?php tpl_mediaTree() ?>

    </div>

    <div id="media__right">
        <?php tpl_mediaContent() ?>
    </div>

</div>
</body>
</html>
