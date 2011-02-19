<?php
/**
* Plugin HighlightJs: Plugin providing highlight.js version 5.71.
*
* @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
* @author     Clément Chartier <clement@studiorvb.com>
*/

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_INC . 'inc/parser/xhtml.php';

class renderer_plugin_highlightjs extends Doku_Renderer_xhtml {

    function getInfo(){
        return confToHash(dirname(__FILE__).'/INFO.txt');
    }

    function canRender($format) {
      return ($format=='xhtml');
    }
    function reset() {
       $this->doc = '';
       $this->footnotes = array();
       $this->lastsec = 0;
       $this->store = '';
       $this->_counter = array();
    }

    function preformatted($text) {
        $this->doc .= '<pre><code>' . $this->_xmlEntities($text) . '</code></pre>'. DOKU_LF;
    }

}
?>