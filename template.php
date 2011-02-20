<?php
 if (!isset($base)) $base = "";
 global $base;
 
 $navbar = <<<EOD
<div class="navbar" role="navigation">
 <ul>
  <li><a href="$base/about.html">About</a></li> 
  <li><a href="$base/services.html">Services</a></li> 
  <li><a href="$base/wiki/">Wiki</a></li>
  <li><a href="$base/donate.html">Donate</a></li> 
  <li><a href="$base/contact.html">Contact</a></li>
  <li><a href="$base/abuse.html">Abuse</a></li>
 </ul>
 <a href="$base/" class="home">torservers.net</a>
</div>

EOD;

 function printHeader($title) {
  global $navbar, $base;
  
  $header = <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
 <title>$title</title>
 <meta name="Author" content="torservers.net"/>
 <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
 <link rel="stylesheet" type="text/css" href="$base/style.css"/>
 <link rel="stylesheet" type="text/css" href="$base/print.css" media="print"/>
 <link rel="shortcut icon" type="image/x-icon" href="$base/favicon.ico"/>
 <link rel="alternate" href="http://twitter.com/statuses/user_timeline/147903457.rss" title="torservers's Tweets" type="application/rss+xml" />
 <meta name="description" content="Managed Tor hosting solutions. Exit node sponsorship, private Tor bridges, hidden services hosting." />
 <meta name="keywords" content="tor, i2p, privacy, hosting, hidden services, eepsite, censorship, exit nodes, bridge, circumvention" />
</head>
<body>

EOD;
  echo $header;
  echo "<div id=\"container\">\n";
  echo "<div id=\"content\">\n";
  echo $navbar;
  
  echo "<div id=\"body\" role=\"main\">\n";
 }
 
 function printFooter() {
  global $navbar, $base;

  echo "</div>\n";
  echo $navbar;  
  echo "</div>\n"; // content div

  $footer = <<<EOD
<p id="footer">
 <a href="http://www.twitter.com/torservers"><img src="$base/images/twitter-small.png" alt="Follow torservers on Twitter"/></a>
 <a href="http://flattr.com/thing/5649/Torservers-net-Fund-Tor-exit-node-bandwidth"><img src="$base/images/flattr-small.png" alt="Flattr torservers.net"/></a>
</p>
<p class="fineprint">
 torservers.net is not affiliated with the Tor project. "Tor" and the "Onion Logo" are registered trademarks of The Tor Project, Inc.
 <br/>Icons under Creative Commons by <a href="http://picol.org/icon_library.php">pictol.org</a>. <a href="$base/privacypolicy.html">Privacy Policy</a>.
</p>

EOD;
  
  echo $footer;
  
  echo "</div>"; // container div
 }
 
?>