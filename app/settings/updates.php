<?
SweetFramework::getClass('lib', 'Config')->setAll('updates', array(
	'events' => array(
		'test_page' => array(
			'groups' => array('Developers'),
			'subject' => '%who% accessed the test page',
			'message' => '%who% accessed the test page',
			'drivers' => array('LameMailer')
		),
		'groupChange' => array(
			'groups' => array('GroupWatch', 'Test1'),
			'subject' => '%who% accessed the test page',
			'message' => '%who% accessed the test page',
			'drivers' => array('SMTP')
		)
	)
));