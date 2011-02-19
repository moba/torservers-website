<?php

if (!defined('DOKU_INC')) die();

if (!defined('H6E_CSS')) {
  if (file_exists(dirname(__FILE__) . '/h6e-minimal')) {
    define('H6E_CSS', DOKU_URL . 'lib/tpl/minimal');
  } else {
    define('H6E_CSS', 'http://h6e.net/css');
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG)) ?> - <?php echo strip_tags($conf['title']) ?></title>
  
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

<div class="dokuwiki">

  <?php include dirname(__FILE__) . '/top.php' ?>

  <div class="content-page h6e-main-content">

    <?php if($ERROR){ print $ERROR; } else { ?>

    <h2 class="h6e-entry-title"><?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG))?></h2>

    <div class="img_big">
      <?php tpl_img(900,700) ?>
    </div>

    <div class="img_detail">
      <p class="img_caption">
        <?php print nl2br(hsc(tpl_img_getTag(array('IPTC.Caption',
                                               'EXIF.UserComment',
                                               'EXIF.TIFFImageDescription',
                                               'EXIF.TIFFUserComment')))); ?>
      </p>

      <p>&larr; <?php echo $lang['img_backto']?> <?php tpl_pagelink($ID)?></p>

      <dl class="img_tags">
        <?php
          $t = tpl_img_getTag('Date.EarliestTime');
          if($t) print '<dt>'.$lang['img_date'].':</dt><dd>'.strftime($conf['dformat'],$t).'</dd>';

          $t = tpl_img_getTag('File.Name');
          if($t) print '<dt>'.$lang['img_fname'].':</dt><dd>'.hsc($t).'</dd>';

          $t = tpl_img_getTag(array('Iptc.Byline','Exif.TIFFArtist','Exif.Artist','Iptc.Credit'));
          if($t) print '<dt>'.$lang['img_artist'].':</dt><dd>'.hsc($t).'</dd>';

          $t = tpl_img_getTag(array('Iptc.CopyrightNotice','Exif.TIFFCopyright','Exif.Copyright'));
          if($t) print '<dt>'.$lang['img_copyr'].':</dt><dd>'.hsc($t).'</dd>';

          $t = tpl_img_getTag('File.Format');
          if($t) print '<dt>'.$lang['img_format'].':</dt><dd>'.hsc($t).'</dd>';

          $t = tpl_img_getTag('File.NiceSize');
          if($t) print '<dt>'.$lang['img_fsize'].':</dt><dd>'.hsc($t).'</dd>';

          $t = tpl_img_getTag('Simple.Camera');
          if($t) print '<dt>'.$lang['img_camera'].':</dt><dd>'.hsc($t).'</dd>';

          $t = tpl_img_getTag(array('IPTC.Keywords','IPTC.Category'));
          if($t) print '<dt>'.$lang['img_keywords'].':</dt><dd>'.hsc($t).'</dd>';

        ?>
      </dl>
      <?php //Comment in for Debug// dbg(tpl_img_getTag('Simple.Raw'));?>
    </div>

  <?php } ?>
  </div>
</div>
</body>
</html>

