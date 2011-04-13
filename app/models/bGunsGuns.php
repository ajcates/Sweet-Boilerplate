<?
class bGunsGuns extends SweetModel {
	
	var $tableName = 'bguns_guns';
	var $pk = 'id';
	
	var $fields = array(
		'id' => array('int', '11'),
		'bgun' => array('int', '11'),
		'gun' => array('int', '11'),
	);
	
	var $relationships = array(
		'gun' => array('Guns', 'id'),
		'bgun' => array('BianchiGuns', 'id'),	
	);
	
	function __construct() {
		
	}
	
	
}
