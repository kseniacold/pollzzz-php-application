<?php
 
/**
 *  config.php will be included to every page of the website
 *  contains configuration information about the application
 */
 
$config = array(
    "paths" => array(
        "resources" => "/resources"
    ),
    "db" => array(
      	"host"     => "localhost",
        "user"     => "test",
        "password" => "pass",
        "dbname"   => "pollzzz"
    )
);

/**
    Creating constants for heavily used paths makes things a lot easier.
    ex. require_once(TEMPLATE_PATH . "header.php")
*/

defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library')); // concatinate the directory of current included file (__FILE__)
     
defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));
 
?>