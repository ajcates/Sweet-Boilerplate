<?php
SweetFramework::getClass('lib', 'Config')->setAll('site', array(
	'name' => 'Sweet-Boilerplate',
	'tagline' => 'It\'s like a copy of God you can clone.',
	'prettyUrls' => false,
	'database' => 'default',
  'autoload' => array(), //Provide libraries you would like to autoload here 
	//'autoload' => array('SweetModel'),
	'theme' => 'default',
	'mainController' => 'Main',
	'salt' => '8b350e497==RANDOM CRAP IS THE SALT==dc21c3017a8ff'
));
