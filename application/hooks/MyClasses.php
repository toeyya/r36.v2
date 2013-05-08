<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MyClasses
{
/**
* includes the directory application\my_classes\ in your includes directory
*
*/
function index()
{
//includes the directory application\my_classes\
//for windows tests change the ':' before BASEPATH to ';'
ini_set('include_path',ini_get('include_path').':'.BASEPATH.'application/my_classes/');
}
}

?>