<?
/*
CREATE TABLE `gunMakeTranslate` (
  `id` int(11) DEFAULT NULL,
  `bMake` text,
  `orgMake` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/

class GunMakeTranslate extends SweetModel {

	
	var $tableName = 'gunMakeTranslate';
	
	var $pk = 'id';
	
	var $fields = array(
		'id' => array('int', 11),
		'bMake' => array('int', 11),
		'orgMake' => array('int', 11),
		'score' => array('int', 11)
	);
	
	var $relationships = array(
		'rawId' => array('BianchiRawLookup', 'id'),
		'bMake' => array('BianchiGuns', 'id'),
		'orgMake' => array('Guns', 'id')
		
	);
	
	function __construct() {
	
	}

	

}