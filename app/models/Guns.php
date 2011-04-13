<?
/*
CREATE TABLE `guns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `model` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `bbl` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=512 DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 190464 kB';
*/
class Guns extends SweetModel {
	
	
	var $tableName = 'guns';
	
	var $pk = 'id';
	
	var $fields = array(
		'id' => array('int', 11),
		'manufacturer' => array('varchar', 45),
		'model' => array('varchar', 45),
		'bbl' => array('varchar', 15)
	);
	
	var $relationships = array(
		'holsters' => array(
			'id' => array('GunItems', 'gun_id')
		),
		'bguns' => array(
			'id' => array('bGunsGuns', 'gun')
		)
	);
	
	function __construct() {
		$this->lib('Databases/Query');
	}
	
	function manufacturers() {
		return $this->libs->Query->select(array(
			'DISTINCT' => array('guns.manufacturer')
		))->from('guns')->results();
	}
	
	function models($manufacturer) {
		return $this->libs->Query->select(array(
			'DISTINCT' => array('guns.model')
		))->where(array('guns.manufacturer' => urldecode($manufacturer)))->from('guns')->results();
	}
	
	
}







/*
                                   ___   __
   *    _______        *       ___/   \_/  \__      *
       / o  o  \              /               \
      [ o     o ]              \__    __     __/
    * {    o    }                 \__/  \___/
       \_o___o_/        *
                                        *
                                         *
                  * 
   ____        ____                             ____
  /    \      /    \                           /    \
 [  -- ]     [ --- ]                          [  -- ]
 [  -- ]     [  -- ]     CODE GRAVE YARD!!!   [ --- ]
_[     ]_V___[     ]____V_________V___________[     ]_________V___
 |     | .   |     |  ,    ,   V     .     .  |     |        .
 V           .    V                    .     .            '
       V               .    V                 V      .          

*/