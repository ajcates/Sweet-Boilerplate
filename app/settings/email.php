<?
SweetFramework::getClass('lib', 'Config')->setAll('email', array(
	'smtp' => array(
		'protocol' => 'sendmail',
		'smtp_host' => 'tls://smtp.gmail.com',
		'smtp_user' => 'aj@websiteninjas.com',
		'smtp_pass' => 'dworkram',
		'smtp_port' => '587',
		'smtp_timeout' => 30,
		'crlf' => '\r\n',
		'newline' => '\r\n',
		'mailtype' => 'text',
		'useragent' => 'The CRAD-DB',
		'charset' => 'iso-8859-1'
	),
	'postmark' => array(
		'api_key' => 'bff04de6-317e-45ad-a760-189cc8385176',
		'strip_html' => true,
		'validation' => false,
		'from_address' => 'aj@ajcates.com',
		'from_name' => 'A.J. Cates',
	),
	'failMail' => array(
		'host' => 'smtp.gmail.com',
		'port' => '465',
		'username' => 'crad@cobragolf.com',
		'password' => '@crad4653',
		'from' => 'crad@cobragolf.com',
		'fromName' => 'The CRAD-DB'
	)
));