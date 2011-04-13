<?

class scrapr extends App {

	var $doc;
	
	function __construct() {
		//$this->lib('phpQuery');
		SweetFramework::loadFileType('lib', 'phpQuery');
		$this->doc = phpQuery::newDocument();
		
	}
	
	function loadUrl($url, $data=null) {
		///@todo implement $data
		
		
		$this->doc = phpQuery::newDocument(file_get_contents($url), 'text/html');
		return $this;
	}
	
	function getDoc() {
		return $this->doc;
	}

}