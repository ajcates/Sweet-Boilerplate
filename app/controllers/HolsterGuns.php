<?

class HolsterGuns extends App {

	static $urlPattern = array(
		'/(\d*)/' => 'index'
	);

	function __construct() {
		$this->lib(array('Template', 'Uri', 'Config'));
		$this->model(array(
			'BianchiRawLookup',
			'BianchiBusterLookup',
			'BianchiGuns',
			'BianchiOriginalGuns',
			'GunMakeTranslate',
			'Guns',
			'MasterHolsters',
			'bGunsGuns'
		));
		
		$this->libs->Template->set(array(
			'siteName' => $this->libs->Config->get('site', 'name'),
			'siteTagline' => $this->libs->Config->get('site', 'tagline'),
			'navLocation' => ''
		));
	}

	function index() {
		//D::log($this->models->User->loggedIn(), 'is logged in');
		//$holsterId = (int)$this->libs->Uri->get(0);

		$bgId = (int)$this->libs->Uri->get(0) + 1;
		
		
		//$bGun
		
		//D::show($bGun->export(), 'expat');
		
		
		//D::show($bGunGuns, 'bGuns');
		$bGun = $this->models->BianchiGuns->find($bgId)->pull(array('guns'))->one();
		
		if(empty($bGun)) {
			return $this->libs->Template->set(array(
				'title' => 'No Gun found',
				'content' => 'that sucks'
			))->render('bases/default');
		}
		//D::show($_POST, 'post guns');
		
		if(!empty($_POST['guns'])) {
			//D::show($_POST, 'post data');
			$this->models->bGunsGuns->find(array('bgun' => $bgId))->delete();
			foreach(f_rest($_POST['guns']) as $gId) {
				//if()
				$this->models->bGunsGuns->create(array('bgun' => $bgId, 'gun' => $gId));
			}
			$bGun = $this->models->BianchiGuns->find($bgId)->pull(array('guns'))->one();
			$updated = 'updated.';
		} else {
			$updated = '';
		}
		
		$bGunGuns = array_map(function($gun) {
			return $gun->gun;
		}, $bGun->guns);
		
		
		//D::show($holster);
		//$this->models->BianchiRawLookup->libs->Query->resluts('SELECT DISTINCT(')
		//$refGuns = $this->models->BianchiRawLookup->find(array('model' => 'Model ' . $holster->Code))->sort(array('gunMake' => 'ASC', 'gunModel' => 'ASC'))->all();
		
		return $this->libs->Template->set(array(
			'title' => 'Holster Matchr',
			'bodyClass' => 'gunMatch',
			'content' => T::get('parts/gunMatch', array(
				'bGun' => $bGun,
				'nextLink' => SITE_URL . 'holster-guns/' . ($bgId+1),
				'prevLink' => SITE_URL . 'holster-guns/' . ($bgId-2),
				'guns' => $this->models->Guns->where(array('manufacturer' => '%' . $bGun->make . '%', 'LIKE'))->sort(array('manufacturer' => 'ASC', 'model' => 'ASC'))->all(),
				'selectedGuns' => $bGunGuns,
				'updated' => $updated
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
