<?
/*
CREATE TABLE `bianchi-raw-lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) DEFAULT NULL,
  `color` text,
  `partnumRt` int(11) DEFAULT NULL,
  `partnumLt` int(11) DEFAULT NULL,
  `model` tinytext,
  `description` tinytext,
  `unknownNum` int(11) DEFAULT NULL,
  `gunModel` tinytext,
  `gunMake` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2476 DEFAULT CHARSET=latin1;
*/

class BianchiRawLookup extends SweetModel {

	
	var $tableName = 'bianchiRawLookup';
	
	var $pk = 'id';
	
	var $fields = array(
		'id' => array('int', 11),
		'num' => array('int', 11),
		'color' => array('text'),
		'partnumRt' => array('int', 11),
		'partnumLt' => array('int', 11),
		'model' => array('text'),
		'description' => array('text'),
		'unknownNum' => array('int', 11),
		'gunModel' => array('text'),
		'gunMake' => array('text')
	);
	
	var $relationships = array();
	
	function __construct() {
	
	}
	
	

}