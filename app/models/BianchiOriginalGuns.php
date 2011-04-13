<?
/*
CREATE TABLE `bianchiOrginalGuns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bianchiGun` int(11) DEFAULT NULL,
  `orgGun` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bianchiGun` (`bianchiGun`),
  KEY `orgGun` (`orgGun`),
  CONSTRAINT `bianchiorginalguns_ibfk_2` FOREIGN KEY (`orgGun`) REFERENCES `guns` (`id`),
  CONSTRAINT `bianchiorginalguns_ibfk_1` FOREIGN KEY (`bianchiGun`) REFERENCES `bianchiGuns` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/

class BianchiOriginalGuns extends SweetModel {

	
	var $tableName = 'bianchiOriginalGuns';
	
	var $pk = 'id';
	
	var $fields = array(
		'id' => array('int', 11),
		'orgGun' => array('int', 11),
		'bianchiGun' => array('int', 11),
	);
	
	var $relationships = array(
		'bianchiGun' => array('BianchiGuns', 'id'),
		'orgGun' => array('Guns', 'id')
	);
	
	function __construct() {
	
	}
}