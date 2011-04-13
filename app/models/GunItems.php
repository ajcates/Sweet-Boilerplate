
<?
class GunItems extends SweetModel {
	
	var $tableName = 'gun_items';
	var $pk = 'id';
	
	var $fields = array(
		'id' => array('int', '11'),
		'holster_id' => array('int', '11'),
		'gun_id' => array('int', '11'),
		'light_id' => array('int', '11'),
	);
	
	var $relationships = array(
		'gun_id' => array('Guns', 'id'),
		'holster_id' => array('MasterHolsters', 'id'),
	);
	
	function __construct() {
		
	}
	
	
}
