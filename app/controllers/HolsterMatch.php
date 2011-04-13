<?

class HolsterMatch extends App {

	static $urlPattern = array(
		'/(\d*)/' => 'index'
	);

	function __construct() {
		$this->lib(array('Template', 'Uri', 'Config'));
		$this->model(array('BianchiRawLookup', 'BianchiGuns', 'Guns', 'BianchiOriginalGuns', 'GunMakeTranslate', 'MasterHolsters'));
		
		$this->libs->Template->set(array(
			'siteName' => $this->libs->Config->get('site', 'name'),
			'siteTagline' => $this->libs->Config->get('site', 'tagline'),
			'navLocation' => ''
		));
	}

	function index() {
		//D::log($this->models->User->loggedIn(), 'is logged in');
		//$holsterId = (int)$this->libs->Uri->get(0);
		$hId = (int)$this->libs->Uri->get(0) + 1;
		$holster = $this->models->MasterHolsters->find($hId)->one();
		
		if(empty($holster)) {
			return $this->libs->Template->set(array(
				'title' => 'No Holster found',
				'content' => 'that sucks'
			))->render('bases/default');
		}
		
		//D::show($holster);
		//$this->models->BianchiRawLookup->libs->Query->resluts('SELECT DISTINCT(')
		$refGuns = $this->models->BianchiRawLookup->find(array('model' => 'Model ' . $holster->Code))->sort(array('gunMake' => 'ASC', 'gunModel' => 'ASC'))->all();
		
		
		return $this->libs->Template->set(array(
			'title' => 'Holster Matchr',
			'bodyClass' => 'holsterMatch',
			'content' => T::get('parts/holsterMatch', array(
				'holster' => $holster,
				'nextLink' => SITE_URL . 'holster-match/' . ($hId+1),
				'prevLink' => SITE_URL . 'holster-match/' . ($hId-2),
				'guns' => $this->models->Guns->all(),
				'refGuns' => $refGuns
			))
		))->render('bases/default');
	}
	
	
	
	function __DudeWheresMyCar() {
		header('HTTP/1.0 404 Not Found');
		
		return $this->libs->Template->set(array(
			'title' => '404 Error',
			'content' => T::get('parts/common/404')
		))->render('bases/default');
	}
}
