<?
/*
CREATE TABLE `bianchi-guns` (
  `id` int(11) DEFAULT NULL,
  `make` text,
  `model` text,
  `rawId` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
*/

class BianchiGuns extends SweetModel {

	
	var $tableName = 'bianchiGuns';
	
	var $pk = 'id';
	
	var $fields = array(
		'id' => array('int', 11),
		'model' => array('text'),
		'make' => array('text'),
		'rawId' => array('int', 11)		
	);
	
	var $relationships = array(
		'rawId' => array('BianchiRawLookup', 'id'),
		
		'orgGuns' => array(
			'id' => array('GunMakeTranslate', 'bMake')
		),
		'guns' => array(
			'id' => array('bGunsGuns', 'bgun')
		)
	);
	
	function __construct() {
	
	}
	
	

}