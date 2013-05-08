<?php
// For Windows
//ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.str_replace("/", "\\", BASEPATH)."..\\application\\libraries\\");

// For Non-Windows
//ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.BASEPATH."../application/libraries/");

//ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.APPPATH."libraries/");
//ini_set('include_path', APPPATH . 'libraries' . ':' . ini_get('include_path'));
ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.str_replace("/", "\\", APPPATH)."libraries\\");
//ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . BASEPATH . 'libraries/');
//ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.str_replace("/", "\\", BASEPATH)."contrib\\");
//ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.BASEPATH."/contrib/");
// Zend Loader

//echo ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.str_replace('/', '\\', APPPATH.'libraries/'));
//set_include_path(get_include_path() . PATH_SEPARATOR . APPPATH . "libraries");

include_once 'Zend/Loader.php';
?>