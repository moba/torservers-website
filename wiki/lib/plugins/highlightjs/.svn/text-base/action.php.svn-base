<?php
/**
* Plugin HighlightJs: Plugin providing highlight.js version 5.71.
*
* @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
* @author     Clément Chartier <clement@studiorvb.com>
*/

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once(DOKU_PLUGIN.'action.php');

class action_plugin_highlightjs extends DokuWiki_Action_Plugin {

    /**
     * return some info
     */
    function getInfo(){
        return confToHash(dirname(__FILE__).'/INFO.txt');
    }

    /*
     * plugin should use this method to register its handlers with the dokuwiki's event controller
     */
    function register(&$controller) {
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'insert_code_button', array ());
        $controller->register_hook('TPL_CONTENT_DISPLAY', 'AFTER', $this, 'init_highlight');
    }


    /*
     * Add Toolbar icon
     */
    function insert_code_button(& $event, $param) {
        $event->data[] = array (
            'type' => 'format',
            'title' => $this->getLang('toolbar_code'),
            'icon' => DOKU_BASE . 'lib/plugins/highlightjs/images/page_white_code.png',
            'open' => '<code>',
            'close' => '</code>',
        );
    }

    /*
     * Add Js & Css after template is displayed
     */
    function init_highlight(&$event) {
       global $ACT;
       echo "<script language='javascript' src='".DOKU_BASE."lib/plugins/highlightjs/highlight/highlight.pack.js'></script>\n";
       echo "<link rel='stylesheet' title='Default' href='".DOKU_BASE."lib/plugins/highlightjs/highlight/styles/".$this->getConf('highlight_skin').".css' />\n";
       echo "<script language='javascript'>;\n";
       echo  "hljs.initHighlightingOnLoad();\n</script>\n";
    }

}