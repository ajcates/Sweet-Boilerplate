<?=B::div(
	array('id' => 'holsterMatchTitle'),
	B::h3($holster->PageTitle),
	B::img(array('src' => $holster->LargeImage, 'alt' => 'large image'))
). B::form(
	array('method' => 'post'),
	B::div(
		array('id' => 'guns', 'class' => 'left guns'),
		B::h4('Guns'),
		B::ul(
			join(array_map(function($gun) {
			
				$gName = $gun->manufacturer . ' ^ ' . $gun->model . $gun->id;
				return B::li(
					B::input(array('id' => $gName, 'type' => 'checkbox', 'name' => $gName, 'value' => $gun->id))
					. B::label(array('for' => $gName), $gun->manufacturer . ' ^ ' . $gun->model . ' bbl: ' . $gun->bbl)
				);
			}, $guns))
		)
	),
	B::div(
		array('id' => 'refGuns', 'class' => 'right guns'),
		B::h4('Reference'),
		B::ul(
			join(array_map(function($gun) {
			
				//$gName = $gun->manufacturer . ' ^ ' . $gun->model . $gun->id;
				return B::li(
					$gun->gunMake . ' ^ ' . $gun->gunModel
				);
			}, $refGuns))
		)
	),
	B::div(
		array('id' => 'saveButton', 'class' => 'clear'),
		B::input( array('type' => 'submit', 'value' => 'Save'))	
	),
	B::nav(
		array('id' => 'holsterNav', 'class' => 'clear'),
		B::div(
			array('class' => 'left'),
			B::a(array('href' => $prevLink), 'Prev')
		),
		B::div(
			array('class' => 'right'),
			B::a(array('href' => $nextLink), 'Next')
		)
	)
);