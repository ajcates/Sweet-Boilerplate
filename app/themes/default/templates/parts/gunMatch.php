<?=B::div(
	array('class'  => 'contentTitle'),
	B::h5(array('class' => 'topLabel'), 'Bianchi gun:'),
	B::h3($bGun->make . ' ^ ' . $bGun->model),
	B::h5(array('class' => 'topLabel'), $updated)
). B::form(
	array('method' => 'post'),
	B::div(
		array('id' => 'guns', 'class' => 'guns'),
		B::h4('Guns'),
		B::input(array('type' => 'hidden', 'name' => 'guns[]', 'value' => '')),
		B::ul(
			join(array_map(function($gun) use($selectedGuns) {
			
				$gName = $gun->manufacturer . ' ^ ' . $gun->model . $gun->id;
				return B::li(
					B::input(array('id' => $gName, 'type' => 'checkbox', 'name' => 'guns[]', 'value' => $gun->id, 'checked' => in_array($gun->id, $selectedGuns) ? 'checked' : null))
					. B::label(array('for' => $gName), $gun->manufacturer . ' ^ ' . $gun->model . ' – bbl: ' . $gun->bbl)
				);
			}, $guns))
		)
	),
	B::div(
		array('id' => 'saveButton', 'class' => 'clear'),
		B::input( array('type' => 'submit', 'value' => 'Save'))	
	),
	B::nav(
		array('id' => 'holsterNav', 'class' => 'clear'),
		B::div(
			array('id' => 'prevLink', 'class' => 'left'),
			B::a(array('href' => $prevLink), 'Prev')
		),
		B::div(
			array('id' => 'nextLink', 'class' => 'right'),
			B::a(array('href' => $nextLink), 'Next')
		)
	)
);