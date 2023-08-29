<?php
/*
Plugin Name: 404 if not found
Plugin URI: https://github.com/YOURLS/404-if-not-found/
Description: Send a 404 (instead of a 302) when short URL is not found
Version: 1.1
Author: Ozh
Author URI: https://yourls.org/
*/

// No direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

// 'keyword' provided ('abc' in 'http://sho.rt/abc') but not found
yourls_add_action('redirect_keyword_not_found', 'ozh_404_if_not_found');

// 'keyword+' provided but this isnt an existing stat page
yourls_add_action('infos_keyword_not_found', 'ozh_404_if_not_found');

// 'keyword' not provided: direct attempt at http://sho.rt/yourls-go.php or -infos.php
yourls_add_action('redirect_no_keyword', 'ozh_404_if_not_found');
yourls_add_action('infos_no_keyword', 'ozh_404_if_not_found');

// Display a default 404 not found page
function ozh_404_if_not_found() {
    yourls_status_header(404);
    $notfound = 'html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">'
              . '<title>404 - Datei oder Verzeichnis wurde nicht gefunden.</title>'
              . '<style type="text/css">'
              . '<!--'
              . 'body{margin:0;font-size:.7em;font-family:Verdana, Arial, Helvetica, sans-serif;background:#EEEEEE;}'
              . 'fieldset{padding:0 15px 10px 15px;} '
              . 'h1{font-size:2.4em;margin:0;color:#FFF;}'
              . 'h2{font-size:1.7em;margin:0;color:#CC0000;} '
              . 'h3{font-size:1.2em;margin:10px 0 0 0;color:#000000;} '
              . '#header{width:96%;margin:0 0 0 0;padding:6px 2% 6px 2%;font-family:"trebuchet MS", Verdana, sans-serif;color:#FFF;'
              . 'background-color:#555555;}'
              . '#content{margin:0 0 0 2%;position:relative;}'
              . '.content-container{background:#FFF;width:96%;margin-top:8px;padding:10px;position:relative;}'
              . '-->'
              . '</style>'
              . '</body>'
              . '<div id="header"><h1>Server Error</h1></div>'
              . '<div id="content">'
              . ' <div class="content-container"><fieldset>'
              . '  <h2>404 - File or directory not found.</h2>'
              . '  <h3>The resource you are looking for might have been removed, had its name changed, or is temporarily unavailable.</h3>'
              . ' </fieldset></div>'
              . '</div>'
              . '</body></html>';
    die($notfound);
}

/**
 * if you want to display a custom 404 page instead, replace the above function with
 * the following :
 * 
 * function ozh_404_if_not_found() {
 *     yourls_status_header(404);
 *     include_once('/full/path/to/your/404.html'); // full path to your error document
 *     die();
 * }
 * 
 */
