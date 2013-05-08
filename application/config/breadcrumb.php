<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* ------------------------
* Config: set home
* ------------------------
* Default value:
* $config['set_home'] = "Home";
*
* Change initial breadcrumb link
*/
$config['set_home'] = "Home";

/*
* ------------------------
* Config: Delimiter
* ------------------------
* Default value:
* $config['delimiter'] = ' > ';
*/
$config['delimiter'] = " ";

/*
 * --------------------------
 * Config: Replacer
 * --------------------------
 * Default value:
 * $config['replacer'] = array();
 *
 * Can either change controller name to the proper name for link label or hide it
 * Example:
 * Suppose we have module name: warehouse, controller name: stocks and method name: search_direct
 * So, if we want to call search_direct, we should type :
 * "http://localhost/arstock/warehouse/stocks/search_direct" in url address. From this URL,
 * Breadcrumb helper will produce: Home > Warehouse > Stocks > Search_direct. Noticed that the last link
 * is not a common link name. This is where Replacer can be very useful to change link name into anything we like.
 * Set the Replacer:
 * $replacer = array('search_direct' => 'edit')
 * Above line will change the breadcrumb into: Home > Warehouse > Stocks > Edit.
 * What if we need to hide Warehouse link from breadcrumb ? Just add the Replacer into:
 * $replacer = array('search_direct' => 'edit', 'warehouse' => '')
 * This will change breadcrumb into: Home > Stocks > Edit
 */
$config['replacer'] = array('dept' => 'departemen', 'stockmoving' => 'pergerakan stok', 'view' => '');

/**
 * --------------------------
 * Config: Exclude
 * --------------------------
 * Default value:
 * $config['exclude'] = array('');
 *
 * Can hide links that written in array
 * Example:
 * If we set $config['exclude'] = array('stocks', 'warehouse') then from this URL "http://localhost/arstock/warehouse/stocks/insert"
 * we get breadcrumb: Home > Insert
 */
$config['exclude'] = array('in', 'insert');

/**
 * ------------------------------------
 * Config: Exclude Segment
 * ------------------------------------
 * Default value:
 * $config['exclude_segment'] = array();
 *
 * Can hide segments
 * Example:
 * Look at this example URL:
 * http://mysite.com/en/search/results
 * http://mysite.com/fr/search/results
 * If we set $config['exclude'] = array(1) then everything in segment 1 which are 'en' & 'fr' will be hide. We get breadcrumb:
 * Home > Search > Results
 */
$config['exclude_segment'] = array();

/**
 * --------------------------
 * Config: Wrapper
 * --------------------------
 * Default value:
 * $config['use_wrapper'] = FALSE;
 * $config['wrapper'] = '<ul>|</ul>';
 * $config['wrapper_inline'] = '<li>|</li>';
 *
 * We set this if we want to make breadcrumb have it's own style.
 * it possible to return the breadcrumb in a list (<ul><li></li></ul>) or something else as configure below.
 * Set use_wrapper to TRUE to use this feature.
 */
$config['use_wrapper'] = TRUE;
$config['wrapper'] = '<ul id="crumbs" style="list-style-type:none;padding:0px 0px 0px 5px;margin:0;">|</ul>';
$config['wrapper_inline'] = '<li style="list-style-type:none;padding:0px 0px 0px 5px;margin:0;display:inline;">|</li>';

/**
 * ---------------------
 * Config: Unlink
 * ---------------------
 * Default value:
 * $config['unlink_last_segment'] = FALSE;
 *
 * If set to TRUE then the last segment in breadcrumb will not have a link.
 */
$config['unlink_last_segment'] = FALSE;

/**
 * ---------------------
 * Config: Hide number
 * ---------------------
 * Default value:
 * $config['hide_number'] = TRUE;
 *
 * If set to TRUE then any number without a word in a segment will be hide.
 * Example: http://mysite.com/blog/2009/08/7-habbits/
 * will have breadcrumbs: Home > Blog > 7 Habbits
 * Otherwise if set to FALSE it will produce: Home > Blog > 2009 > 08 > 7 Habbits
 * Notes: If the last segment is a number then it always shown whether this config
 * set to TRUE or FALSE
 */
$config['hide_number'] = TRUE;

/**
 * -------------------------
 * Config: Strip characters
 * -------------------------
 * Default value:
 * $config['strip_characters'] =  array ('_', '-', '.html', '.php', '.htm');
 *
 * All characters in the array will be stripped from breadcrumbs
 * Example: http://mysite.com/blog/7-habbits/request.html
 * will have breadcrumbs: Home > Blog > 7 Habbits > Request
 */
$config['strip_characters'] = array ('_', '-', '.html', '.php', '.htm');

/**
 * ------------------------------------
 * Config: Strip by Regular Expression
 * ------------------------------------
 * Default value:
 * $config['strip_regexp'] =  array ();
 *
 * All regular expression in the array will be stripped from breadcrumbs
 * Example: http://mysite.com/blog/7-habbits/request-300.html
 * set config to: $config['strip_regexp'] =  array ('/-[0-9]+.html/');
 * then we will have breadcrumbs: Home > Blog > 7 Habbits > Request
 */
$config['strip_regexp'] = array ('/-[0-9]+.html/');

/* End of file breadcrumb.php */
/* Location: ./system/application/config/breadcrumb.php */