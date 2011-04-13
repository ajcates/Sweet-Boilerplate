
<?
class MasterHolsters extends SweetModel {
	
	var $tableName = 'master_holsters';
	var $pk = 'id';
	
	var $fields = array(
		'id' => array('int', '11'),
		'ProductID' => array('int', '11'),
		'UserID' => array('int', '11'),
		'AvailableForSales' => array('int', '11'),
		'Approved' => array('int', '11'),
		'Code' => array('varchar', '255'),
		'BDescription' => array('varchar', '255'),
		'BUrl' => array('varchar', '255'),
		'MyDescription' => array('blob'),
		'ProductName' => array('varchar', '255'),
		'FriendlyURL' => array('varchar', '255'),
		'ProductOrder' => array('int', '11'),
		'ProductType' => array('int', '11'),
		'ColorFinish' => array('varchar', '255'),
		'Hand' => array('varchar', '255'),
		'Category' => array('varchar', '255'),
		'ManufacturerID' => array('int', '11'),
		'ManufacturerCode' => array('varchar', '255'),
		'ManufacturerName' => array('varchar', '255'),
		'Price' => array('varchar', '255'),
		'DiscountPrice' => array('varchar', '255'),
		'TradePrice' => array('varchar', '255'),
		'BuyingPrice' => array('varchar', '255'),
		'FullDescriptionType' => array('varchar', '255'),
		'FullDescription' => array('blob'),
		'PageTitle' => array('varchar', '255'),
		'MetaKeywords' => array('varchar', '255'),
		'MetaDescription' => array('varchar', '255'),
		'TinyImage' => array('varchar', '255'),
		'TinyImageAlt' => array('varchar', '255'),
		'SmallImage' => array('varchar', '255'),
		'SmallImageAlt' => array('varchar', '255'),
		'LargeImage' => array('varchar', '255'),
		'LargeImageAlt' => array('varchar', '255'),
		'SuperSizedImage' => array('varchar', '255'),
		'CustomTemplate' => array('varchar', '255'),
		'ProductPreviewURL' => array('varchar', '255'),
		'UseStockLevel' => array('int', '11'),
		'HideOffWhenTheProductIsOutOfStock' => array('int', '11'),
		'DisableOffLimitsProducts' => array('int', '11'),
		'InStockAvailability' => array('int', '11'),
		'OutOfStockAvailability' => array('int', '11'),
		'FreeShipping' => array('int', '11'),
		'GoogleBaseProductType' => array('varchar', '255'),
	);
	
	var $relationships = array(
		'guns' => array(
			'id' => array('GunItems', 'holster_id')
		)
	);
	
	function __construct() {
		
	}
	
	
}
