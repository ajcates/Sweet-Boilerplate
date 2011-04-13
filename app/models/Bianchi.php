<?
class Bianchi extends SweetModel {

	
	
	function __construct()	 {
		$this->lib('scrapr');
	}
	
	function getProductInfo($id) {
		//$pageId = $this->libs->Uri->getPart(1);
		$doc = $this->libs->scrapr->loadUrl('http://www.bianchi-intl.com/product/Prod.php?TxtModelID=' . $id)->getDoc();
		
		return $doc->find('p.body');
	}
	
	
	
	
	
}