<?
ini_set('display_errors', 2);
ERROR_REPORTING(E_ALL);
date_default_timezone_set('America/Los_Angeles');
define('LOC', __DIR__);
require(LOC . '/sweet-framework/libs/SweetFramework.php');
$app = new SweetFramework();
$app->loadApp('sweet-cmd')->loadApp('app', true)->run(join('/', f_rest($_SERVER['argv'])));
SweetFramework::end();