<?php

if (!defined('DOKU_INC')) die();

if (!defined('H6E_CSS')) {
  if (file_exists(dirname(__FILE__) . '/h6e-minimal')) {
    define('H6E_CSS', DOKU_URL . 'lib/tpl/torservers');
  } 
}

if (empty($_REQUEST['do']) || in_array($_REQUEST['do'], array('revisions', 'show', 'edit'))) {
    $page_type = 'content-page';
} else {
    $page_type = 'do-page';
}

include(dirname(__FILE__) . "/../../../../template.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php tpl_pagetitle() ?> - <?php echo strip_tags($conf['title']) ?></title>

 <link rel="stylesheet" href="<?php echo H6E_CSS ?>/h6e-minimal/h6e-minimal.css" />
 <link rel="stylesheet" href="<?php echo H6E_CSS ?>/print.css" media="print" />
 <link rel="stylesheet" type="text/css" href="/style.css"/>
 <link rel="stylesheet" type="text/css" href="/print.css" media="print"/>

  <?php tpl_metaheaders() ?>
  
  <style type="text/css">
  <?php if (tpl_getConf('width') != 'auto') : ?>
  .h6e-main-content {
      width:<?php echo tpl_getConf('width') ?>;
      padding-left:2.5em;
      padding-right:2.5em;
  }
  <?php endif ?>
  .h6e-post-content {
      font-size:<?php echo tpl_getConf('font-size') ?>;
  }
  .h6e-entry-title, .h6e-entry-title a, .h6e-entry-title a:visited, .do-page h1, .content-page h2 {
      color:<?php echo tpl_getConf('title-color') ?>;
  }
  </style>

</head>

<body>
<div id="container">
<div id="content">
<?php echo $navbar; /* imported from template.php */ ?>
<div id="body" role="main">

<div class="dokuwiki">

  <?php include dirname(__FILE__) . '/top.php' ?>

  <div class="<?php echo $page_type ?> h6e-main-content">

    <?php if($conf['breadcrumbs']){?>
    <div class="breadcrumbs">
      <?php tpl_breadcrumbs() ?>
    </div>
    <?php }?>

    <?php if($conf['youarehere']){?>
    <div class="breadcrumbs">
      <?php tpl_youarehere() ?>
    </div>
    <?php }?>

    <?php if (!tpl_getConf('hide-entry-title')){?>
        <h2 class="h6e-entry-title">
        <?php tpl_pagetitle($ID) ?>
        </h2>
    <?php }?>

    <div id="wikipage" class="h6e-post-content">
        <?php tpl_content()?>
    </div>

    <div class="pageinfo">
        <?php tpl_pageinfo()?>
    </div>

    <div class="actions actions-page">
        <?php tpl_button('edit')?>
        <?php tpl_button('history')?>
        <?php tpl_button('revert')?>
        <?php tpl_button('backlink')?>
    </div>

    <div class="h6e-simple-footer">

      <div class="actions actions-site">
          <div class="a">
              <?php tpl_button('recent')?>
              <?php tpl_button('index')?>
          </div>
          <div class="b">
              <?php tpl_searchform() ?>
          </div>
      </div>

    </div>

  </div>

</div>
<?php printFooter()  /* imported from template.php */ ?>
</div>

<div class="no"><?php /* provide DokuWiki housekeeping, required in all templates */ tpl_indexerWebBug()?></div>

</body>
</html>
