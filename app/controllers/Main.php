<?php

class Main extends App {

	static $urlPattern = array(
		'/scrapr\/?(.*)/' => array('Scrappr'),
		'/holster\-match\/?(.*)/' => array('HolsterMatch'),
		'/holster\-guns\/?(.*)/' => array('HolsterGuns'),
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
			'MasterHolsters'
		));
		
		$this->libs->Template->set(array(
			'siteName' => $this->libs->Config->get('site', 'name'),
			'siteTagline' => $this->libs->Config->get('site', 'tagline'),
			'navLocation' => ''
		));
	}

	function index() {
		//D::log($this->models->User->loggedIn(), 'is logged in');
		return $this->libs->Template->set(array(
			'title' => 'Dashboard',
			'content' => 'Testing',
		))->render('bases/default');
	}
	
	function updateMasterHolsters() {
		
		$i = 29100;
		foreach($this->models->MasterHolsters->all() as $holster) {
			
			//$holster->update(array('ProductID' => $i++))->save();
		}
	}
	
	function scrapr() {
		$this->lib('scrapr');
		
		$doc = $this->libs->scrapr->loadUrl('http://www.bianchi-intl.com/product/Prod.php?TxtModelID=5')->getDoc();
		
		echo $doc->find('p.body');
	}
	
	function busterModelFix() {
		$busters = $this->models->BianchiBusterLookup->all();
		foreach($busters as $buster) {
			/*
$buster->update(array(
				'model' => join(' ', f_rest(explode(
					' ',
					$buster->model
				)))
			))->save();
*/
			
		}
		D::show('updated');
	}
	
	function biachiGunTable() {
		
		D::show('starting.');
		
		$bGunArray = array_map(
			function($v) {
				//return array('model' => $v->gunModel, 'rawId' => $v->id, 'make' => $v->gunMake);
				$key = $v->gunMake . ' ^ ' . $v->gunModel;
				return array($key => array('model' => $v->gunModel, 'rawId' => $v->id, 'make' => $v->gunMake));
			},
			$this->models->BianchiBusterLookup->all()
		);
		

		D::show('sorting finished.');
		
		$this->models->BianchiGuns->create(
			array_map(function($v) {
				return $v;
			}, f_untree($bGunArray))
		);
		D::show('done.');
		
		//$this->models->
		
	}
	
	function fixSW() {
		$this->models->BianchiGuns->find(array('make' => array('S&W', 'WESSON')))->update(array('make' => 'Smith and Wesson'))->save();
		
		return $this->libs->Template->set(array(
			'title' => 'Fixed Smith &amp; Wesson',
			'content' => 'all done.'
		))->render('bases/default');
	}
	
	function holsterBuster() {
		$busters = $this->models->BianchiBusterLookup->libs->Query
			->select(array(array('DISTINCT' => 'gunModel'), 'id', 'model', 'gunMake', 'bust'))
			->where(array('gunModel' => '%/%', 'LIKE'))
			->from($this->models->BianchiBusterLookup->tableName)
			->orderBy(array('gunMake' => 'ASC', 'gunModel' => 'ASC'))
		->results();
		//D::show($busters, 'busters');

		//Python 6
		//$busters = $this->models->BianchiBusterLookup->where(array('OR', array('gunModel' => '%"%', 'LIKE'), array('gunModel' => '%â%', 'LIKE') ))->sort(array('gunModel' => 'ASC'))->export();
		//D::show($busters, 'busters');
		$query = $this->lib('databases/Query');
		return $this->libs->Template->set(array(
			'title' => 'Holster Bail Buster',
			'content' => B::form(
				array('method' => 'post', 'action' => SITE_URL . 'holsterBail'),
				B::ul(join(array_map(function($buster) use($query) {
					//$query->update('bianchiBusterLookup')->where(array('gunMake' => $buster->gunMake, 'gunModel' => $buster->gunModel))->set(array('bust' => 1))->go();
					
					$gName = $buster->gunMake . '^^^' . $buster->gunModel;
					return B::li(
						B::input(array('id' => $gName . $buster->id, 'type' => 'checkbox', 'name' => 'bails[]', 'value' => $gName, 'checked' => $buster->bust == 2 ? 'checked' : null))
						. B::label(array('for' => $gName . $buster->id), $gName)
					);
				}, $busters))),
				B::input(array('type' => 'submit', 'value' => 'Bail the busters'))
			),
		))->render('bases/default');
	}
	
	function holsterBust() {
		$query = $this->lib('databases/Query');
		$busters = $query->select('*')->from('bianchiBusterLookup')->where(array('bust' => 1), array('gunModel' => '%similar%', 'NOT LIKE'))->results();
		
		foreach($busters as $buster) {
			
			//D::show(explode('/', $buster->gunModel), $buster->gunMake);
			$spaceModels = explode(' ', $buster->gunModel);
			
			foreach($spaceModels as $k => $space) {
				if(strstr($space, '"')) {
					$bbl = $space;
					unset($spaceModels[$k]);
				} else {
					$bbl = '?';
				}
			}
			
			$slashModels = explode('/', join(' ', $spaceModels));
			
		
			
			$slashArModels = array_map(function($m) { return explode(' ', $m);}, $slashModels);
			//$temp = array();
			
			if(count($slashArModels[0]) > count($slashArModels[1])) {
				$temp = $slashArModels[0];
				$slashArModels[0] = $slashArModels[1];
				$slashArModels[1] = (array)f_last($temp);
				$slashArModels[2] = f_chop($temp);
				 
			} else {
				if(count((array)$slashArModels[1]) > 1) {
					//$temp = $slashArModels[1];
					
					$slashArModels[2] = f_rest($slashArModels[1]);
					$slashArModels[1] = (array)f_first($slashArModels[1]);
				} else {
					$slashArModels[2] = '';
				}
			}
			
			$slashArModels['bbl'] = $bbl;
			//$sortedSlashArModels = notRetardedUSort($slashArModels, function($a, $b) { return count($a) > count($b) ? 1 : -1;});
			
			
			//$slashArModels[1]
			$query->update('bianchiBusterLookup')->where(array('id' => $buster->id))->set(array(
				'gunModel' => join(' ', array(
					is_array($slashArModels[2]) ? join(' ', $slashArModels[2]) : $slashArModels[2],
					is_array($slashArModels[0]) ? join(' ', $slashArModels[0]) : $slashArModels[0]
				)). ' ',
				'bbl' => $slashArModels['bbl'],
				'bust' => 4
			))->go();
			
			$busterAr = (array)$buster;
			unset($busterAr['id']);
			
			
			$query->insert(array(array_merge($busterAr, array(
				'gunModel' => join(' ', array(
					is_array($slashArModels[2]) ? join(' ', $slashArModels[2]) : $slashArModels[2],
					is_array($slashArModels[1]) ? join(' ', $slashArModels[1]) : $slashArModels[1]
				)). ' ',
				'bbl' => $slashArModels['bbl'],
				'bust' => 4
			))))->into('bianchiBusterLookup')->go();
			
			D::show($slashArModels, $buster->gunMake . ' ^ ' .$buster->gunModel );
			
/*
		    [0] => Array
		        (
		            [0] => .40
		        )
		
		    [1] => Array
		        (
		            [0] => 9mm
		        )
		
		    [2] => Array
		        (
		            [0] => XD
		        )
		
		    [bbl] => (3""
*/
			
		}
		//D::show($query->select('*')->from('bianchiBusterLookup')->where(array('bust' => 1))->results());
	}
	
	function meh() {
		$query = $this->lib('databases/Query');
		//$query->update('bianchiBusterLookup')->where(array('bust' => 5))->set(array('bust' => 1))->go();
	}
	
	function holsterBail() {
		//foreach()
		$query = $this->lib('databases/Query');
		foreach($_POST['bails'] as $bail) {
			
			$arBail = explode('^^^', $bail);
			$make = $arBail[0];
			$model = $arBail[1];
			$query->update('bianchiBusterLookup')->where(array('gunMake' => $make, 'gunModel' => $model))->set(array('bust' => 2))->go();
		}
		return $this->libs->Template->set(array(
			'title' => 'Bailed.',
			'content' => B::ul(join(array_map(function($bail) {
				return B::li($bail);
			}, $_POST['bails'])))
		))->render('bases/default');
	}
	
	function gunPicker() {
	

	
		return $this->libs->Template->set(array(
			'title' => 'Gun Picker',
			'content' => T::get('parts/gunpicker', array(
				'guns' => $this->models->BianchiGuns->pull(array('orgGuns' => array('orgMake')))->all()
			))
		))->render('bases/default');
	}
	
	function matchGuns() {
		
		
/*
		$text1 = print_r(,true);
		
		$text2 = print_r(,
		true);
*/
		
		set_time_limit(1);
		
		$this->helper('misc');
		
		$bGuns = $this->models->BianchiGuns->all();
		$guns = $this->models->Guns->all();
		
		/*
		$bGuns = $this->models->BianchiGuns->limit(30)->all();
		$guns = $this->models->Guns->limit(40)->all();
		*/
		
		//D::show(intval('Beretta ^ 96 Centurion'), 'intval test');
		
		/*
		D::show(array_map(function($bGun) {
			return $bGun->manufacturer . ' ^ ' . $bGun->model;
		}, $guns));
		*/
		
		//D::show($bGuns->, 'B Gun list');
		
		$gunTranslate = $this->models->GunMakeTranslate;
		
		$bGunScores = array_map(function($bGun) use($guns, $gunTranslate) {
			//array([mixed ...])
			$scores = array();
			$gunAr = array();
			
			$bGunName = strtolower($bGun->make . ' ^ ' . $bGun->model);
			$bGunAr = join(notRetardedSort(str_split($bGunName)));
			
			foreach($guns as $gun) {
				/*
				$scores[$gun->manufacturer . ' ^ ' . $gun->model] = count(array_filter(
					array_diff($bGunAr, notRetardedSort(str_split($gun->manufacturer  . ' ^ ' . $gun->model)))
				));
				*/
				
				//string str)
				//echo $gun
				$gGunName = join(notRetardedSort(str_split(strtolower($gun->manufacturer . ' ^ ' . $gun->model))));
/*
				foreach(notRetardedSort(str_split(strtolower(
					$gun->manufacturer  . ' ^ ' . $gun->model
				))) as $n => $gLetter) {
				
					
				
					if(isset($bGunAr[$n]) && $gLetter == $bGunAr[$n]) {
						if(!isset($scores[$gGunName])) {
							$scores[$gGunName] = 1;
						} else {
							$scores[$gGunName]++;
						}
					}
				}
*/
				//if(abs(strlen($bGunAr) - strlen($gGunName)) < 4) {
					$scores[$gGunName] = abs(similar_text($bGunAr, $gGunName)) - abs(strlen($bGunAr) - strlen($gGunName));
					$gunAr[$gGunName] = $gun->id;
				//}
				
				/*
$gunTranslate->create(array(
					'bMake' => $bGun->id,
					'orgMake' => $gun->id,
					'score' => $scores[$gGunName]
				));
*/
				
				
				
				//$scores[$gun->manufacturer . ' ^ ' . $gun->model] = levenshtein($bGunName, $gun->manufacturer  . ' ^ ' . $gun->model);
			}
			//array_filter(array input [, callback callback])
			
			$scores = array_reverse(notRetardedASort($scores));
			//$gunAr = (notRetardedASort($scores));
			//array array [, bool preserve_keys])
			
			//$return = array();
			
			
			
			$last = f_first($scores);
			
			foreach($scores as $k => $s) {
				
				if($last == $s) {
					//$gunTranslate->create(array('bMake' => $bGun->id, 'orgMake' => $gunAr[$k], 'score' => $s ));
					$return[] = $k;
				} else {
					break;
				}
				$last = $s;
			}
			static $i = 0;
			D::show($return, $bGunName . ' #' . $i++);
			
			return array($bGunName => $return);			
/*
			array_map(function($gun) use($bGun) {
				
			}, $guns);
*/
		}, $bGuns);
		
		
		
		
		//
		$text1 = $bGunScores;
		$text2 = '';
		return $this->libs->Template->set(array(
			'title' => 'Fixed Smith &amp; Wesson',
			'content' => join(array(
				B::textarea(array('rows' => 20), print_r($text1, true)),
				B::textarea(array('rows' => 20), print_r($text2, true))
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
