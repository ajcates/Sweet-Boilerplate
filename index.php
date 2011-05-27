<?
//Turn on all errors.
ini_set('display_errors', 2);
ERROR_REPORTING(E_ALL);
//I set the time zone becuase I swear one day php yelled at me for not having it set, I don't know need to look into that.
date_default_timezone_set('America/Los_Angeles');
//Defineing the `LOC` varible, which is equal to the root directory. If you don't have php 5.3 it yells at you here.
define('LOC', __DIR__);
//Oh check it out, now we can use `LOC` to load stuff and use an absolute url.
require(LOC . '/sweet-framework/libs/SweetFramework.php');
//get an instance of the framework going.
$app = new SweetFramework();
//Load the app called `app` and make it the main one.
$app->loadApp('app', true)->run();
//This is static for some reason, but it ends the framework
sweetFramework::end();
